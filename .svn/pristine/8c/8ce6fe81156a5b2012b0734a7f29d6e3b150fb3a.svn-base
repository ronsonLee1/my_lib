<?php 
/***************************************** 设计模式一: 单例模式 **************************************************************/
/**
 * $_instance必须声明为静态的私有变量
 * 构造函数必须声明为私有,防止外部程序new类从而失去单例模式的意义
 * getInstance()方法必须设置为公有的,必须调用此方法以返回实例的一个引用
 * ::操作符只能访问静态变量和静态函数
 * new对象都会消耗内存
 * 使用场景:最常用的地方是数据库连接。
 * 使用单例模式生成一个对象后，该对象可以被其它众多对象所使用。
 */
class man{
    //静态变量保存全局实例
    private static $_instance;
    
    //静态方法，单例统一访问入口
    public static function getInstance() {
        if (!self::$_instance instanceof self){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    //构造函数声明为private,防止直接创建对象
    private function __construct(){
        echo '我被实例化了！';
    }
    //阻止用户复制对象实例
    private function __clone(){
        trigger_error('Clone is not allow' ,E_USER_ERROR);
    }
}
// 这个写法会出错，因为构造方法被声明为private
//$test = new man;
// 下面将得到Example类的单例对象
$test = man::get_instance();
$test = man::get_instance();
$test->test();
/***************************************** 设计模式二: 工厂模式 **************************************************************/
/**
 * 定义个抽象的类，让子类去继承实现它
 *
 */
abstract class Operation{
    //抽象方法不能包含函数体
    abstract public function getValue($num1,$num2);//强烈要求子类必须实现该功能函数
}
/**
 * 加法类
 */
class OperationAdd extends Operation {
    public function getValue($num1,$num2){
        return $num1+$num2;
    }
}
/**
 * 减法类
 */
class OperationSub extends Operation {
    public function getValue($num1,$num2){
        return $num1-$num2;
    }
}
/**
 * 乘法类
 */
class OperationMul extends Operation {
    public function getValue($num1,$num2){
        return $num1*$num2;
    }
}
/**
 * 除法类
 */
class OperationDiv extends Operation {
    public function getValue($num1,$num2){
        try {
            if ($num2==0){
                throw new Exception("除数不能为0");
            }else {
                return $num1/$num2;
            }
        }catch (Exception $e){
            echo "错误信息：".$e->getMessage();
        }
    }
}
/**
 * 求余类（remainder）
 */
class OperationRem extends Operation {
    public function getValue($num1,$num2){
        return $num1%$num12;
    }
}
/**
 * 工程类，主要用来创建对象
 * 功能：根据输入的运算符号，工厂就能实例化出合适的对象
 *
 */
class Factory{
    public static function createObj($operate){
        switch ($operate){
            case '+':
                return new OperationAdd();
                break;
            case '-':
                return new OperationSub();
                break;
            case '*':
                return new OperationSub();
                break;
            case '/':
                return new OperationDiv();
                break;
        }
    }
}
$test=Factory::createObj('/');
$result=$test->getValue(23,0);
echo $result;
/***************************************** 设计模式三: 工厂模式 **************************************************************/