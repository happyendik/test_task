<?php

namespace common\models\queries;

use common\models\User;
use yii\db\ActiveQuery;

/**
 * Class UserQuery
 * @package common\models\queries
 *
 * @see User
 */
class UserQuery extends ActiveQuery
{
    /**
     * @param null $db
     * @return array|null|User
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param null $db
     * @return array|User[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param string $email
     * @return UserQuery
     */
    public function byEmail($email)
    {
        return $this->andWhere([
            'email' => $email
        ]);
    }
}