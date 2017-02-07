<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApprovalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Approvals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approval-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Approval'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'approval_name',
            'level',
            [   
                'label'=>'Level Name',        
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function($data) {
                    if ($data['level']==1){
                        $level_str='Supervisor';
                    }else if ($data['level']==2){
                        $level_str='Manager';
                    }else if($data['level']==3){
                        $level_str ='Deputi';
                    }else {
                        $level_str = 'Noname';
                    }
                    return $level_str; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],
            //'employee_id',
            'first_name',
            //'location_id',
            'location_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
