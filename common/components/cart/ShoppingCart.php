<?php 
namespace common\components\cart;

//use components\cart\storage\StorageInterface;
use Yii;
use yii\base\Component;

class ShoppingCart extends Component
{
	
	public $sessionKey = 'cart';

	private $_items = [];

	public function add($id, $amount)
	{
		$this->loadItems();
		if (array_key_exists($id, $this->items)) {
			$this->_items[$id]['amount'] += $amount;
			//$this->_items[$id]['quantity'] += $quantity;

		} else {
			$this->_items[$id]=[
				'id'=>$id,
				'amount'=>$amount,
				'quantity'=>$quantity,

			];
		}
		$this->saveItems();
	}
	public function remove($id)
	{
		$this->loadItems();
		$this->_items = array_diff_key($this->_items, [$id=>[]]);
		$this->saveItems();	
	}

	public function clear()
	{
		$this->_items=[];
		$this->saveItems();
	}

	public function getItems()
	{
		$this->loadItems();
		return $this->_items;
	}

	private function loadItems()
	{
		$this->_items = Yii::$app->session->get($this->sessionKey, []);
	}

	private function saveItems()
	{
		Yii::$app->session->set($this->sessionKey, $this->_items);
	}

}

?>