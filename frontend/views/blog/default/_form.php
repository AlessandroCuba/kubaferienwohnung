<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\ActiveForm;
use funson86\blog\Module;
?>

<!-- COMMENTS -->
<div id="comments">
    <!-- LEAVER YOUR COMMENT -->
    <div id="respond">
        <div class="reply-title">
            <h4><?= Module::t('blog', $post->commentsCount.' Comments'); ?></h4>
        </div>
        <?php $form = ActiveForm::begin([
            'id'=>'comment-form',
            //'options' => //['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{input}{label}{error}",
            ],
        ]); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-item form-textarea-wrapper">
                        <?= $form->field($model, 'content')->textarea(['rows' => 6, 'placeholder' => 'Comment here'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-item form-name">
                        <?= $form->field($model, 'author')->textInput((['maxlength' => 32, 'placeholder' => 'Your Name']))->label(false); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-item form-email">
                        <?= $form->field($model, 'email')->textInput((['maxlength' => 32, 'placeholder' => 'Your Email']))->label(false); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-item form-email">
                        <?= $form->field($model, 'url')->textInput((['maxlength' => 64, 'placeholder' => 'Your URL (optional)']))->label(false); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-actions">
                        <div class="form-group">
                            <?= Html::input('Submit', '0', Module::t('blog', 'Post Comments')); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- END / LEAVER YOUR COMMENT -->
</div>
<!-- END / COMMENTS -->

<?php $this->registerJs('
    jQuery(function(){
        jQuery(".btn-success").click(function(){
            var result = true;
            if(jQuery("#blogcomment-author").val() == "" || jQuery("#blogcomment-email").val() == "" || jQuery("#blogcomment-content").val() == ""){
                result = false;
            }

            if(result){
                jQuery(".btn-success").attr("disabled", "disable");
                jQuery.post("' . Yii::$app->request->absoluteUrl . '",
                    {
                        "BlogComment[author]":jQuery("#blogcomment-author").val(),
                        "BlogComment[email]":jQuery("#blogcomment-email").val(),
                        "BlogComment[url]":jQuery("#blogcomment-url").val(),
                        "BlogComment[content]":jQuery("#blogcomment-content").val(),
                    },
                    function(data,status){
                        if(data == "success"){
                            jQuery(".comment:last").after("<div class=\'comment\'><div class=\'author\'><a href=\'" + jQuery("#blogcomment-url").val() + "\'>" + jQuery("#blogcomment-author").val() +"</a>&nbsp;<span>" + "正在审核" + "</span></div><div class=\'content\'>" + jQuery("#blogcomment-content").val() +"</div></div>");
                        }else{
                        }
                    });
            }else{
                return false;
            }
        });
    });
    function currentTime(){
        var d = new Date(),str = "";
        str += d.getFullYear()+"年";
        str  += d.getMonth() + 1+"月";
        str  += d.getDate()+"日";
        str += d.getHours()+"时";
        str  += d.getMinutes()+"分";
        str+= d.getSeconds()+"秒";
        return str;
    }
') ?>