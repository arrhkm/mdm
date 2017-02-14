<?php
namespace app\models;

use Yii;
use yii\base\Model;

class CobaForm extends Model
{
    //public $id;
    public $username;
    public $password;
    public $hcb;
    public $cb_list;
    public $cb;
    
    public function rules()
    {
        return [
            [['username','password'], 'required'],
            [['password'], 'string', 'max' => 64],
            [['cb', 'hcb'], 'integer'],
            

        ];
    }
    
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

