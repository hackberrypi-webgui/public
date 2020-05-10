import csv
import re
import glob
import sys

listCsv=glob.glob("check/*.csv")
listCsv.sort(reverse=True)

try:
	value=listCsv[0]
except KeyError:
	print("__empty")
	sys.exit(1)
	
with open(value,'rb') as csvfile:
    data = list(csv.reader(csvfile))

arr = []
empty = 0
for row in data:
    if len(row) != 0:
        arr.append(row)
    else:
        empty += 1
        if empty > 1:
            break;
arr.pop(0)
trimArr = []
for row in arr:
    tempRow = []
    for item in row:
        tempRow.append(item.strip())
    trimArr.append(tempRow)

iv=0
bestNetwork = ''
bestMac = ''
bestChannel = 0
for row in trimArr:
    if row[10] > iv:
        iv = row[10]
        bestNetwork = row[13]
        bestMac = row[0]
        bestChannel = row[3]

if ( len(bestNetwork) == 0 ) or ( len(bestMac) == 0 ) or ( bestChannel == 0 ):
	print("__empty")
else:
	print(bestNetwork+","+bestMac+","+bestChannel)
