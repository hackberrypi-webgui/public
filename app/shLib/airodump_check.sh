#!/bin/bash

while getopts w: option
do
case "${option}"
in
w) WLAN=${OPTARG};;
esac
done

if [ -z "$WLAN" ]
then
 echo "error: -w is mandatory parameter (wlan device name)"
 exit
fi

sudo killall -9 airodump-ng
sudo airodump-ng -w "../../temp/cache/airodump_$WLAN" --output-format csv --write-interval 1 "$WLAN"&

