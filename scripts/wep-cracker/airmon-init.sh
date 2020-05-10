#!/bin/bash/
# vim: filetype=sh
clear
echo "#######################"
echo "# WIFI packet monitor #"
echo "#######################"
echo ""

if [ $# -eq 0 ]; then
        echo "No parameters"
        exit
fi
echo "Check if $1 exist: "
echo "List of all wifi devices"
echo "------------------------"
allDevices=$(airmon-ng)

if [[ $allDevices == *"$1"* ]]; then
  echo "$1 exist!"

  airmon-ng stop $1mon
  device=$(airmon-ng start $1)

  if [[ $device == *"$1mon"* ]]; then
    echo "$1mon established!"
    if [ -t 0 ]; then stty -echo -icanon -icrnl time 0 min 0; fi
    keypress=''
    while [ "x$keypress" = "x" ]; do
	if [ ! -d check ]; then mkdir check; fi
    	$(airodump-ng --encrypt WEP --manufacturer -w check/check --output-format csv --write-interval 1 $1mon ) &
    	sleep 15
    	kill %1

    	#načte zařízení s nejlepším přenosem
    	bestDevice=$(python airmon-init.py)
	if [[ $bestDevice != "__empty" ]]; then
	    	echo "Best fit:" $bestDevice

	    	#parsuje informace o zařízení
	    	IFS="," # space is set as delimiter
    		read -ra arr <<< "$bestDevice"
	    	name="${arr[0]}"
	    	mac="${arr[1]}"
	    	channel="${arr[2]}"

	    	if [ ! -d cap ]; then mkdir cap; fi
		cd cap
		if [ ! -d $name ]; then mkdir $name; fi
		cd $name

	    	$(airodump-ng -w $name -c $channel --bssid $mac --output-format cap $1mon) &
	    	sleep 90
	    	kill %1
	    	cd ..
		cd ..
	fi
	sleep 20
    done	

  fi 

fi

