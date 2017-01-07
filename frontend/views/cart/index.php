<?php 

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;


//$this->title = 'Cart';
$this->title = Yii::t('app', 'Cart');
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
<h1><?= Html::encode($this->title) ?></h1>

<p><?= Html::a(Yii::t('app', 'Add Item'), ['add'], ['class'=>'btn btn-success'])?></p>
   
<?= GridView::widget([
	'dataProvider'=>$dataProvider,
	'columns'=>[
		['class'=> SerialColumn::className()],
		'id:text:ProductId',
		'amount:text:Amount',
		
		[
			'class'=>ActionColumn::className(),
			'template'=>'{delete}',
		],
	],
])?>