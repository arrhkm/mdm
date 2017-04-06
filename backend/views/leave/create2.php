<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Leave */

$this->title = Yii::t('app', 'Create Leave');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leaves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'back To Leave Request'), 'url' => ['leaverequest/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
        'leave_type'=>$leave_type,               
        'leave_request'=>$leave_request,
        'employee'=>$employee,
        'model_leave_request'=>$model_leave_request,
        'searchModel'=>$searchModel,
        'dataProvider'=>$dataProvider,
    ]) ?>

</div>
