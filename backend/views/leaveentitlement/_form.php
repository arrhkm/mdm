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

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'no_of_days')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'days_used')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_date')->textInput() ?>

    <?= $form->field($model, 'to_date')->textInput() ?>

    <?= $form->field($model, 'credited_date')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'createed_by_name')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'employee_id')->textInput() ?>
    <?php
        
        echo $form->field($model, 'employee_id')->widget(Select2::Classname(), [
            //'model' => $model,
            //'attribute' => 'employee_id',
            'data' => $data,
            'options' => ['prompt' => 'Select a Employee ...',],
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

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
/*foreach ($data as $datas){
    echo $datas['id']." - ".$datas['first_name']."<br>";
}*/