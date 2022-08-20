<?php
namespace app\models;
use yii\base\Model;
 
class SignupForm extends Model{
    
    public $name;
    public $password;
    public $email;
    public $password_repeat;
    
    public function rules() {
        return [
            [['email', 'name', 'password', 'password_repeat'], 'required', 'message' => 'Заполните поле'],
            [['email'], 'email'],
            [['email', 'name', 'password', 'password_repeat'], 'string', 'max' => 255],
            ['password_repeat','validatPasswordRepeat'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'Почта',
            'name' => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }


    public function validatPasswordRepeat(){
        if($this->password != $this->password_repeat)
        {
            $this->addError('password_repeat', 'Пароли не совпадают');
        }

    }
}
