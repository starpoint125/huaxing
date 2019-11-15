<?php
namespace backend\models;
use common\helpers\Util;
use yii\behaviors\TimestampBehavior;
use Yii;
/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id id
 * @property string $product_name 产品名称
 * @property int $product_camp_period 营期
 * @property string $product_contect 产品介绍
 * @property int $begin_time 开始时间
 * @property int $days 天数
 * @property string $money 收费（元/人）
 * @property string $lead_info 领队信息
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'product_name','product_camp_period','begin_time','end_time','days','money',], 'required'],
            [['id', 'product_camp_period', 'days', 'created_at', 'updated_at'], 'integer'],
            // [['product_contect', 'lead_info'], 'string'],
            [['money'], 'number'],
            [['product_name'], 'string', 'max' => 70],
            [['product_camp_period'], 'string','min' => 1, 'max' => 3],
            [['id','product_name'], 'unique'],
        ];
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function beforeSave($insert)
    {
        $roles            = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        $insert           = $this->getIsNewRecord();
        $this->begin_time = strtotime(Yii::$app->request->post()['Product']['begin_time']);
        $this->end_time = strtotime(Yii::$app->request->post()['Product']['end_time']);
        if (!empty($roles)) {
            $this->opearter = array_keys($roles)[0];
        }
        return parent::beforeSave($insert);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                  => Yii::t('app', 'id'),
            'product_name'        => Yii::t('app', '产品名称'),
            'product_camp_period' => Yii::t('app', '营期'),
            // 'product_contect'  => Yii::t('app', '产品介绍'),
            'begin_time'          => Yii::t('app', '开营时间'),
            'end_time'            => Yii::t('app', '结营时间'),
            'days'                => Yii::t('app', '天数'),
            'money'               => Yii::t('app', '收费（元/人）'),
            // 'lead_info'        => Yii::t('app', '领队信息'),
            'created_at'          => Yii::t('app', '创建时间'),
            'updated_at'          => Yii::t('app', '更新时间'),
            'opearter'            => Yii::t('app', '部门'),
        ];
    }
}
