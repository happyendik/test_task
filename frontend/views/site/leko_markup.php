<?php

use yii\helpers\Html;

$this->title = 'Leko';

?>

<div class="title"><h2>Регистрация</h2></div>



<form class="form-horizontal">
    <div class="form-group">
        <label class="col-md-2 control-label" for="nickname">Никнейм</label>
        <div class="col-md-1">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        </div>
        <div class="col-md-9">
            <?php echo Html::activeTextInput($model, 'nickname') ?>
<!--            <input type="text" class="form-control" id="nickname" placeholder="Никнейм">-->
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="name">Имя</label>
        <div class="col-md-1">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        </div>
        <div class="col-md-9">
            <?php echo Html::activeTextInput($model, 'name') ?>
<!--            <input type="text" class="form-control" id="name" placeholder="Имя">-->
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="surname">Фамилия</label>
        <div class="col-md-1">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        </div>
        <div class="col-md-9">
            <?php echo Html::activeTextInput($model, 'surname') ?>
<!--            <input type="text" class="form-control" id="surname" placeholder="Фамилия">-->
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="email">Email</label>
        <div class="col-md-1">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        </div>
        <div class="col-md-9">
            <?php echo Html::activeTextInput($model, 'email') ?>
<!--            <input type="email" class="form-control" id="email" placeholder="Email">-->
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="password">Пароль</label>
        <div class="col-md-1">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <i class="icon-exclamation"></i>
        </div>
        <div class="col-md-9">
            <?php echo Html::activePasswordInput($model, 'nickname') ?>
<!--            <input type="password" class="form-control" id="password" placeholder="Пароль">-->
        </div>
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-9">
        <input class="btn btn-primary" type="submit" value="Готово">
<!--        <input class="btn btn-primary" disabled="disabled" type="submit" value="Готово">-->
    </div>
</form>
