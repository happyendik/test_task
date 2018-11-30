<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Class Users
 * @package frontend\models
 */
class Users extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nickname', 'name', 'surname', 'email', 'password'], 'required'],
            ['nickname', 'match', 'pattern' => '/^[a-z]{1}[a-zа-яё]*$/ui'],
            ['nickname', 'unique'],
            ['name', 'match', 'pattern' => '/^[а-яё]*$/ui'],
            ['surname', 'match', 'pattern' => '/^[а-яё]*$/ui'],
            ['email', 'email'],
            ['email', 'unique'],
            ['password', 'string', 'min' => 5]
        ];
    }
}