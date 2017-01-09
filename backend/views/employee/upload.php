<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form ActiveForm */
?>
<div class="employee-upload">


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    
    <div class="form-group">
    	<?= $form->field($model, 'employee_picture')->fileInput() ?>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end() ?>
       
</div><!-- employee-upload -->
