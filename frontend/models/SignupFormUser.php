<?php 
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\SignupForm;
use common\models\Employee;
use common\models\User;
use yii\db\ActiveQuery;
use yii\base\NotSupportedException;
use yii\base\ErrorException;

class SignupFormUser extends SignupForm
{
	public function signup()
    {          
        if (!$this->validate()) {
            return null;
        }
        else {
        $emp = Employee::find()->where(['email'=>$this->email])->One();
        $emp_id = $emp->id;
        $user = new User();
        
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->employee_id = $emp_id;
        
        return $user->save() ? $user : null;
    	}
    }

    public function findByEmail($email)
    {
    	if (!Employee::findOne(['email'=>$email])){
    		return null;
    	}
    	return Employee::findOne(['email'=>$email]);

    }

}


?>