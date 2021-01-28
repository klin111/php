<?php

/**
 * Class Test
 * 一个类可以包含有属于自己的 常量，变量（称为“属性”）以及函数（称为“方法”）。
 */
class Test{

    public $var ='a default value';

    public function displayVar($var){
//        echo $this->var;
        return $var;
//一个方法在类定义内部被调用时，有一个可用的伪变量 $this。$this 是一个到当前对象的引用。
    }

}

//要创建一个类的实例，必须使用 new 关键字。当创建新对象时该对象总是被赋值，除非该对象定义了 构造函数 并且在出错时抛出了一个 异常。类应在被实例化之前定义（某些情况下则必须这样）。
//如果在 new 之后跟着的是一个包含有类名的字符串 string，则该类的一个实例被创建。如果该类属于一个命名空间，则必须使用其完整名称。
//如果没有参数要传递给类的构造函数，类名后的括号则可以省略掉。
/*
 *  创建实例
 */
$instance=new Test();

//或者

$clsname='Test';
$inst=new $clsname();

//在类定义内部，可以用 new self 和 new parent 创建新对象。
//当把一个对象已经创建的实例赋给一个新变量时，新变量会访问同一个实例，就和用该对象赋值一样。此行为和给函数传递入实例时一样。可以用 克隆 给一个已创建的对象建立一个新实例。

/*
 * 对象赋值
 */



$instance->var='aaaa';
$inst->var='bbbb';
/*
 * 创建新对象
 */

class child extends Test{

}

$obj1=new Test();
$obj2=new $obj1;
//$obj3=Test::displayVar();
//$obj4=child::displayVar();
//var_dump($obj1 !== $obj2);
//var_dump($obj2);

/*
 * 访问新创建对象的成员
 */

echo (new DateTime())->format('Y');

echo PHP_EOL;


/*
 * 类的属性和方法存在于不同的“命名空间”中，这意味着同一个类的属性和方法可以使用同样的名字。在类中访问属性和调用方法使用同样的操作符，具体是访问一个属性还是调用一个方法，取决于你的上下文，即用法是变量访问还是函数调用。
 * 访问类属性 vs. 调用类方法
 */

class Foo
{
    public $bar = 'property';

    public function bar() {
        return 'method';
    }
}

$obj = new Foo();
echo $obj->bar, PHP_EOL, $obj->bar(), PHP_EOL;


/*
 * 如果你的类属性被分配给一个 匿名函数 你将无法直接调用它。因为访问类属性的优先级要更高，在此场景下需要用括号包裹起来调用。
 * 类属性被赋值为匿名函数时的调用示例
 *
 */

class Foo2
{
    public $bar;

    public function __construct() {
        $this->bar = function() {
            return 42;
        };
    }
}

$obj = new Foo2();

echo ($obj->bar)(), PHP_EOL;


/*
 * extends
 * 一个类可以在声明中用 extends 关键字继承另一个类的方法和属性。PHP 不支持多重继承，一个类只能继承一个基类。
 *被继承的方法和属性可以通过用同样的名字重新声明被覆盖。但是如果父类定义方法时使用了 final，则该方法不可被覆盖。可以通过 parent:: 来访问被覆盖的方法或属性。
 *
 * 简单的类继承
 */

class SimpleClass
{
    // 声明属性
    public $var = 'a default value';

    // 声明方法
    public function displayVar() {
        echo $this->var;
    }
}

class ExtendClass extends SimpleClass
{
    // 同样名称的方法，将会覆盖父类的方法
    function displayVar()
    {
        echo "Extending class\n";
        parent::displayVar();
    }
}




$extended = new ExtendClass();
$extended->displayVar();


/**
 * 签名兼容性规则
 * 覆盖方法时，其签名必须与父方法兼容。否则，将发出致命错误，或者在PHP 8.0.0之前，将 E_WARNING生成级别错误。
 * 如果签名遵守方差规则，将强制性参数设置为可选，并且任何新参数为可选，则签名是兼容的 。这被称为Liskov替代原理，简称LSP。
 * 构造函数和私有方法不受这些签名兼容性规则的约束，因此在签名不匹配的情况下不会发出致命错误。
 *
 *
 * 兼容的子方法
 */

class Base
{
    public function foo(int $a) {
        echo "Valid\n";
    }
}

class Extend1 extends Base
{
    function foo(int $a = 5)
    {
        parent::foo($a);
    }
}

class Extend2 extends Base
{
    function foo(int $a, $b = 5)
    {
        parent::foo($a);
    }
}

$extended1 = new Extend1();
$extended1->foo();
$extended2 = new Extend2();
$extended2->foo(1);

/*
 * 下面的示例演示了移除参数或强制使用可选参数的子方法与父方法不兼容方法。致命的子方法删除参数时出错
 *
 *当子方法强制使用可选参数时出现致命错误
 *
 * 在子类中使用已重命名的命名参数和参数时出错
 *
 *
 */
//
//class Base2
//{
//    public function foo(int $a = 5) {
//        echo "Valid\n";
//    }
//}
//
//class Extend extends Base2
//{
//    function foo()
//    {
//        parent::foo(1);
//    }
//}
//
//
//class Base3
//{
//    public function foo(int $a = 5) {
//        echo "Valid\n";
//    }
//}
//
//class xtend1 extends Base3
//{
//    function foo(int $a)
//    {
//        parent::foo($a);
//    }
//}


/*
 * 关键词 class 也可用于类名的解析。使用 ClassName::class 你可以获取一个字符串，包含了类 ClassName 的完全限定名称。这对使用了 命名空间 的类尤其有用。
 *
 *类名的解析
 *
 *
 * 注意:使用 ::class 解析类名操作会在底层编译时进行。这意味着在执行该操作时，类还没有被加载。因此，即使要调用的类不存在，类名也会被展示。在此种场景下，并不会发生错误。
 *
 */

namespace NS {
    class ClassName {

    }

    echo ClassName::class;
}

