<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\widgets\ActiveForm;
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
<?php /* $form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['PeriodyearController/delete3'],
]); */?>

<?php 

    $this->registerJs(' 

    $(document).ready(function(){
    $(\'#MyButton\').click(function(){

        var HotId = $(\'#w1\').yiiGridView(\'getSelectedRows\');
          $.ajax({
            type: \'POST\',
            url : \'index.php?r=hotel/multiple-delete\',
            data : {row_id: HotId},
            success : function() {
              $(this).closest(\'tr\').remove(); //or whatever html you use for displaying rows
            }
        });

    });
    });', \yii\web\View::POS_READY);

?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'id'=>'grid',
        'dataProvider' => $dataProvider,
        //'options' => ['id'=>'hkm-grid'],
        //'containerOptions'=> ['class'=>'hkm-container'],
        'filterModel' => $searchModel,
        'columns' => [
            [
                //'id'=>'grid',
                'class' => 'yii\grid\CheckboxColumn',


                //'checkboxOptions' => function($data) {  return ['value' => $data->id]},
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                },
                //'cssClass' => 'ini-yii-grid',
                //'headerOptions'=>['id', 'start_date'],
            ],
            
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
    <input type="button" class="btn btn-info" value="Multiple Delete" id="MyButton" onclick="">
<?php Pjax::end(); ?></div>
<?php //$form = ActiveForm::end();?>