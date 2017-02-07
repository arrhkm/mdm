<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_has_approval".
 *
 * @property integer $employee_id
 * @property integer $approval_id
 *
 * @property Approval $approval
 * @property Employee $employee
 */
class EmployeeHasApproval extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_has_approval';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'approval_id'], 'integer'],
            [['approval_id'], 'exist', 'skipOnError' => true, 'targetClass' => Approval::className(), 'targetAttribute' => ['approval_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => Yii::t('app', 'Employee ID'),
            'approval_id' => Yii::t('app', 'Approval ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproval()
    {
        return $this->hasOne(Approval::className(), ['id' => 'approval_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
}
