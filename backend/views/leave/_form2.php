<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Leave */
/* @var $form yii\widgets\ActiveForm */
?>
 <?= DetailView::widget([
        'model' => $model_leave_request,
        'attributes' => [
            'id',
            'date_applied',
            'comments',
            'employee_id',            
            'leave_type_id',
        ],
])?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'lenght_days',
            //'lenght_hours',
            //'start_time',
            //'end_time',
            //'leave_request_id',
            [
                'attribute'=>'leave_request_id',
                'value'=>function($model){
                    return $model->leave_request_id;
                }
            ],
            //'leave_type_id',
            [
                'attribute'=>'leave_type_id',
                'value'=>function($model) {
                    return $model->leaveType->name_type;
                }    
            ],
            //'employee_id',
            [
                'attribute'=>'employee_id',
                'value'=>function($model){
                    return $model->employee_id." - ".$model->employee->first_name;
                }
            ],
            // 'status',

            ['class' => 'yii\grid\ActionColumn', 
               'buttons'=>[
                   'delete'=>function($url, $model, $key){
                        $url=url::to([
                            'leave/delete2', 
                            'employee_id'=>$model->employee_id, 
                            'leave_request_id'=>$model->id,
                            'leave_type_id'=>$model->leave_type_id,
                            'id'=>$model->id,
                        ]);
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url);
                   }
               ],
                'template'=>'{delete}',
            ],
        ],
]); ?>

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
    
   

    <?= $form->field($model, 'lenght_days')->hiddenInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lenght_hours')->hiddenInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->hiddenInput() ?>

    <?= $form->field($model, 'end_time')->hiddenInput() ?>

    <?php //= $form->field($model, 'leave_request_id')->textInput() ?>
    <?= $form->field($model, 'leave_request_id')->widget(kartik\widgets\Select2::className(),[
        'data'=>$leave_request,
        'options'=>['placeholder'=>'Select Request id ...'],
    ])?>
    <?php //= $form->field($model, 'leave_type_id')->textInput() ?>
    <?= $form->field($model, 'leave_type_id')->widget(kartik\widgets\Select2::className(),[
            'data'=>$leave_type,
            'options'=>['placeholder'=>'Select ....'],
    ])?>

    <?php //= $form->field($model, 'employee_id')->textInput() ?>
    <?= $form->field($model, 'employee_id')->widget(kartik\select2\Select2::className(),[
        'data'=>$employee,
        'options'=>['placeholder'=>'select ....'],
    ])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
