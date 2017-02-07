<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Approval */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Approval',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Approvals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="approval-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'employee'=>$employee, 'dt_level'=>$dt_level,
        'location'=>$location,
    ]) ?>

</div>
