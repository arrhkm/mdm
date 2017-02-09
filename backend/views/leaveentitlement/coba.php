<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;


?>
<h1> Tessssssssssssssssssssssssssss</h1>


<?php $form = ActiveForm::begin(); ?>
   
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password')->textInput() ?>
    <?= $form->field($model, 'hcb')->checkBox(['value'=>'Active'])?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>

<?php 


    echo "Password :".$model->password;
    echo "<br>Username :".$model->username;
    echo "<br>Checkbox_ku :".$model->hcb;
    
    

?>



