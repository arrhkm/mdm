<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\LeaveRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'date_applied')->textInput() ?>
    <?=$form->field($model, 'date_applied')->widget(\yii\jui\DatePicker::className(), [
        'language'=>'id',
        'dateFormat'=>'yyyy-MM-dd', 
        'inline'=>true,
        'clientOptions'=>[
            'autoclose'=>true,
        ],
    ])?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'employee_id')->textInput() ?>
    <?= $form->field($model, 'employee_id')->widget(Select2::Classname(),[
        'data'=>$employee,
        'options'=>['placeholder'=>'Select Employee ...'],
        'pluginOptions'=>['allowClear'=>true,],
    ])?>

    <?php //= $form->field($model, 'leave_type_id')->textInput() ?>
    <?= $form->field($model, 'leave_type_id')->widget(Select2::Classname(),[
        'data'=>$leave_type,
        'options'=>['placeholder'=>'Select leave type ...'],
        'pluginOptions'=>['allowClear'=>true,],
    ])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
