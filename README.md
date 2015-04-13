# MyDebugger
MyDebugger is created to help debagging during developing Yii 1.1.* projects.

It shows different useful class data: methods, DocComments, properties and values.

MyDebugger can be used as follows:
MyDebugger::getAllClassProperties($model);
or
MyDebugger::getMethodSourceCode('UserIdentity', 'authenticate');

MyDebugger uses Reflection API and VarDumper class.
To use MyDebugger you need to create components/VarDumper class using link below:
http://yiiframework.ru/doc/cookbook/ru/core.development
