<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$signupConfirmationLink = Yii::$app->urlManager->createAbsoluteUrl([
    'site/confirmation',
    'email' => $user->email,
    'token' => $user->auth_key
]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to confirm registration:</p>

    <p><?= Html::a(Html::encode($signupConfirmationLink), $signupConfirmationLink) ?></p>
</div>
