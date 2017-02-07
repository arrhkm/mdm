<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "approval".
 *
 * @property integer $id
 * @property string $approval_name
 * @property integer $level
 * @property integer $employee_id
 * @property integer $location_id
 *
 * @property Employee $employee
 * @property Location $location
 * @property EmployeeHasApproval[] $employeeHasApprovals
 */
class Approval extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $first_name;
    public $employee_number;
    public $location_name;
    public static function tableName()
    {
        return 'approval';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'employee_id', 'location_id'], 'required'],
            [['level', 'employee_id', 'location_id'], 'integer'],
            [['approval_name'], 'string', 'max' => 45],
            //[['level'], 'unique'],
            [['employee_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'approval_name' => Yii::t('app', 'Approval Name'),
            'level' => Yii::t('app', 'Level'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'location_id' => Yii::t('app', 'Location ID'),
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
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeHasApprovals()
    {
        return $this->hasMany(EmployeeHasApproval::className(), ['approval_id' => 'id']);
    }
}
