<?php

namespace mdm\admin\models\form;

use Yii;
//use mdm\admin\models\User;
use yii\base\Model;
use common\models\User;

/**
 * Description of ChangePassword
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class ChangePasswordAdmin extends Model
{
    public $oldPassword;
    public $newPassword;
    public $retypePassword;
    //tambahan
    public $id;
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newPassword', 'retypePassword'], 'required'],
            //[['oldPassword'], 'validatePassword'],
            [['newPassword'], 'string', 'min' => 6],
            [['id'], 'integer'],
            [['retypePassword'], 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        /* @var $user User */
        
        $user = Yii::$app->user->identity;
        
        if (!$user || !$user->validatePassword($this->oldPassword)) {
            $this->addError('oldPassword', 'Incorrect old password.');
        }
        
        if (!$user=='admin'){
            $this->addError('', 'User bukan admin');
        }
    }



    /**
     * Change password.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function change()
    {
        if ($this->validate()) {
            /* @var $user User */
            $user = Yii::$app->user->identity;
            $user->setPassword($this->newPassword);
            $user->generateAuthKey();
            if ($user->save()) {
                return true;
            }
        }

        return false;
    }



    public function changeAdmin($id)
    {
        
        if ($this->validate()) {
            /* @var $user User */
        
            //$user = User::findOne(['id' => $id]);
            $user = Yii::$app->user->findIdentity($id);
            if ($user){
                
                return true;
            }
            else {
                return false;
            }

            /*$user->password_hash = $this->setPassword($this->newPassword);
            if ($user->save()) {
                return true;
            }
            else {
                $this->addError('', 'Password tidak tersimpan');
            }*/
        }


        return false;
    }

    public function setPassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
}
