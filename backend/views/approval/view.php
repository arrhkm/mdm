<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\EmployeeHasApproval;
use yii\grid\GridView;

//add form in this file
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Approval */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Approvals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approval-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'approval_name',
            'level',
            /*
            [
                'label'=>'Test',
                'value'=>function($model){
                    return Html::encode('$model->level');
                }    
                    
            ],*/
            [
                'label'=>'Employee',
                'value'=>$model->employee->first_name,
            ],
            //'employee_id',
            //'location_id',
            [   
                'label'=>'Location',
                'value'=> $model->location->location_name,
                
            ],
        ],
    ]) ?>
    
    <?php 
    //$hkm_dataProvider = EmployeeHasApproval::find()->with('approval')->all();
    
    ?>
    
    <div class="add-employee-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model2, 'approval_name')->textInput(['maxlength' => true]) ?>
    
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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'approval_id',
            'employee_id',
            //'employee_id',
            //'first_name',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
