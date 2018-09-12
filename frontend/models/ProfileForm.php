<?php

namespace frontend\models;

use common\models\User;
use yii\base\Model;

/**
 * Class ProfileForm
 * @package frontend\models
 */
class ProfileForm extends Model
{
    /** @var string */
    public $username;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
        ];
    }
}