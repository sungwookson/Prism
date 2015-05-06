#!/bin/sh

s="IF-MIB::ifDescr.1000020 = STRING: Port-Channel20"
code=${${s#*.}% =*};
code=${code% =*}
echo $code;