<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%jobs}}".
 *
 * @property string $id
 * @property string $queue
 * @property string $payload
 * @property int $attempts
 * @property string $reserved_at
 * @property string $available_at
 * @property string $created_at
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%jobs}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['queue', 'payload', 'attempts', 'available_at', 'created_at'], 'required'],
            [['payload'], 'string'],
            [['attempts', 'reserved_at', 'available_at', 'created_at'], 'integer'],
            [['queue'], 'string', 'max' => 191],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'queue' => Yii::t('app', 'Queue'),
            'payload' => Yii::t('app', 'Payload'),
            'attempts' => Yii::t('app', 'Attempts'),
            'reserved_at' => Yii::t('app', 'Reserved At'),
            'available_at' => Yii::t('app', 'Available At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
