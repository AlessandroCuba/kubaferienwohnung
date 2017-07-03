<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<section class="awe-parallax login-page-demo">
    <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register-page__content">
                <div class="content-title">
                    <span>Welcome back</span>
                    <h2>EXPLORER!</h2>
                </div>
                    <?php 
                    $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnBlur' => false,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                    ])
                    ?>
                    <div class="form-item">
                        <?= $form->field($model, 'login',
                                ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                            );
                        ?>
                    </div>
                    <div class="form-item">
                        <?= $form->field($model, 'password',
                                ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                                ->passwordInput()
                                ->label(Yii::t('user', 'Password')) 
                        ?>
                    </div>
                    <div>
                        <?= $form->field($model, 'rememberMe', ['inputOptions' => ['class' => 'form-control']])->checkbox(['tabindex' => '3']) ?>
                    </div>
                    <?php 
                        if($module->enablePasswordRecovery){
                            echo Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']);
                        }
                    ?>
                    
                    <div class="form-actions">
                        <?= Html::submitInput(
                                Yii::t('user', 'Sign in'),
                                ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
                            ) 
                        ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                <div class="login-register-link">
                    Dont have account yet? <a href="register.html">Register HERE</a>
                </div>
            </div>
        </div>
</section>