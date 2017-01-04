<?php 
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Employee;

/** 
* User request form
*/

class UserRequestForm extends Model
{
	public $email;
	//tambahan
	public $username;
	public $password;

	public function rules()
	{
		return [
			/*['email', 'trim'],
			['email', 'required'],
			['email', 'email'],*/

               ['email', 'trim'],
               ['email', 'required'],
               ['email', 'email'],
               ['email', 'string', 'max' => 255],
               [
                    'email', 'unique', 
                    'targetClass' => '\common\models\User', 
                    'message' => 'This email address has already been taken.'
               ],
               ['username', 'trim'],
               ['username','required'],
			//['email', 'exist'],
				//'targetClass'=> '\common\models\User', 
				//'filter'=>['status'=>User::STATUS_ACTIVE],
				//'message'=>'There is no user with such email'
		];
	}

	 /**
     * Sends an email with a link, for register new user.
     *
     * @return bool whether the email was send
     */
     public function sendEmail()
     {
     	if (!$this->validate())
     	{
     		return null;
     	} 

          if (Employee::find()->where(['email'=>$this->email])->One())
          {
     		$emp = Employee::findOne(['email'=>$this->email]);
     		
     		$user = new User();
     		$user->email = $this->email;
     		$user->username = $this->username;
     		$user->employee_id = $emp->id;
     		$user->save();
     		//return $user->save() ? $user : null;

     		if (!User::isPasswordResetTokenValid($user->password_reset_token)){
     			$user->generatePasswordResetToken();
     			if (!$user->save()) {
     				return false;
     			}
     		}

     		return Yii::$app
     			->mailer
     			->compose(
     				['html'=>'passwordForNewUser-html', 'test'=>'passwordForNewUser-text'],
     				['user'=>$user]
     			)
     			->setFrom([Yii::$app->params['supportEmail']=> Yii::$app->name .'robot'])
     			->setTo($this->email)
     			->setSubject('Password for new user '. Yii::$app->name)
     			->send();
     	}
          Yii::$app->session->setFlash('error', 'User register has already taken.');
     }
}
?>