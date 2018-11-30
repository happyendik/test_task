<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this \yii\web\View
 */

$this->registerJs(<<<JS

    let a = {};
    a['users-nickname'] = 0;
    a['users-name'] = 0;
    a['users-surname'] = 0;
    a['users-email'] = 0;
    a['users-password'] = 0;
    
    $('#leko-form').on('afterValidateAttribute', function (event, attribute, messages) {
        
        console.log(messages);
        
        if (attribute.id) {
            let attributeId = attribute.id;
            console.log(attributeId);
            let validationIcon = $('.field-' + attributeId + ' .validation-icon');
            
            if (messages.length != 0) {
                validationIcon.children('.validation-success').addClass('hidden');
                validationIcon.children('.validation-error').removeClass('hidden');
                
                a[attributeId] = 0;
            } else {
                validationIcon.children('.validation-error').addClass('hidden');
                validationIcon.children('.validation-success').removeClass('hidden');
                
                a[attributeId] = 1;
            }
            
            let submitButton = $('#leko-button');
                            console.log(a);
            for (let value in a) {
                if (a[value] === 0) {
                    submitButton.attr('disabled', 'disabled');
                    break;
                }
                
                submitButton.removeAttr('disabled');
            }
        }

    });
JS
);

?>

<div class="title"><h2>Регистрация</h2></div>

<?php $form = ActiveForm::begin([
    'id' => 'leko-form',
    'action' => ['site/leko'],
    'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'layout' => 'horizontal',
    'validationUrl' => ['site/ajax-leko-validation'],
    'fieldConfig' => [
//        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'template' => '<div class="col-md-1">{label}</div>
                       <div class="col-md-1 validation-icon">
                        <span class="validation-success glyphicon glyphicon-ok hidden" aria-hidden="true"></span>
                        <span class="validation-error glyphicon glyphicon-remove hidden" aria-hidden="true"></span>
                       </div>
                       <div class="col-md-5">{input}</div>
                       <div class="col-md-5">{error}</div>',
//        'horizontalCssClasses' => [
//            'label' => 'col-sm-1',
//            'wrapper' => 'col-sm-10',
//            'error' => 'col-sm-5',
//            'hint' => 'col-sm-1',
//        ],
    ]
]); ?>

<?= $form->field($model, 'nickname')->textInput() ?>

<?= $form->field($model, 'name')->textInput() ?>

<?= $form->field($model, 'surname')->textInput() ?>

<?= $form->field($model, 'email')->textInput() ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('Login', [
        'id' => 'leko-button', 'class' => 'btn btn-primary', 'name' => 'leko-button', "disabled" =>"disabled"
    ]) ?>
</div>

<?php ActiveForm::end(); ?>
