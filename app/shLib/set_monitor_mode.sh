#!/bin/bash

while getopts m:w: option
do
case "${option}"
in
w) WLAN=${OPTARG};;
m) MODE=${OPTARG};;
esac
done

if [ -z "$WLAN" ]
then
 echo "error: -w is mandatory parameter (wlan device name)"
 exit
fi

if [ -z "$MODE" ]
then
 echo "error: -m is mandatory parameter (mode)"
 exit
fi

sudo ifconfig "$WLAN" down
sudo iwconfig "$WLAN" mode "$MODE"
