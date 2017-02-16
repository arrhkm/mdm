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
 * @property string $leave_type_id
 * @property integer $user_id
 *
 * @property User $user
 * @property Employee $employee
 * @property LeaveType $leaveType
 * @property LeaveHasLeaveEntitlement[] $leaveHasLeaveEntitlements
 */
class LeaveEntitlement extends \yii\db\ActiveRecord
{
    public $first_name;
    public $name_type;
    public $all_employee;
    /**
     * @inheritdoc
     */

    /**
    * penambahan scenario 
    */
    const SCENARIO_1='default';
    const SCENARIO_INSERT = 'insert';
    const SCENARIO_INSERT_ALL = 'insert_all';
    public $period_year;//tambahan
    public $multiple_insert;

    public static function tableName()
    {
        return 'leave_entitlement';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_1=>[
                'no_of_days', 'days_used', 'from_date', 'to_date',
                'deleted', 'employee_id', 'leave_type_id', 'note', 
                'createed_by_name', 'user_id'
            ],
            self::SCENARIO_INSERT=>[
                'employee_id', 
                'no_of_days', 
                'leave_type_id',
                'user_id',  
                //'createed_by_name',
                'period_year',//tambahan
                'multiple_insert', 'all_employee',

            ],
            self::SCENARIO_INSERT_ALL=>[           
                //'employee_id',
                'no_of_days', 
                'leave_type_id',
                'user_id',                  
                'period_year',//tambahan
                'multiple_insert', 'all_employee',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_of_days', 'days_used', 'all_employee'], 'number'],
            [['no_of_days'], 'required', 'on'=>self::SCENARIO_INSERT],
            [['from_date', 'to_date', 'credited_date'], 'safe'],
            [['deleted', 'employee_id', 'leave_type_id', 'user_id'], 'integer'],
            [['employee_id', 'leave_type_id'], 'required',],
            [['note'], 'string', 'max' => 225],
            [['createed_by_name'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id'], 'on'=>self::SCENARIO_INSERT,'on'=>self::SCENARIO_1 ],
            [['leave_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeaveType::className(), 'targetAttribute' => ['leave_type_id' => 'id']],
            [['period_year'], 'required', 'on'=>self::SCENARIO_INSERT],
            [['multiple_insert', 'all_employee'], 'boolean'],
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
            'multiple_insert' => Yii::t('app', 'For insert leave entitlement all employee, click here'),
        ];
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
    public function getLeaveHasLeaveEntitlements()
    {
        return $this->hasMany(LeaveHasLeaveEntitlement::className(), ['leave_entitlement_id' => 'id']);
    }
    

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->isNewRecord)
        {
            $last = $this->find()->select(['id'])->orderBy(['(id)'=>SORT_DESC])->limit(1)->one();
            if($last)
            {
                $NEW_ID = (int)$last->id+1;
            }
            else {
                $NEW_ID= 1;
            }
            $this->id= $NEW_ID;
        }
        return true;
    }
    
}
