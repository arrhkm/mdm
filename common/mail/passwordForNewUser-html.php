<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
	<p> Link ini hanya bisa di teruskan di jaringan internal PT. Lintech saja (LDP / LSF) VPN </p>
    <p>Hello <?= Html::encode($user->username) ?>,</p>
    <p>Your email :<?= Html::encode($user->email) ?>,</p>
    <p>Follow the link below to create your password:</p>    
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
