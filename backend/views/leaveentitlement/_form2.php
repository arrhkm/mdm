<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\LeaveEntitlement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-entitlement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'multiple_insert')->checkbox(['checked'=>'checked']) ?>

    <?= $form->field($model, 'no_of_days')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'days_used')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'from_date')->textInput() ?>

    <?php //= $form->field($model, 'to_date')->textInput() ?>

    <?php // = $form->field($model, 'credited_date')->textInput() ?>

    <?php //= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'deleted')->textInput() ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>yii::$app->user->identity->id]) ?>

    <?= $form->field($model, 'createed_by_name')->textInput(['maxlength' => true, 'value'=>Yii::$app->user->identity->username, 'disabled'=>false]) ?>

    <?php //= $form->field($model, 'employee_id')->textInput() ?>
    <?php
        
        echo $form->field($model, 'employee_id')->widget(Select2::Classname(), [
            //'model' => $model,
            //'attribute' => 'employee_id',
            'data' => $employee,
            'options' => ['placeholder' => 'Select a Employee ...',],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    ?>
    <?php //= $form->field($model, 'leave_type_id')->textInput() ?>
    <?= $form->field($model, 'leave_type_id')->widget(Select2::Classname(), [
            'data'=>$dtLeaveType,
            'options'=>['placeholder'=>'Select a Leave Type ...',],
            'pluginOptions'=>[
                'allowClear'=>true,
            ],
        ]);
    ?>
    <?= $form->field($model, 'period_year')->widget(select2::Classname(),[
            //'data'=>['period1'=>'period1', 'period2'=>'period2'],
            'data'=>$periodYear,
            'options'=>['placeholder'=>'Select a period',],
            'pluginOptions'=>[
                'allowClear'=>true,
            ],
    ])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
