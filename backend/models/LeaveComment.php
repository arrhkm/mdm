<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leave_comment".
 *
 * @property integer $id
 * @property integer $leave_id
 * @property integer $user_id
 * @property string $created
 * @property string $comments
 *
 * @property Leave $leave
 * @property User $user
 */
class LeaveComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leave_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_id', 'user_id'], 'required'],
            [['leave_id', 'user_id'], 'integer'],
            [['created'], 'safe'],
            [['comments'], 'string', 'max' => 255],
            [['leave_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leave::className(), 'targetAttribute' => ['leave_id' => 'id']],
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
            'leave_id' => Yii::t('app', 'Leave ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created' => Yii::t('app', 'Created'),
            'comments' => Yii::t('app', 'Comments'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeave()
    {
        return $this->hasOne(Leave::className(), ['id' => 'leave_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
