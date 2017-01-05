<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $employee_number
 * @property string $first_name
 * @property string $last_name
 * @property string $nick_name
 * @property string $email
 * @property resource $employee_picture
 *
 * @property Leave[] $leaves
 * @property LeaveEntitlement[] $leaveEntitlements
 * @property LeaveRequest[] $leaveRequests
 * @property LeaveRequestComment[] $leaveRequestComments
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_number', 'email'], 'required'],
            [['employee_picture'], 'string'],
            [['employee_number', 'first_name', 'last_name', 'nick_name'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 225],
            [['employee_number'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_number' => Yii::t('app', 'Employee Number'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'nick_name' => Yii::t('app', 'Nick Name'),
            'email' => Yii::t('app', 'Email'),
            'employee_picture' => Yii::t('app', 'Employee Picture'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaves()
    {
        return $this->hasMany(Leave::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveEntitlements()
    {
        return $this->hasMany(LeaveEntitlement::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveRequests()
    {
        return $this->hasMany(LeaveRequest::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveRequestComments()
    {
        return $this->hasMany(LeaveRequestComment::className(), ['employee_id' => 'id']);
    }
}
