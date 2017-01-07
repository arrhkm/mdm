<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Add item');
//$this->title = 'Add item';
$this->params['breadcrumbs'][] = ['label' => 'Cart', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
	<h1><?= Html::encode($this->title)?></h1>

	<?php $form = ActiveForm::begin(['id'=>'contact-form']);?>
		<?= $form->field($model, 'productId')?>
		<?= $form->field($model, 'amount')?>
		<?= $form->field($model, 'quantity')?>
		<div class="form-group">
			<?= Html::submitButton('add', ['class'=>'btn-primary'])?>
		</div>
	<?php ActiveForm::end();?>
</div>
