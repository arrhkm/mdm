<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//tambahan 
use yii\jui\AutoComplit;
//use yii\web\JsExpression;




/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="employee-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model_emp, 'id')->textInput(['maxlength' => true]) ?>
    <?php /*= $form->field($model_emp, 'first_name')->widget(\yii\jui\AutoComplete::classname(), [
                'options' => ['class' => 'form-control', 'placeholder' => 'Enter Name/ID'],
                'clientOptions' => [
                    'source' => ['Hakam', 'muhammad Toha', 'Muhammad Farid'],
                    'autoFill' => true,
                    'minLength' => '1',
                    'select' => new yii\web\JsExpression("function( event, ui ) {
                        $('#libraryborrowtransaction-lbt_holder_id').val(ui.item.id);
                    }")
                ],
    ]) */?>

     <?= $form->field($model_user, 'username')->widget(\yii\jui\AutoComplete::classname(), [
                'options' => ['class' => 'form-control', 'placeholder' => 'Enter Name/ID'],
                'clientOptions' => ['source' => ['$item', 'Guyonan','macan ompong']],
    ])?>

    



    <?php // $form->field($model_user, 'user_id')->textInput(['maxlength' => true]) ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
foreach ($item as $data) 
{
	echo $data."<br>";
}
?>