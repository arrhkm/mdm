<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Leave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'date')->widget(\yii\jui\DatePicker::className(), [
        'language'=>'id',
        'dateFormat'=>'yyyy-MM-dd', 
        'inline'=>true,
        'clientOptions'=>[
            'autoclose'=>true,
        ],
    ]) 
    //$form->field($model, 'date')->textInput() 
    
            
    ?>

    <?= $form->field($model, 'lenght_days')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lenght_hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'leave_request_id')->textInput() ?>

    <?= $form->field($model, 'leave_type_id')->textInput() ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
