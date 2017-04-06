<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Leaves');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Leave'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
