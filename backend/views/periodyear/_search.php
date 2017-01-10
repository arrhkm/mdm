<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodYearSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="period-year-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_start') ?>

    <?= $form->field($model, 'date_end') ?>

    <?= $form->field($model, 'name_period') ?>

    <?= $form->field($model, 'date_day') ?>

    <?php // echo $form->field($model, 'date_month') ?>

    <?php // echo $form->field($model, 'date_year') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
