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
                'template'=>'{view} {update} {delete} {create}',
                'buttons'=>[                    
                    'create' => function ($url, $model, $key) {
                        $url = url::to(['leave/create', 'leave_request_id'=>$key['id'],'employee_id' =>$key['employee_id'], 'leave_type_id'=>$key['leave_type_id']]);
                        
                                //$url, 
                                
                               // [
                               //     'title' => Yii::t('yii', '/leave/create'),
                               // ]);
                        //return Html::a('<span class="glyphicon glyphicon-plus"></span>', 
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url);
            
                    }
                    /*'delete' => function ($url, $model2, $key) {
                        $options=[
                            'title'=>Yii::t('yii', 'Delete in frontend'),
                            'arial-label'=>Yii::t('yii', 'Delete'),
                            'data-pjax'=>'0',
                        ];
                    }*/
                ] 
            ],
        ],
    ]); ?>
</div>
