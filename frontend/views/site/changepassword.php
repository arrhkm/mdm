<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\from\ChangePasswords;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = "Change Password"; //Yii::t('changepassword', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>Please fill out the following fields to change password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
                <?= $form->field($model, 'oldPassword')->passwordInput() ?>
                <?= $form->field($model, 'newPassword')->passwordInput() ?>
                <?= $form->field($model, 'retypePassword')->passwordInput() ?>
                <?php //= $form->field($model, 'id')->textInput(['readOnly'=>true, 'value'=>$_REQUEST['id']]) ?>
                <div class="form-group">
                    <?php //= Html::submitButton(Yii::t('site', 'changepasword'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
                    <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>