<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = $model->employee_number;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php /*<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        */?>
        <?= Html::a(Yii::t('app', 'Upload Image'), ['upload', 'id'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="col-md-12">
        <div class="col-md-4">        
        </div>
        <div class="col-md-4">
            <img src= <?= 'data:image/jpg;base64,'.base64_encode($model['employee_picture'])?> class="center-block img-circle img-thumbnail img-responsive">                     
        </div>
        <div class="col-md-4"></div>
    
    </div>
    <h1><p class="text-center"> <?= Html::encode($model->first_name) ?></p></h1>
   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'employee_number',
            'first_name',
            'last_name',
            'nick_name',
            'email:email',
        ],
    ]) ?>

</div>
