<?php

namespace backend\models;

use Yii;
use common\helpers\Util;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%players_period}}".
 *
 * @property string $id id
 * @property string $qi_name 第几期名称
 * @property string $start_time 活动开始时期
 * @property string $end_time 活动结束时期
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class PlayersPeriod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%players_period}}';
    }
     public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function beforeSave($insert)
    {
        $id       = yii::$app->user->identity->id;
        $role     = Yii::$app->authManager->getRolesByUser($id);

        $insert = $this->getIsNewRecord();
        $this->start_time = strtotime(Yii::$app->request->post()['PlayersPeriod']['start_time']);
        $this->end_time = strtotime(Yii::$app->request->post()['PlayersPeriod']['end_time']);
        if (!empty($role)) {
            $this->opeater = array_keys($role)[0];
        }
        $this->opeater_childer = $id;
        return parent::beforeSave($insert);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qi_name', 'start_time', 'end_time','youhui'], 'required'],
            [[ 'created_at', 'updated_at'], 'integer'],
            [['qi_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'id'),
            'qi_name'    => Yii::t('app', '第几期名称'),
            'start_time' => Yii::t('app', '活动开始时期'),
            'end_time'   => Yii::t('app', '活动结束时期'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
            'youhui'     => Yii::t('app', '优惠(元)'),
        ];
    }



}
