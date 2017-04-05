<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LeaveRequest */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Leave Request',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="leave-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'employee'=>$employee,
        'leave_type'=>$leave_type,
    ]) ?>

</div>
