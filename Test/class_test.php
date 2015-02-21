<?php
/* class SimpleClass
{
    // property declaration
    public $var = 'a default value';
    const constant = 'const value';

    // method declaration
    public function displayVar() {
        echo $this->var;
    }
}

class ExtendClass extends SimpleClass
{
	// Redefine the parent method
    function displayVar()
    {
        echo 'Extending class<br />';
        parent::displayVar();
    }

    const constanted = 'Hello World';
 }

	$B = new ExtendClass;
	$A = new SimpleClass;
	$A -> var = 'Hello World</br>';
	$A -> displayVar();
	//var_dump($A instanceof SimpleClass);
	//var_dump($B instanceof SimpleClass);
	$B->displayVar();
    echo $A::constant;
    echo $B::constanted; */
	
class Test
{
    private $foo;
  
    public function __construct($foo)
    {
        $this->foo = $foo;
		
    }
    private function bar()
    {
        echo 'Accessed the private method.';
    }
    public function baz(Test $other)
    {	
		var_dump($this);
		var_dump($other->foo);
		$this->bar();
        // We can change the private property:
        $other->foo = 'hello';
        var_dump($other->foo);
        // We can also call the private method:
        $other->bar();
    }
}
$test = new Test();
$test->baz(new Test());

?>