<?php 
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;

use yii\bootstrap\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\captcha\Captcha;

?>        
<section>
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="contact-page__map">
                            <?php
                                $coord = new LatLng(['lat' => 49.0220834, 'lng' => 8.4608567]);
                                $map = new Map([
                                    'center' => $coord,
                                    'zoom' => 12,
                                ]);
                                $marker = new Marker([
                                    'position' => $coord,
                                    'title' => 'My Home Town',
                                ]);

                                // Provide a shared InfoWindow to the marker
                                $marker->attachInfoWindow(
                                    new InfoWindow([
                                        'content' => '<p>This is my super cool content</p>'
                                    ])
                                );

                                // Add marker to the map
                                $map->addOverlay($marker);
                                
                                echo $map->display();
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-1">
                        <div class="contact-page__form">
                            <div class="title">
                                <span>We would like to know you</span>
                                <h2>CONTACT US</h2>
                            </div>
                            <div class="descriptions">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque id tempor dolor, id cursus sem. Vestibulum placerat non nibh et sodales. </p>
                            </div>
                            <?php 
                            $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
                            echo FormGrid::widget([
                                'model'=>$model,
                                'form'=>$form,
                                'autoGenerateColumns'=>true,
                                'rows'=>[
                                    [
                                    'attributes'=>[       // 2 column layout
                                        'name'=>['type'=>Form::INPUT_TEXT, 'options'=>['class' => 'form-item', 'placeholder'=>'Your Name *']],
                                        'email'=>['type'=>Form::INPUT_TEXT, 'options'=>['class' => 'form-item', 'placeholder'=>'Your Email *']],
                                    ]
                                    ],
                                    [
                                    'attributes'=>[       // 2 column layout
                                        'subject'=>['type'=>Form::INPUT_TEXT, 'options'=>['class' => 'form-item', 'placeholder'=>'Subject...']],
                                    ]
                                    ],
                                    [
                                    'attributes'=>[       // 2 column layout
                                        'body'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['rows' => 8, 'class' => 'form-textarea-wrapper', 'placeholder'=>'Your Message...']],
                                    ]
                                    ],
                                ],
                            ]);
                            echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]);
                            echo Html::submitButton('Send', ['class' => 'submit-contact', 'name' => 'contact-button']);
                            ActiveForm::end(); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>