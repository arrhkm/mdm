<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Approval */

$this->title = Yii::t('app', 'Create Approval');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Approvals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approval-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'employee'=>$employee, 'dt_level'=>$dt_level,
        'location'=>$location,
   
    ]) ?>

</div>
