<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%common_region}}".
 *
 * @property string $region_id 地区id
 * @property string $region_name 地区名称
 * @property string $parent_id 父id
 * @property string $short_name 简称
 * @property string $region_level 地区等级
 * @property string $city_code 城市编码
 * @property string $zip_code 邮政编码
 * @property string $merge_name 合并名称
 * @property string $ing 经度
 * @property string $lat 纬度
 * @property string $pin_yin 拼音
 * @property string $region_status 地区状态
 */
class CommonRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%common_region}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id'], 'required'],
            [['region_id', 'parent_id', 'region_level', 'city_code', 'zip_code', 'region_status'], 'integer'],
            [['region_name', 'short_name', 'merge_name', 'ing', 'lat', 'pin_yin'], 'string', 'max' => 255],
            [['region_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id'     => Yii::t('app', '地区id'),
            'region_name'   => Yii::t('app', '地区名称'),
            'parent_id'     => Yii::t('app', '父id'),
            'short_name'    => Yii::t('app', '简称'),
            'region_level'  => Yii::t('app', '地区等级'),
            'city_code'     => Yii::t('app', '城市编码'),
            'zip_code'      => Yii::t('app', '邮政编码'),
            'merge_name'    => Yii::t('app', '合并名称'),
            'ing'           => Yii::t('app', '经度'),
            'lat'           => Yii::t('app', '纬度'),
            'pin_yin'       => Yii::t('app', '拼音'),
            'region_status' => Yii::t('app', '地区状态'),
        ];
    }
}
