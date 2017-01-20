<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodYear */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
function hkmDate(){
    var x = document.getElementById("periodyear-date_start").value;
    document.getElemetById("periodyear-name_period").value = "hallo";
}
</script>
<div class="period-year-form">

    <?php $form = ActiveForm::begin(); ?>
        <?php /*= DatePicker::widget([
            'model'=>$model,
            'attribute'=>'date_start',
            'language'=>'id',
            'dateFormat'=>'yyyy-MM-dd',

        ]) */?>

    <?= $form->field($model, 'date_start')->widget(yii\jui\DatePicker::classname(), [
        'language' => 'id',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>[
            'clientEvents'=>[
                'onchange'=>'hkmDate(){ document.getElemetById("periodyear-name_period").value = "hallo";}'
            ],
        ],
    ]) ?>

    <?php //= $form->field($model, 'date_end')->textInput() ?>

    <?php //= $form->field($model, 'name_period')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'date_day')->textInput() ?>

    <?php //= $form->field($model, 'date_month')->textInput() ?>

    <?php //= $form->field($model, 'date_year')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
