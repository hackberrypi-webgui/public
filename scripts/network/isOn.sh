#!/bin/bash
# example
# ./isOn.sh 192.168.2.133
#
#


ping -i 600 "$1" | while read pong; do echo "$(date): $pong"; done >> ping-"$1".log

