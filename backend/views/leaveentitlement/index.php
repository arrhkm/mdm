<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeaveEntitlementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Leave Entitlements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-entitlement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Leave Entitlement'), ['create'], ['class' => 'btn btn-success'])?>
    
        <?= Html::a(Yii::t('app', 'Create Leave Entitlement2'), ['createh1'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'employee_number',                    
                'value'=>function($model){
                    return $model->employee->employee_number;
        
                },
                
            ],
            [
                'attribute'=>'first_name',                    
                'value'=>function($model){
                    return $model->employee->first_name;
        
                },
                
            ],
            'no_of_days',
            'days_used',
            'from_date',
            'to_date',
            // 'credited_date',
            // 'note',
            // 'deleted',
            'createed_by_name',
            //'employee_id',
            //'leave_type_id',          
            [
                'attribute'=>'name_type',                    
                'value'=>function($model){
                    return $model->leaveType->name_type;
        
                },
                
            ],
            
            //'user_id',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
