<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;

use yii;
use yii\base\Model;
class LeaveModel extends Model{
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
    
}