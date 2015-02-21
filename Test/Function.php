<?php /* <?php
	function makecoffee($types = array("cappuccino"), $coffeeMaker = NULL)
	{
		$device = is_null($coffeeMaker) ? "hands" : $coffeeMaker;
		return "Making a cup of ".join(", ", $types)." with $device.\n";
	}
	echo makecoffee();
	echo makecoffee(array("cappuccino", "lavazza"), "teapot");
?> 

<?php
	function small_numbers()
	{
		return array (0, 1, 2);
	}
	list ($zero, $one, $two) = small_numbers();
	
	echo $one;
?> 

<HTML>
	<Form method = POST >
	<p>type:<input TYPE = 'TEXT' name = 'argu1'></p>
	<p>method:<input TYPE = 'TEXT' name = 'argu2'></p>
	<!--p><input TYPE = 'TEXT' name = 'argu3'></p-->
	<p><input type = 'submit' name = 'submit' value = 'POST'></p>
</HTML>

<?php
	if(!isset($_POST['submit'])){
		echo 'Please input your argument.' ;
		exit();
	}
	
	$argu1 = $_POST['argu1'];
	
	echo makecoffee(array("$argu1"),$_POST['argu2']);
	
	//echo `$argu1`;
?> */ ?>

<?php
function bar($arg = '') {
    echo "In bar(); argument was '$arg'.<br />\n";
}

bar('hahaha');



// 一个基本的购物车，包括一些已经添加的商品和每种商品的数量。
// 其中有一个方法用来计算购物车中所有商品的总价格，该方法使
// 用了一个 closure 作为回调函数。
class Cart
{
    const PRICE_BUTTER  = 1.00;
    const PRICE_MILK    = 3.00;
    const PRICE_EGGS    = 6.95;

    protected   $products = array();
    
    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }
    
    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] :
               FALSE;
    }
    
    public function getTotal($tax)
    {
        $total = 0.00;  //顺序运行，当到后面，仅仅到回调函数
        
        $callback =
            function ($quantity, $product) use ($tax, &$total)
            {
                $pricePerItem = constant(__CLASS__ . "::PRICE_" .
                    strtoupper($product));
                $total += ($pricePerItem * $quantity) * ($tax + 1.0);
            };
        
        array_walk($this->products, $callback);
        return round($total, 2);;
    }
}

$my_cart = new Cart;

// 往购物车里添加条目
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

// 打出出总价格，其中有 5% 的销售税.
print $my_cart->getTotal(0.05) . "\n";
// 最后结果是 54.29
?> 