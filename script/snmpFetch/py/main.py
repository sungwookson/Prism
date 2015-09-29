from pysnmp.entity.rfc3413.oneliner import cmdgen

import pysnmp
###import function
import json
#from snmp_helper import snmp_get_oid,snmp_extract

COMMUNITY_NAME = "monitor-me"
ROUTER_IP = "67.58.50.97"
IF_DESCR = "1.3.6.1.2.1.2.2.1.2"
IF_ALIAS = "1.3.6.1.2.1.31.1.1.1.18"
IF_PORT = "1.3.6.1.2.1.31.1.2.1.3"

def getSNMPPorts(cmdGen):
	return snmpFetch(cmdGen, IF_DESCR) #returns all ethernet, portchannel information

def getSNMPAlias(cmdGen):
	return snmpFetch(cmdGen, IF_ALIAS) #returns all alias for ethernet, portchannel

def getSNMPEthernetPortChannel(cmdGen):
	return snmpFetch(cmdGen, IF_PORT) #returns portchannel ethernet relation

def snmpFetch(cmdGen, search): #fetch command
	errorIndication, errorStatus, errorIndex, varBindTable = cmdGen.nextCmd(
    cmdgen.CommunityData(COMMUNITY_NAME),
    cmdgen.UdpTransportTarget((ROUTER_IP, 161)),
    search)
	if (errorIndication or errorStatus):
		return null
	else:
		return varBindTable


cmdGen = cmdgen.CommandGenerator()
PortChannelList = [];
EthernetList = []
SMMPPorts = getSNMPPorts(cmdGen)
SNMPAlias = getSNMPAlias(cmdGen)

EthernetPorts = getSNMPEthernetPortChannel(cmdGen)


for port in SMMPPorts:
	for name, val in port:
		name = name.prettyPrint().replace(IF_DESCR + ".", "")
		val = val.prettyPrint()
		infoDict = {'ifIndex':name, 'ifDescr':val}
		if val.startswith ("Ethernet"):
			infoDict['type']="Ethernet"
			EthernetList.append(infoDict)
		elif val.startswith ("Port-Channel"):
			infoDict['type']="PortChannel"
			PortChannelList.append(infoDict)

	
for alias in SNMPAlias:
	for name, val in alias:
		name = name.prettyPrint().replace(SNMPAlias + ".", "")
		val = val.prettyPrint()
		print name + " : " + val
		match = next((l for l in label if l['name'] == 'Test'), None)
		
		
print json.dumps(PortChannelList)
