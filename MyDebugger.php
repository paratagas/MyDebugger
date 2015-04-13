<?php
 /**
 * MyDebugger class file.
 * 
 * MyDebugger is created to help debagging during developing Yii 1.1.* projects.
 * It shows different useful class data: methods, DocComments, properties and values.
 *
 * MyDebugger can be used as follows:
 * MyDebugger::getAllClassProperties($model);
 * or
 * MyDebugger::getMethodSourceCode('UserIdentity', 'authenticate');
 *
 * @author Yauheni "Eugene" Svirydzenka <partagas@mail.ru>
 * @version 2015-04-12
 * 
 * MyDebugger uses Reflection API and VarDumper class.
 * To use MyDebugger you need to create components/VarDumper class using link below:
 * @link http://yiiframework.ru/doc/cookbook/ru/core.development
 */
class MyDebugger extends CComponent
{  
    /**
	 * Dumps all classes
	 * This method dumps all declared in scenario classes
	 */
    public static function getDeclaredClasses()
    {
         VarDumper::dump(get_declared_classes());
    }
    
    /**
	 * Dumps all interfaces
	 * This method dumps all declared in scenario interfaces
	 */
    public static function getDeclaredInterfaces()
    {
         VarDumper::dump(get_declared_interfaces());
    }
    
    /**
	 * Dumps all class/object information
	 * This method exports all class information but in var_dump style
     * @param string $className class name/object name
	 */
    public static function classExport($className)
    {
        $reflection = new ReflectionClass($className);
        Reflection::export($reflection);
    }
    
    /**
	 * Dumps all DocBlock comments
	 * This method shows all class DocBlock comments
     * @param string $className class name/object name
	 */
    public static function getDocComments($className)
    {
        $reflection = new ReflectionClass($className);
        $docComments = $reflection->getDocComment();
        VarDumper::dump($docComments);
    }
    
    /**
	 * Dumps all class/object methods
	 * This method dumps all class methods including
     * parent classes methods
     * @param string $className class name/object name
	 */
    public static function getClassMethodsWithParents($className)
    {
        $reflection = new ReflectionClass($className);
        $classMethods = $reflection->getMethods();
        VarDumper::dump($classMethods);
    }
    
    /**
	 * Dumps all class/object methods
	 * This method dumps all class methods
     * using ordered list
     * @param string $className class name/object name
	 */
    public static function getClassMethods($className)
    {
        $classMethods = get_class_methods($className);
        VarDumper::dump($classMethods);
    }
    
    /**
	 * Dumps method information
	 * This method dumps minified
     * method's information
     * @param string $className class name/object name
     * @param string $methodName method name
	 */
    public static function getClassMethod($className, $methodName)
    {
        $reflection = new ReflectionClass($className);
        $classMethod = $reflection->getMethod($methodName);
        VarDumper::dump($classMethod);
    }
    
    /**
	 * Dumps method source code
	 * This method dumps method's 
     * source code
     * @param string $className class name/object name
     * @param string $methodName method name
	 */
    public static function getMethodSourceCode($className, $methodName)
    {
        $reflection = new ReflectionClass($className);
        $classMethod = $reflection->getMethod($methodName);
        $path = $classMethod->getFileName();
        $lines = file($path);
        $from = $classMethod->getStartLine();
        $to   = $classMethod->getEndLine();
        $len  = $to-$from+1;
        $sourceCode = implode(array_slice($lines, $from-1, $len));
        VarDumper::dump($sourceCode);
    }
    
    /**
	 * Dumps method DocBlock comments
	 * This method shows all
     * class method DocBlock comments
     * @param string $className class name/object name
     * @param string $methodName method name
	 */
    public static function getMethodDocComments($className, $methodName)
    {
        $reflection = new ReflectionClass($className);
        $classMethod = $reflection->getMethod($methodName);
        $docComments = $classMethod->getDocComment();
        VarDumper::dump($docComments);
    }
    
    /**
	 * Dumps class/object properties
	 * This method dumps own
     * class/object properties 
     * @param string $className class name/object name
	 */
    public static function getClassProperties($className)
    {
        $reflection = new ReflectionClass($className);
        $classProperties = $reflection->getProperties();
        VarDumper::dump($classProperties);
    }
    
    /**
	 * Dumps all class properties
	 * This method dumps all class (not object) properties
     * with their values including parent properties
     * @param string $className class name
	 */
    public static function getAllClassProperties($className)
    {
        $classProperties = get_class_vars($className);
        VarDumper::dump($classProperties);
    }
    
    /**
	 * Dumps all object properties
	 * This method dumps all object (and class) properties
     * with their values including parent properties
     * @param string $object object name
	 */
    public static function getClassPropertiesAndValues($object)
    {
        $reflection = new ReflectionClass($object);
        $objProperties = $reflection->getProperties();
        
        foreach($objProperties as $property)
        {
            $propertyName = $reflection->getProperty($property->name);
            $propertyValue = $propertyName->getValue();
            VarDumper::dump($propertyValue);
        } 
    }
}
?>