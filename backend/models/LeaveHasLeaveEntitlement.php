<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_has_leave_entitlement".
 *
 * @property integer $id
 * @property integer $leave_id
 * @property integer $leave_entitlement_id
 * @property string $lenght_days
 *
 * @property Leave $leave
 * @property LeaveEntitlement $leaveEntitlement
 */
class LeaveHasLeaveEntitlement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_has_leave_entitlement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_id', 'leave_entitlement_id'], 'required'],
            [['leave_id', 'leave_entitlement_id'], 'integer'],
            [['lenght_days'], 'number'],
            [['leave_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leave::className(), 'targetAttribute' => ['leave_id' => 'id']],
            [['leave_entitlement_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeaveEntitlement::className(), 'targetAttribute' => ['leave_entitlement_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'leave_id' => Yii::t('app', 'Leave ID'),
            'leave_entitlement_id' => Yii::t('app', 'Leave Entitlement ID'),
            'lenght_days' => Yii::t('app', 'Lenght Days'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeave()
    {
        return $this->hasOne(Leave::className(), ['id' => 'leave_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveEntitlement()
    {
        return $this->hasOne(LeaveEntitlement::className(), ['id' => 'leave_entitlement_id']);
    }
}
