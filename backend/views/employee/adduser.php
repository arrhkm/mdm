<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = Yii::t('app', 'Add User Employee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-user-employee">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formadduser', [
        'model_emp' => $model_emp,
        'model_user'=> $model_user,
        'item'=>$item,
    ]) ?>

</div>
