<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LeaveEntitlement]].
 *
 * @see LeaveEntitlement
 */
class LeaveEntitlementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LeaveEntitlement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LeaveEntitlement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
