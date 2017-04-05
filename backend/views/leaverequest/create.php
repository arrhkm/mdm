<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeaveRequest */

$this->title = Yii::t('app', 'Create Leave Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leave-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'employee'=>$employee,
        'leave_type'=>$leave_type,
    ]) ?>

</div>
