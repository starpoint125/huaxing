<?php

namespace backend\models;
use backend\models\Product;

use common\helpers\Util;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "{{%players_signup}}".
 *
 * @property string $id
 * @property string $username 姓名
 * @property int $province 省份
 * @property int $city 市
 * @property int $area 区
 * @property string $national 民族
 * @property string $phone 电话
 * @property int $sex 性别1男2女
 * @property int $age 年龄
 * @property int $height 身高cm
 * @property int $weight 体重kg
 * @property string $parents_names 家长姓名
 * @property string $hobby 爱好
 * @property string $source 来源(百度/老营员/老营员推荐)
 * @property int $product_id 对应产品表(线路名,营期)
 * @property int $status 状态(1成功订单/2意向订单)
 * @property string $camp_money 营费
 * @property string $preferential 优惠(（优惠是按照每个月有不同的优惠力度的）)
 * @property int $paid_in 实收(1定金2定制服务费3尾款)
 * @property int $time_signup 报名时间
 * @property string $results_people 业绩人
 * @property string $remark 备注
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class PlayersSignup extends \yii\db\ActiveRecord
{
    public $product_camp_period;
    public $product_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%players_signup}}';
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
        $this->time_signup = strtotime(Yii::$app->request->post()['PlayersSignup']['time_signup']);
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
            [['username', 'province', 'phone', 'sex', 'age', 'height', 'weight', 'parents_names', 'product_id', 'remark','money_paid'], 'required'],
            [['id', 'sex', 'age', 'height', 'weight', 'product_id', 'status', 'paid_in',  'created_at', 'updated_at','opeater_childer'], 'integer'],
            [['camp_money','money_paid'], 'number'],
            [['remark'], 'string'],
            [['username', 'parents_names','opeater'], 'string', 'max' => 50],
            [['national'], 'string', 'max' => 5],
            [['phone'], 'string', 'max' => 11],
            [['hobby', 'source', 'preferential', 'results_people'], 'string', 'max' => 255],
            [['id','username'], 'unique'],
            [[ 'product_camp_period','product_name','opeater','money_paid'], 'safe'],
        ];
    }


    public function getProductName()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                  => Yii::t('app', 'ID'),
            'username'            => Yii::t('app', '姓名'),
            'province'            => Yii::t('app', '省份'),
            'city'                => Yii::t('app', '市'),
            'area'                => Yii::t('app', '区'),
            'national'            => Yii::t('app', '民族'),
            'phone'               => Yii::t('app', '电话'),
            'sex'                 => Yii::t('app', '性别'),
            'age'                 => Yii::t('app', '年龄'),
            'height'              => Yii::t('app', '身高cm'),
            'weight'              => Yii::t('app', '体重kg'),
            'parents_names'       => Yii::t('app', '家长姓名'),
            'hobby'               => Yii::t('app', '爱好'),
            'source'              => Yii::t('app', '来源'),//(百度/老营员/老营员推荐)
            'product_id'          => Yii::t('app', '产品名称'),//对应产品表(线路名,营期)
            'status'              => Yii::t('app', '状态'),//(1成功订单/2意向订单)
            'camp_money'          => Yii::t('app', '营费'),
            'preferential'        => Yii::t('app', '优惠期'),
            'paid_in'             => Yii::t('app', '实收'),//(1定金2定制服务费3尾款)
            'time_signup'         => Yii::t('app', '报名时间'),
            'opeater_childer'      => Yii::t('app', '业绩人'),
            'remark'              => Yii::t('app', '备注'),
            'created_at'          => Yii::t('app', '创建时间'),
            'updated_at'          => Yii::t('app', '更新时间'),
            'product_camp_period' => Yii::t('app', '营期'),
            'product_name'        => Yii::t('app', '产品名称'),
            'opeater'             => Yii::t('app', '部门'),
            'money_paid'          => Yii::t('app', '金额(元)'),
        ];
    }
}
