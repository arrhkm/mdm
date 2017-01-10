<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PeriodYear */

$this->title = Yii::t('app', 'Create Period Year');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Period Years'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="period-year-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
