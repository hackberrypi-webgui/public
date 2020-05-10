#!/bin/bash

function checkWifi(){
	check=$(nmcli dev wifi | grep $1)

	checkNumber=${#check}
	if (($checkNumber > 0)); then
	       	echo 1
	else
		echo 0
	fi
}

activeConnection=$(nmcli connection show --active)
checkControl=${#activeConnection}
if  (($checkControl > 0)); then
echo "$activeConnection"
	exit 1
fi

echo "Check wifi (restarting wpa_supplicant.service)"
systemctl restart wpa_supplicant.service
sleep 3
wifiList=(freetibet Home)

for i in "${wifiList[@]}";
do
	checkWifi=$(checkWifi "$i")
	if (($checkWifi == 1)); then
		echo "Activating connection $i"
#		echo $(nmcli con down "$i")
		echo $(nmcli con up "$i")
		echo "$i" $(date) >> log.txt
		break
	else
		echo "Connection $i not available"
	fi
done

