<?php
namespace Myphpdemo;
 
error_reporting(E_ALL);
 
define('THRIFT_PHP_LIB_PATH', '/usr/local/software/thrift-0.10.0/lib/php/lib');
require_once  THRIFT_PHP_LIB_PATH.'/Thrift/ClassLoader/ThriftClassLoader.php';
 
use Thrift\ClassLoader\ThriftClassLoader;

$GEN_DIR = realpath(dirname(__FILE__)).'/gen-php';

// require_once $GEN_DIR . '/HelloWorld.php'; 

// echo $GEN_DIR."\n";
// echo THRIFT_PHP_LIB_PATH;
 
$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift',  THRIFT_PHP_LIB_PATH);
$loader->registerDefinition('hello',  $GEN_DIR);
$loader->register();
 
//use Thrift\Transport\TPhpStream;
 
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;
 
try {
    //仅在与服务端处于同一输出输出流有用
    //使用方式：php Client.php | php Server.php 
    //$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
     
    //socket方式连接服务端
    //数据传输格式和数据传输方式与服务端一一对应
    //如果服务端以http方式提供服务，可以使用THttpClient/TCurlClient数据传输方式
    $transport = new TBufferedTransport(new TSocket('localhost', 9090));
    $protocol = new TBinaryProtocol($transport);
    $client = new \hello\HelloWorldClient($protocol);
 
    $transport->open();
     
    //同步方式进行交互
    $curTime = microtime(true);
    for ($i=0; $i < 100; $i++) { 
        $recv = $client->say('Hello!');
        # code...
    }
    $timeConsumed = round(microtime(true) - $curTime,3)*1000; 
    echo $timeConsumed;
     
    $transport->close();
} catch (TException $tx) {
    print 'TException: '.$tx->getMessage()."\n";
}
  