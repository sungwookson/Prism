#!/bin/sh

SNMP_DATA_DIR="/tmp/foo.snmpwalk"
PORTCHANNEL_DATA_DIR="/tmp/foo.portchannel"
ORGANIZED_DATA_DIR="/tmp/foo.organized"
TEMP1_DIR="/tmp/foo.temp"
TEMP2_DIR="/tmp/foo.tmp"
TEMP3_DIR="/tmp/foo.tm"
TEMP4_TEMP="/tmp/temp"
COMMUNITY_NAME="monitor-me"
ROUTER_IP="67.58.50.97"

#fetching the rest of the information
grep -i ifdescr $SNMP_DATA_DIR > $TEMP3_DIR
while read -r line
do
	ifindex=${line:13:4}
	code=${line:0:8}
	grep -v $ifindex $TEMP3_DIR | grep -v $code > $TEMP4_TEMP
	cat $TEMP4_TEMP > $TEMP3_DIR
done < $ORGANIZED_DATA_DIR

while read -r line
do
	ifname=${line#*: }
	echo $value;
done < $TEMP3_DIR