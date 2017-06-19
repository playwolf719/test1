namespace py hello
namespace php hello

service HelloWorld {
    string ping(),
    string say(1:string msg)
}