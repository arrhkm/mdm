<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\LeaveEntitlement */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('app', 'Create Leave Entitlement');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Entitlements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Insert entitlement for all Employee';

?>

<div class="leave-entitlement-form">
    <?php /* Modal::begin([
        'header' => '<h2>Hello world</h2>',
        'toggleButton' => ['label' => 'click me'],
    ])0 */;?>

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'multiple_insert')->checkbox(['value'=>true]) ?>

    <?= $form->field($model, 'no_of_days')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>yii::$app->user->identity->id]) ?>

    <?= $form->field($model, 'createed_by_name')->textInput(['maxlength' => true, 'value'=>Yii::$app->user->identity->username, 'disabled'=>false]) ?>

    
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
    <?php /* Modal::end();*/?>

</div>
