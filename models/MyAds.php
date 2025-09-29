<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property int $category_id
 * @property string $date_created
 * @property int $status_id
 *
 * @property Image[] $images
 * @property Status $status
 * @property User $user
 */
class MyAds extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'user_id', 'category_id', 'status_id'], 'required'],
            [['user_id', 'category_id', 'status_id'], 'integer'],
            [['date_created'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'description' => 'Description',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'date_created' => 'Date Created',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::class, ['ads_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
