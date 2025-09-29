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
 *
 * @property Image[] $images
 */
class Ads extends \yii\db\ActiveRecord
{

    public $image_download;
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
            [['title', 'description', 'user_id', 'category_id'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            ['title', 'string'],
            [['date_created'], 'safe'],
            [['description'], 'string', 'max' => 255],
            ['image_download', 'file', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'user_id' => 'User ID',
            'category_id' => 'Категория',
            'date_created' => 'Дата создания',
            'image_download' => "Изображение",
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasMany(Image::class, ['ads_id' => 'id']);
    }

}
