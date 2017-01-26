<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_entitlement".
 *
 * @property integer $id
 * @property string $no_of_days
 * @property string $days_used
 * @property string $from_date
 * @property string $to_date
 * @property string $credited_date
 * @property string $note
 * @property integer $deleted
 * @property string $createed_by_name
 * @property integer $employee_id
 * @property integer $leave_type_id
 * @property integer $user_id
 *
 * @property Employee $employee
 * @property LeaveType $leaveType
 * @property User $user
 * @property LeaveHasLeaveEntitlement[] $leaveHasLeaveEntitlements
 */
class LeaveEntitlement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_entitlement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'leave_type_id', 'user_id'], 'required'],
            [['id', 'deleted', 'employee_id', 'leave_type_id', 'user_id'], 'integer'],
            [['no_of_days', 'days_used'], 'number'],
            [['from_date', 'to_date', 'credited_date'], 'safe'],
            [['note'], 'string', 'max' => 225],
            [['createed_by_name'], 'string', 'max' => 45],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['leave_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeaveType::className(), 'targetAttribute' => ['leave_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'no_of_days' => Yii::t('app', 'No Of Days'),
            'days_used' => Yii::t('app', 'Days Used'),
            'from_date' => Yii::t('app', 'From Date'),
            'to_date' => Yii::t('app', 'To Date'),
            'credited_date' => Yii::t('app', 'Credited Date'),
            'note' => Yii::t('app', 'Note'),
            'deleted' => Yii::t('app', 'Deleted'),
            'createed_by_name' => Yii::t('app', 'Createed By Name'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'leave_type_id' => Yii::t('app', 'Leave Type ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveType()
    {
        return $this->hasOne(LeaveType::className(), ['id' => 'leave_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveHasLeaveEntitlements()
    {
        return $this->hasMany(LeaveHasLeaveEntitlement::className(), ['leave_entitlement_id' => 'id']);
    }
}
