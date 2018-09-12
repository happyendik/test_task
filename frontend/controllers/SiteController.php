<?php
namespace frontend\controllers;

use common\models\LoginForm;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ProfileForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['signup', 'login', 'index', 'confirmation'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'profile', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/profile']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->signupAndSendLetter()) {
                Yii::$app->session->addFlash('success', 'Вам на почту отправлено письмо для подтверждения регистрации');
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * @param string $email
     * @param string $token
     * @return \yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionConfirmation($email, $token)
    {
        /** @var User $user */
        $user = User::find()
            ->byEmail($email)
            ->one();

        if (!$user) {
            Yii::$app->session->addFlash('warning', 'Данный email не зарегистрирован');
            return $this->goHome();
        }

        if ($user->auth_key === $token) {
            if ($user->status === User::STATUS_INACTIVE) {
                $user->status = User::STATUS_ACTIVE;
                $user->save();
            }
            Yii::$app->user->login($user);
            return $this->redirect(['site/profile']);
        }

        Yii::$app->session->addFlash('danger', 'Что-то пошло не так.');
        return $this->goHome();
    }

    /**
     * @return string
     */
    public function actionProfile()
    {
        $model = new ProfileForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            /** @var User $user */
            $user = Yii::$app->user->identity;
            $user->username = $model->username;
            if ($user->save()) {
                Yii::$app->session->addFlash('success', 'Имя пользователя успешно изменено');
                $model->username = '';
            }
        }

        return $this->render('profile', [
            'model' => $model
        ]);
    }
}
