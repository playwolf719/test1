# thrift_demo
## thrift info（以python为例）
* thrift --gen py helloworld.thrift得到gen-py文件夹（thrift服务需要的基础库，且每次修改thrift文件都要重新生成一遍基础库）。
* 新建client.py和server.py，详见python_thrift文件夹。
* 执行python server.py之后，再执行client.py。

## thrift文件样例
* thrift文件为整个服务的协议文件，服务以此为基础按约定进行开发。

```

namespace py hello

service HelloWorld {
    string ping(),
    string say(1:string msg)
}


```

