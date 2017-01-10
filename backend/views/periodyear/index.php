<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Period Years');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="period-year-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Period Year'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Delete selected'), ['delete2'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                //'checkboxOptions' => function($data) {  return ['value' => $data->id]},
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                },
                
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'date_start',
            'date_end',
            'name_period',
            'date_day',
            // 'date_month',
            // 'date_year',
            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
