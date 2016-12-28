<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_request_comment".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property integer $leave_request_id
 * @property integer $user_id
 * @property string $created
 * @property string $created_by_name
 * @property string $comments
 *
 * @property Employee $employee
 * @property LeaveRequest $leaveRequest
 * @property User $user
 */
class LeaveRequestComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_request_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'leave_request_id', 'user_id'], 'integer'],
            [['leave_request_id'], 'required'],
            [['created'], 'safe'],
            [['created_by_name', 'comments'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['leave_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeaveRequest::className(), 'targetAttribute' => ['leave_request_id' => 'id']],
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
            'employee_id' => Yii::t('app', 'Employee ID'),
            'leave_request_id' => Yii::t('app', 'Leave Request ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created' => Yii::t('app', 'Created'),
            'created_by_name' => Yii::t('app', 'Created By Name'),
            'comments' => Yii::t('app', 'Comments'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
