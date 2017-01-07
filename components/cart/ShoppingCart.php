<?php (
namespace components\cart;

//use components\cart\storage\StorageInterface;
use Yii;
use yii\base\Component;

class ShoppingCart extends Component
{
	/*private $storage;
	private $_item = [];
	public function __constructor(StorageInterface $storage)
	{
		$this->storage = $storage;
	}
	*/
	public $sessionKey = 'cart';
	private $__items = [];

	public function add($id, $amount)
	{
		$this->loadItems();
		if (array_key_exists($id, $this->items)) {
			$this->items[$id]['amount'] += $amount;

		} else {
			$this->items[$id]=[
				'id'=>$id,
				'amount'=>$amount,
			];
		}
		$this->saveItems();
	}
	public function remove($id)
	{
		$this->loadItems();
		$this->__items = array_diff_key($this->__items, [$id=>[]]);
		$this->saveItems();	
	}

	public function clear()
	{
		$this->__items=[];
		$this->saveItems();
	}

	public function getItems()
	{
		$this->loadItmes();
		return $this->__items;
	}

	private function loadItems()
	{
		$this->__items= Yii::$app->session->get($this->sessionKey, []);
	}

	private function saveItems()
	{
		Yii::$app->session->set($this->sessionKey, $this->__items);
	}

}

?>