<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmployeeHasApproval */

$this->title = Yii::t('app', 'Create Employee Has Approval');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employee Has Approvals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-has-approval-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
