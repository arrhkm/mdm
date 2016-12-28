<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave".
 *
 * @property integer $id
 * @property string $date
 * @property string $lenght_days
 * @property string $lenght_hours
 * @property string $start_time
 * @property string $end_time
 * @property integer $leave_request_id
 * @property integer $leave_type_id
 * @property integer $employee_id
 *
 * @property Employee $employee
 * @property LeaveRequest $leaveRequest
 * @property LeaveType $leaveType
 * @property LeaveComment[] $leaveComments
 * @property LeaveHasLeaveEntitlement[] $leaveHasLeaveEntitlements
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'start_time', 'end_time'], 'safe'],
            [['lenght_days', 'lenght_hours'], 'number'],
            [['leave_request_id', 'leave_type_id', 'employee_id'], 'required'],
            [['leave_request_id', 'leave_type_id', 'employee_id'], 'integer'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['leave_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeaveRequest::className(), 'targetAttribute' => ['leave_request_id' => 'id']],
            [['leave_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeaveType::className(), 'targetAttribute' => ['leave_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'lenght_days' => Yii::t('app', 'Lenght Days'),
            'lenght_hours' => Yii::t('app', 'Lenght Hours'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
            'leave_request_id' => Yii::t('app', 'Leave Request ID'),
            'leave_type_id' => Yii::t('app', 'Leave Type ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
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
    public function getLeaveRequest()
    {
        return $this->hasOne(LeaveRequest::className(), ['id' => 'leave_request_id']);
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
    public function getLeaveComments()
    {
        return $this->hasMany(LeaveComment::className(), ['leave_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaveHasLeaveEntitlements()
    {
        return $this->hasMany(LeaveHasLeaveEntitlement::className(), ['leave_id' => 'id']);
    }
}
