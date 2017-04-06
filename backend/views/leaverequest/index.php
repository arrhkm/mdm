<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeaveRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Leave Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Leave Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_applied',
            'comments',
            //'employee_id',
            [
                'attribute'=>'employee_id',
                'value'=>function($model){
                    return $model->employee_id." - ".$model->employee->first_name;
                },
            ],
            //'leave_type_id',
            [
                'attribute'=>'leave_type_id',
                'value'=>function($model){
                    return $model->leave_type_id." - ".$model->leaveType->name_type;
                }
            ],

            ['class' => 'yii\grid\ActionColumn',                
                'buttons'=>[                    
                    'create' => function ($url, $model, $key) {
                        $options=[
                            'title'=>Yii::t('yii', 'Create a leave'),
                            'arial-label'=>Yii::t('yii', 'Create'),
                            'data-pjax'=>'0',
                        ];                        
                        $url = url::to([
                            'leave/create2', 
                            'employee_id'=>$model->employee_id, 
                            'leave_request_id'=>$model->id,
                            'leave_type_id'=>$model->leave_type_id,
                        ]);
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, $options);
                    },                    
                ],
                'template'=>'{view} {update} {delete} {create}',
            ],
        ],
    ]); ?>
</div>
