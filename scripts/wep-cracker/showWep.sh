#!/bin/bash
airmon-ng start wlan0
airodump-ng --encrypt WEP --manufacturer wlan0mon
