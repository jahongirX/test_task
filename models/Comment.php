<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property string|null $create_date
 * @property int|null $status
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'body'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['create_date'], 'safe'],
            [['body'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'body' => 'Body',
            'create_date' => 'Create Date',
            'status' => 'Status',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id' => 'user_id']);
    }

    public function getLikes(){
        return [
            'negative' => Like::find()->where(['status' => 0,'comment_id' => $this->id])->count(),
            'positive' => Like::find()->where(['status' => 1,'comment_id' => $this->id])->count(),
        ];
    }
}
