<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="awe-parallax register-page-demo">
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="login-register-page__content">
            <div class="content-title">
                <span>Don’t stay at home</span>
                <h2>JOIN US !</h2>
            </div>
            <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
            ]); ?>
                <div class="form-item">
                    <?= $form->field($model, 'username') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="form-item">
                    <?php if ($module->enableGeneratingPassword == false): ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    <?php endif ?>
                </div>
                <div class="form-item">
                    <?php if ($module->enableGeneratingPassword == false): ?>
                        <?= $form->field($model, 'passwordConfirm')->passwordInput() ?>
                    <?php endif ?>
                </div>
                <a href="#" class="terms-conditions"><?= Yii::t('app', 'By registering, you accept terms &amp; conditions') ?></a>
                <div class="form-actions">
                    <?= Html::input('submit', Yii::t('user', 'Sign up')) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <div class="login-register-link">
                <?php
                    echo Yii::t('app', 'Already have Account? Log in ');
                    echo Html::a(Yii::t('app', 'HERE!'), ['/user/security/login'])
                ?>
            </div>
        </div>
    </div>
</section>