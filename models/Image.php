<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $title
 * @property string $exception
 */
class Image extends \yii\db\ActiveRecord
{

    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'extension'], 'required'],
            [['title', 'extension'], 'string', 'max' => 255],
            ['image', 'file', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024*2]

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
            'extension' => 'extension',
        ];
    }

}
