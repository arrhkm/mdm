<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_type".
 *
 * @property integer $id
 * @property string $name_type
 * @property integer $deleted
 * @property integer $exclude_in_reports_if_no_entitlement
 *
 * @property Leave[] $leaves
 * @property LeaveEntitlement[] $leaveEntitlements
 * @property LeaveRequest[] $leaveRequests
 */
class LeaveType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted', 'exclude_in_reports_if_no_entitlement'], 'integer'],
            [['exclude_in_reports_if_no_entitlement', 'deleted'], 'default', 'value'=>0],
            [['name_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_type' => Yii::t('app', 'Name Type'),
            'deleted' => Yii::t('app', 'Deleted'),
            'exclude_in_reports_if_no_entitlement' => Yii::t('app', 'Exclude In Reports If No Entitlement'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaves()
    {
        return $this->hasMany(Leave::className(), ['leave_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveEntitlements()
    {
        return $this->hasMany(LeaveEntitlement::className(), ['leave_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveRequests()
    {
        return $this->hasMany(LeaveRequest::className(), ['leave_type_id' => 'id']);
    }
}
