<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;


?>
<h1> Tes</h1>


<?php $form = ActiveForm::begin(); ?>
   
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password')->textInput() ?>
    <?= $form->field($model, 'cb')->widget(Select2::classname(), [
        'data' =>[1 => "First", 2 => "Second", 3 => "Third", 4 => "Fourth", 5 => "Fifth"],
        'options' => ['placeholder' => 'Select a  ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    <?= $form->field($model, 'hcb')->checkbox(['value'=>30])?>
	
	
<div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>

<?php 


    echo "Cb : ".$model->cb;
    echo "<br>Username :".$model->username;
    echo "<br>Password :".$model->password;
    echo "<br>Hcb :".$model->hcb;
    
    
    

?>



