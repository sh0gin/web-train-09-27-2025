<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $title
 *
 * @property Ads[] $ads
 */
class Status extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Ads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ads::class, ['status_id' => 'id']);
    }

    public static function getId($status) {
        return static::findOne(['title' => $status])?->id;
    }

    public static function getTitle($id) {
        return static::findOne($id)?->title;
    }

}
