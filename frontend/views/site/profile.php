<?php

use frontend\models\ProfileForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var ProfileForm $model
 */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>


                <div class="form-group">
                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
