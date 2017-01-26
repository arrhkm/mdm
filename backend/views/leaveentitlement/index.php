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
        <?= Html::a(Yii::t('app', 'Create Leave Entitlement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     <p>
        <?= Html::a(Yii::t('app', 'Create Leave Entitlement2'), ['createh1'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_of_days',
            'days_used',
            'from_date',
            'to_date',
            // 'credited_date',
            // 'note',
            // 'deleted',
            'createed_by_name',
            //'employee_id',
            'leave_type_id',
            'name_type', 
            'user_id',
            'first_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
