<?php

namespace app\modules\games\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `Games` module
 */
class MainController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionFirstGame($a,$b)
    {
       
        $a = Yii :: $app->request->get('a');
        $b = Yii :: $app->request->get('b');
        $c = $a + $b;
        return $c ;

    }
        
}
    
