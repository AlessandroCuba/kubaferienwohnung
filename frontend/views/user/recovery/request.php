<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<section class="awe-parallax login-page-demo">
    <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register-page__content">
                <div class="content-title">
                    <span>We lend a</span>
                    <h2>HAND ??</h2>
                </div>
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'password-recovery-form',
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                    ]); 
                    ?>
                <div class="form-item">
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="form-actions">
                    <?= Html::submitInput(Yii::t('user', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?><br>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
</section>