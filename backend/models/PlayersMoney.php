<?php

namespace backend\models;

use Yii;
use common\helpers\Util;
use yii\behaviors\TimestampBehavior;
use backend\models\PlayersSignup;
/**
 * This is the model class for table "{{%players_money}}".
 *
 * @property int $id
 * @property int $sig_id 登记表主键id关联
 * @property int $type 类型:1全款2定金3补尾款
 * @property string $remark 备注
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class PlayersMoney extends \yii\db\ActiveRecord
{

     public $username;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%players_money}}';
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
            [['sig_id', 'type', 'remark'], 'required'],
            [['sig_id', 'type', 'created_at', 'updated_at'], 'integer'],
            [['remark'], 'string'],
            [[ 'username'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'sig_id'     => Yii::t('app', '登记表主键id关联'),
            'type'       => Yii::t('app', '类型'),//:1全款2定金3补尾款
            'remark'     => Yii::t('app', '备注'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
            'opeater' => Yii::t('app', '角色'),
            'opeater_childer' => Yii::t('app', '业绩人'),
            'username'        => Yii::t('app', '用户名称'),
        ];
    }

    public function getPlayersSignup()
    {
        return $this->hasOne(PlayersSignup::className(), ['id' => 'sig_id']);
    }
}
