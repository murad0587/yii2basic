<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                'id' => 'mainNavBar',
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'id' => 'navs',
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'News', 'url' => ['/news/index']],
                    Yii::$app->user->getIdentity() ? (
                            Yii::$app->user->getIdentity()->role >= 30 ? (
                                    ['label' => 'Users', 'url' => ['/users/index']]
                                    ) : ('')

                            ) : (''),
                    Yii::$app->user->isGuest ? (
                            ['label' => 'Registration', 'url' => ['/site/registration']]
                            ) : (''),
                    Yii::$app->user->isGuest ? (
                            ['label' => 'Login', 'url' => ['/site/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    ' ', ['class' => ['btn btn-link logout', 'glyphicon', 'glyphicon-log-out']]
                            )
                            . Html::endForm()
                            . '</li>'
                            ),
                    Yii::$app->user->isGuest ? (''
                            ) : ( ['label' => '', 'linkOptions' => ['class' => ['glyphicon', ' glyphicon-user']], 'url' => ['/profile/index']]
                            ),
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
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
