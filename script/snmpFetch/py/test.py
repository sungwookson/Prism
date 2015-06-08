from pysnmp.entity.rfc3413.oneliner import cmdgen


COMMUNITY_NAME = "monitor-me"
ROUTER_IP = "67.58.50.97"

IF_DESCR = "1.3.6.1.2.1.2.2.1.2"
IF_ALIAS = "1.3.6.1.2.1.31.1.1.1.18"
IF_PORT = "1.3.6.1.2.1.31.1.2.1.3"

cmdGen = cmdgen.CommandGenerator()

errorIndication, errorStatus, errorIndex, varBindTable = cmdGen.nextCmd(
    cmdgen.CommunityData(COMMUNITY_NAME),
    cmdgen.UdpTransportTarget((ROUTER_IP, 161)),
    IF_PORT,
    
)


if errorIndication:
    print(errorIndication)
else:
    if errorStatus:
        print('%s at %s' % (
            errorStatus.prettyPrint(),
            errorIndex and varBindTable[-1][int(errorIndex)-1] or '?'
            )
        )
    else:
        for varBindTableRow in varBindTable:
            for name, val in varBindTableRow:
                print('%s = %s' % (name.prettyPrint(), val.prettyPrint()))

