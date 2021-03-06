<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'PT. Hakam Talenta',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label'=>'Post','url'=>['/post/']],
        
        ['label'=>'Setting','url'=>['#'], 'items'=>
            [
                ['label'=>'Location', 'url'=>['/location/']],
                ['label'=>'Period Year','url'=>['/periodyear/']],
                ['label'=>'Approval', 'url'=>['/approval/']],
            ]
        ],
        ['label'=>'Leave','url'=>['#'], 'items'=>
            [
                ['label'=>'Leave Entitlement', 'url'=>['/leaveentitlement/']],           
                ['label'=>'Leave Type', 'url'=>['/leavetype/']],
                //['label'=>'COba Form', 'url'=>['/leaveentitlement/coba']],
                ['label'=>'insert ALl employee', 'url'=>['/leaveentitlement/insertall']],
                ['label'=>'Leave', 'url'=>['/leave/']],
                ['label'=>'Leave Request', 'url'=>['/leaverequest/']],
            ]
        ],
        
        ['label'=>'Employee','url'=>['/employee/'],],
        ['label'=>'Admin','url'=>['/admin/'],],
        ['label' => 'gii', 'url' => ['/gii/']],
        ['label' => 'Download Att', 'url' =>'#', 'items'=>[
            ['label'=>'Download engineAtt', 'url'=>['/download/engineatt/']],
        ]],

    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] =
            ['label' => 'Login', 'url' => ['/site/login']];
        
        
    } else {
        $menuItems[] = '<li>'

            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
