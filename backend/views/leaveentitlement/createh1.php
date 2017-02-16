<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeaveEntitlement */

$this->title = Yii::t('app', 'Create Leave Entitlement');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leave Entitlements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::a(Yii::t('app', 'Create Leave Entitlement all employee'), ['insertall'], ['class' => 'btn btn-success']) ?>
<div class="leave-entitlement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
        'employee'=>$employee,
        'dtLeaveType'=>$dtLeaveType,
        'periodYear'=>$periodYear,
        'employee2'=>$employee2
    ]) ?>

</div>
