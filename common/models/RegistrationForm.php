<?php

namespace common\models;

use Yii;
use yii\base\Model;
use dektrium\user\models\RegistrationForm as MyRegistrationForm;

class RegistrationForm extends MyRegistrationForm {
    
    public $passwordConfirm;
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        // add passwordConfirm to scenarios
        $scenarios['create'][]   = 'passwordConfirm';
        $scenarios['update'][]   = 'passwordConfirm';
        $scenarios['register'][] = 'passwordConfirm';

        return $scenarios;
    }
    
    public function rules(){
        
        $rules = parent::rules();
        $rules['usernameLength']    = ['username', 'string', 'min' => 8, 'max' => 255];
        $rules['passwordLength']    = ['password', 'string', 'min' => 8, 'max' => 72];
        $rules['passwordConfirm']   = ['passwordConfirm','require', 'skipOnEmpty' => $this->module->enableGeneratingPassword];
        $rules['passwordConfirm']   = ['passwordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ];
        
        return $rules;
    }
    
    public function attributeLabels() {
        return [
            'passwordConfirm' => Yii::t('user', 'Password Confirm'),
        ];
    }
}

