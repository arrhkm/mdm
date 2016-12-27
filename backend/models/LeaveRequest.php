<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_request".
 *
 * @property integer $id
 * @property string $date_applied
 * @property string $comments
 * @property integer $employee_id
 * @property integer $leave_type_id
 *
 * @property Leave[] $leaves
 * @property Employee $employee
 * @property LeaveType $leaveType
 * @property LeaveRequestComment[] $leaveRequestComments
 */
class LeaveRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_applied'], 'safe'],
            [['employee_id', 'leave_type_id'], 'required'],
            [['employee_id', 'leave_type_id'], 'integer'],
            [['comments'], 'string', 'max' => 256],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
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
            'date_applied' => Yii::t('app', 'Date Applied'),
            'comments' => Yii::t('app', 'Comments'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'leave_type_id' => Yii::t('app', 'Leave Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaves()
    {
        return $this->hasMany(Leave::className(), ['leave_request_id' => 'id']);
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
    public function getLeaveRequestComments()
    {
        return $this->hasMany(LeaveRequestComment::className(), ['leave_request_id' => 'id']);
    }
}
