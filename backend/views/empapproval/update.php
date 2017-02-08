<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeHasApproval */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Employee Has Approval',
]) . $model->employee_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employee Has Approvals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->employee_id, 'url' => ['view', 'employee_id' => $model->employee_id, 'approval_id' => $model->approval_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="employee-has-approval-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
