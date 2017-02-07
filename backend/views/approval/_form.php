<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Approval */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approval-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'approval_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'level')->widget(Select2::Classname(),[
        'data'=>$dt_level,
        'options'=>['placeholder'=>'Select Level ...'],
        'pluginOptions'=>['allowClear'=>true,],
    ])?>
    
    <?= $form->field($model, 'employee_id')->widget(Select2::Classname(),[
       'data'=>$employee,
       'options' => ['placeholder' => 'Select a Employee ...',],
       'pluginOptions' => [
            'allowClear' => true,
       ],
    ])?>


    <?= $form->field($model, 'location_id')->widget(Select2::Classname(),[
        'data'=>$location,
        'options' => ['placeholder' => 'Select a Location ...',],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
