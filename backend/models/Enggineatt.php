<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enggineatt".
 *
 * @property integer $id
 * @property integer $pin
 * @property string $dateatt
 * @property integer $verified
 * @property integer $status
 */
class Enggineatt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enggineatt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pin'], 'required'],
            [['pin', 'verified', 'status'], 'integer'],
            [['dateatt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pin' => Yii::t('app', 'Pin'),
            'dateatt' => Yii::t('app', 'Dateatt'),
            'verified' => Yii::t('app', 'Verified'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
