#!/bin/sh

SNMP_DATA_DIR="/tmp/foo.snmpwalk"
PORTCHANNEL_DATA_DIR="/tmp/foo.portchannel"
ORGANIZED_DATA_DIR="/tmp/foo.organized"
TEMP1_DIR="/tmp/foo.temp"
TEMP2_DIR="/tmp/foo.tmp"

COMMUNITY_NAME="monitor-me"
ROUTER_IP="67.58.50.97"

#save snmpwalk data to tmp/foo
#snmpwalk -v 1 -c $COMMUNITY_NAME $ROUTER_IP > $SNMP_DATA_DIR
echo "Finished fetching snmpwalk"
echo "The data is stored in $SNMP_DATA_DIR"
echo 

#fetch portchannel list and info
grep -i port-channel $SNMP_DATA_DIR | grep -i ifdescr > $PORTCHANNEL_DATA_DIR
echo "Finished fetching portchannel information"
echo "The data is stored in $PORTCHANNEL_DATA_DIR"
echo

#reading from each line
cat /dev/null > $ORGANIZED_DATA_DIR
while read -r line
do
	code=${line#*.};
	code=${code% =*}
    portChannel=${line#*: }
    grep $code $SNMP_DATA_DIR | grep mib-2.77 > $TEMP1_DIR

    while read -r lin
    do
    	ifindex=${lin#*1.1.1.1.}
        ifindex=${ifindex%.*}
        if [[ ${#ifindex} != 4 ]]
        then 
        	ifindex="0";
        	#The zeros dont know why this happens
        	echo -e "$code \t $portChannel \t $ifindex \t" >> $ORGANIZED_DATA_DIR
        else 
        	grep $ifindex $SNMP_DATA_DIR | grep -i ifname > $TEMP2_DIR
        	ifaliasline="$(grep $ifindex $SNMP_DATA_DIR | grep -i ifalias)"
        	ifalias=${ifaliasline#*: }
        	
        	while read -r li
			do
				ifname=${li#*: }
	        	echo -e "$code \t $portChannel \t $ifindex \t $ifname \t $ifalias" >> $ORGANIZED_DATA_DIR

			done < $TEMP2_DIR

        fi
        
        
    done < $TEMP1_DIR
    
done < $PORTCHANNEL_DATA_DIR


echo "Finished reading lines from portchannel"
echo "The organized data will be stored in $ORGANIZED_DATA_DIR"
echo


