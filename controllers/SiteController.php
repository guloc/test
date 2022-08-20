<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Users;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage. Создание сраниц.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    // public function actionTest()
    // {
    //     $name = Yii::$app->request->get("name","Иван");
    //     $age = Yii::$app->request->get("age",15);
    //     return $this->render('Test', [
    //     "name" => $name, 'age' => $age
    //     ]);
    // }
//Страница testget
    public function actionTestGet() 
    {
        $name = Yii::$app->request->get("name","Иван");
          $age = Yii::$app->request->get("age",14);
           return $this->render('Test-get', [
         "name" => $name, 'age' => $age
         ]);
         }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        $user = new Users();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user->email = $model->email;
            $user->name = $model->name;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);
            $user->token = Yii::$app->security->generateRandomString(); // Генерация рандомной строки
            if($user->save()){
            Yii::$app->user->login($user, 3600*24*30);
                return $this->goHome();

            }
           
        }
        return $this->render('signup', ['user'=>$user, 'model'=>$model]); // Передаём данные во views 
        
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
