<?php
namespace hello;
 
class HelloWorldHandler implements HelloWorldIf {
  public function ping()
  {
      return "ping";
  }

  public function say($name)
  {
  	  echo "test";
      return "Hello $name";
  }
}