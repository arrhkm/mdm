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
	public $employee_id;

	public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['employee_id', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This Id Employee has already been taken.'],
        ];
    }

	public function signup()
    {
        if (!Employee::find()->where(['email'=>$this->email])->One())
        {
        	//throw new NotSupportedException('"signup" is not implemented.');        
        	Yii::$app->session->setFlash('error', 'There was no Employee registered with this email.');
            return null;
            if (!$this->validate())
            {
            	return null;
            }
        }
        else {
        $emp = Employee::find()->where(['email'=>$this->email])->One();
        $emp_id = $emp->id;
        $user = new User();
        //$emp = new Employee();
        
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->employee_id = $emp_id;
        
        //add 3 lines
        //$auth = Yii::$app->authManager;
        //$authorRole = $auth->getRole('author');
        //$auth->assign($authorRole, $user->getId());
        //--end 3 lines ---
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