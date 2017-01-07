<?php 
namespace app\models;

use yii\base\Model;

class CartAddForm extends Model
{
	//public $product;
	public $amount;
	public $productId;
	public $quantity;

	public function rules()
	{
		return [
			[['productId', 'amount'], 'required'],
			[['amount', 'quantity'], 'integer', 'min'=>1],
		];
	}
	
}

?>