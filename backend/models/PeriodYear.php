<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "period_year".
 *
 * @property integer $id
 * @property string $date_start
 * @property string $date_end
 * @property string $name_period
 * @property integer $date_day
 * @property integer $date_month
 * @property integer $date_year
 */
class PeriodYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'period_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start'], 'unique', 'message'=>'Data redudance'],
            [['name_period'], 'unique', 'message'=>'Nama Period redundance'],
            [['date_start'], 'required', 'message'=>'Data canot be empty'],
            // ['date_start', 'unique', 'message' => 'Please imput not redundandace data.'],
            [['date_end'], 'safe'],
            [['date_day', 'date_month', 'date_year'], 'integer'],
            [['name_period'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'name_period' => Yii::t('app', 'Name Period'),
            'date_day' => Yii::t('app', 'Date Day'),
            'date_month' => Yii::t('app', 'Date Month'),
            'date_year' => Yii::t('app', 'Date Year'),
        ];
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
