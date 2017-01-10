<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodYear */
/* @var $form yii\widgets\ActiveForm */
?>

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
    ]) ?>

    <?= $form->field($model, 'date_end')->textInput() ?>

    <?= $form->field($model, 'name_period')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_day')->textInput() ?>

    <?= $form->field($model, 'date_month')->textInput() ?>

    <?= $form->field($model, 'date_year')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
