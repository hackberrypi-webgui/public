#!/bin/bash

while getopts s:w: option
do
case "${option}"
in
s) SSID=${OPTARG};;
w) WLAN=${OPTARG};;
esac
done

if [ -z "$WLAN" ]
then
 echo "error: -w is mandatory parameter (wlan device name)"
 exit
fi

if [ -z "$PASSWORD" ]
then
 PASSWORD='toor1234'
fi

if [ -z "$SSID" ]
then
 SSID="hackberry-$WLAN"
else
  SSID="$SSID-$WLAN"
fi

sudo nmcli con delete "$SSID"
