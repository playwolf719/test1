import sys
sys.path.append('./gen-py')

from hello import HelloWorld

from thrift import Thrift
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol

import time

try:
    transport = TSocket.TSocket('localhost', 9090)
    transport = TTransport.TBufferedTransport(transport)
    protocol = TBinaryProtocol.TBinaryProtocol(transport)
    client = HelloWorld.Client(protocol)
    transport.open()

    # print "client - ping"
    # print "server - " + client.ping()

    t0 = time.time()

    for x in xrange(0,10000):
        msg = client.say("Hello!")

    t1 = time.time()-t0
    print "duration: "+ str(t1)

    transport.close()
except Thrift.TException, ex:
    print "%s" % (ex.message)