#!/bin/bash

echo "" > /tmp/foo.organized
while read -r line
do
    tmpline=$line
    code=${tmpline:16:7}
    name=${tmpline:34}

    grep $code /tmp/foo.snmpwalk | grep mib-2.77 > /tmp/foo.temp

    while read -r li
    do
        temp=$li
        ifindex=${temp:29:4}
        if [[ $ifindex == *"."* ]] || [[ $ifindex == "1000" ]]
        then 
        	ifindex="0";
        	echo -e "$code \t $name \t $ifindex \t" >> /tmp/foo.organized
        else 
        	grep $ifindex /tmp/foo.snmpwalk | grep -i ifname > /tmp/foo.tmp
        	
        	while read -r lin
			do
				tmp=$lin
				ifname=${tmp:30}
	        	echo -e "$code \t $name \t $ifindex \t $ifname" >> /tmp/foo.organized

			done < /tmp/foo.tmp

        fi
        
        
    done < /tmp/foo.temp
    
done < /tmp/foo.portchannel