<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\EmployeeHasApproval;
use yii\grid\GridView;

//add form in this file
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Url;

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
        <p> <h3>Add Employee to Approval</h3> </p>
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model2, 'approval_id')->textInput(['maxlength' => true, 'value'=>$model->id, 'disabled'=>true]) ?>
    
   

    <?= $form->field($model2, 'employee_id')->widget(Select2::Classname(),[
        'data'=>$dt_employee,
        'options' => ['placeholder' => 'Select a Location ...',],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model2->isNewRecord ? Yii::t('app', '+') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'approval_id',
            //'employee_id',
            //'employee_id',
            [
                'attribute'=>'employee_number',
                'value'=>function($data){
                    return $data->employee->employee_number;
                }
            ],
            [
                'attribute'=>'first_name',
                'value'=>function($dataModel2){
                    return $dataModel2->employee->first_name;
                }
            ],
            

            ['class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'delete' => function ($url, $model2, $key) {
                        $options=[
                            'title'=>Yii::t('yii', 'Delete in frontend'),
                            'arial-label'=>Yii::t('yii', 'Delete'),
                            'data-pjax'=>'0',
                        ];
                        //$url= \yii\helpers\Url::toRoute(['approval/delete2', 'employe_id'=>$key['employee_id'],'approval_id'=>$key['approval_id']]);
                        //return Html::a('delete', $url) : '';
                        $url = url::to(['approval/delete2', 'employee_id' =>$key['employee_id'], 'approval_id'=>$key['approval_id']]);
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, $options);
                    },
                ],
                'template'=>'{delete}',
            ],
        ],
    ]); ?>

</div>
