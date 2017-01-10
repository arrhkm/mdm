<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mdm\admin\models\User;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('rbac-admin', 'Change Password');
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
                <?= $form->field($model, 'id')->textInput(['readOnly'=>true, 'value'=>$_REQUEST['id']]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('rbac-admin', 'Change'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php 
       echo "model->id ". $model->id;
       //echo "<br> model->username :".$model->username;
       echo "<br> Request id :".$_REQUEST['id'];
       echo "<br> New Password:".$model->newPassword;
       echo "<br> RetypePassword :".$model->retypePassword;
       //echo "<br> RetypePassword :".$model->password_hash;

?>