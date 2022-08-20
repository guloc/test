<?php

namespace app\modules\admin\controllers;


use app\models\PostForm;
use yii\web\Controller;

class PostController extends Controller
{
    public function actionCreate()
    {
        $model = new PostForm();
        if ($model->load($this->request->post()) && $model->validate())
        {
            return $this->render('view', ['model' => $model]);
        }
        return $this->render('create', ['model' => $model]);
    }
}

    
        
       
       
 
    
