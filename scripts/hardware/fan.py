#!/usr/bin/env python3
# Author: Edoardo Paolo Scalafiotti <edoardo849@gmail.com>
import os
from time import sleep
import signal
import sys
import RPi.GPIO as GPIO

pin = 18
maxTMP = 60
minTMP = 50

def setup():
	GPIO.setmode(GPIO.BCM)
	GPIO.setup(pin, GPIO.OUT)
	GPIO.setwarnings(False)
	return()

def getCPUtemperature():
	res = os.popen('cat /sys/class/thermal/thermal_zone0/temp').readline()
	temp = (float(res)/1000)
	#print("temp is {0}".format(temp))
	return temp

def fanOff():
	GPIO.output(pin, GPIO.LOW)
	return()

def fanOn():
	GPIO.output(pin, GPIO.HIGH)
	return()

def getTemp():
	cpuTemp = getCPUtemperature()
	#print(cpuTemp)
	if cpuTemp > maxTMP:
		#print("fanOn")
		fanOn()
	if cpuTemp < minTMP:
		#print("fanOff")
		fanOff()
	return()


try:
	setup()
	while True:
		getTemp()
		sleep(10)
except KeyboardInterrupt:
	GPIO.cleanup()
