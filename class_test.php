<?php
class SimpleClass
{
    // property declaration
    public $var = 'a default value';

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
}

	$B = new ExtendClass;
	$A = new SimpleClass;
	$A -> var = 'Hello World</br>';
	$A -> displayVar();
	//var_dump($A instanceof SimpleClass);
	//var_dump($B instanceof SimpleClass);
	$B->displayVar();

?> 