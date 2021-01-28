<?php
/*
 * 属性
 * 类的变量成员叫做“属性”，或者叫“字段”、“特征”，在本文档统一称为“属性”。
 * 属性声明是由关键字 public，protected 或者 private 开头，然后跟一个普通的变量声明来组成。属性中的变量可以初始化，但是初始化的值必须是常数，这里的常数是指 PHP 脚本在编译阶段时就可以得到其值，而不依赖于运行时的信息才能求值。
 *有关 public，protected 和 private 的更多详细信息，请查看访问控制（可见性）。
 * 注意:
 *
 * 为了向后兼容 PHP 4，PHP 5 声明属性依然可以直接使用关键字 var 来替代（或者附加于）public，protected 或 private。但是已不再需要 var 了。在 PHP 5.0 到 5.1.3，var 会被认为是废弃的，而且抛出 E_STRICT 警告，但是 5.1.3 之后就不再认为是废弃，也不会抛出警告。
 * 如果直接使用 var 声明属性，而没有用 public，protected 或 private 之一，PHP 5 会将其视为 public。
 *
 *
 * 在类的成员方法里面，可以用 ->（对象运算符）：$this->property（其中 property 是该属性名）这种方式来访问非静态属性。
 * 静态属性则是用 ::（双冒号）：self::$property 来访问。更多静态属性与非静态属性的区别参见 Static 关键字。
 * 当一个方法在类定义内部被调用时，有一个可用的伪变量 $this。
 * $this 是一个到主叫对象的引用（通常是该方法所从属的对象，但如果是从第二个对象静态调用时也可能是另一个对象）。
 *
 *
 *
 *
 */

#1 属性声明
class SimpleClass
{

    // 正确的属性声明
    public $var6 = myConstant;
    public $var7 = array(true, false);

    //在 PHP 5.3.0 及之后，下面的声明也正确
    public $var8 = <<<'EOD'
hello world
EOD;
}


#2 示例：使用 nowdoc 初始化属性

class f1{
    public $b=<<<'EOF'
bar
EOF;

}



