<?php

namespace app\models;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PostForm extends Model
{
    public $name;
    public $link;
    public $linkedit;
    public $linkdonor;
    public $chapternumber;

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'link', 'linkedit', 'linkdonor', 'chapternumber'], 'required'],
            // email has to be a valid email address
            [['link', 'linkedit', 'linkdonor'], 'url'],
            ['chapternumber', 'number', 'min' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'link' => 'ССылка',
            'linkedit' => 'Ссылка на редактирование',
            'linkdonor' => 'Донор',
            'chapternumber' => 'Глава',
        ];
    }
}