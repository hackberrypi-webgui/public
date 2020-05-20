#!/bin/bash

while getopts p:s:w: option
do
case "${option}"
in
p) PASSWORD=${OPTARG};;
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

sudo nmcli con add type wifi ifname "$WLAN" con-name "$SSID" autoconnect 1 ssid "$SSID"
sudo nmcli con modify "$SSID" 802-11-wireless.mode ap 802-11-wireless.band bg ipv4.method shared
sudo nmcli con modify "$SSID" wifi-sec.key-mgmt wpa-psk
sudo nmcli con modify "$SSID" wifi-sec.psk "$PASSWORD"
sudo nmcli con modify "$SSID" connection.autoconnect-priority 1
sudo nmcli con up "$SSID"
