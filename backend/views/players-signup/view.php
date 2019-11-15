<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\models\Product;
use common\helpers\CommonConst;
/* @var $this yii\web\View */
/* @var $model backend\models\PlayersSignup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Players Signups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-signup-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            [
                'attribute'=>'province',
                'format'=>'raw',
                'value' => function($data){
                    return     \common\models\CommonRegion::find()->where(['region_id'=>$data->province])->one()['merge_name'];
                }
            ],
            [
                'attribute'     => 'national',
                'value'         => function($data){
                     return CommonConst::$minzu[$data->national];
                },
            ],
            'phone',
            [
                'attribute'     => 'sex',
                'value'         => function($data){
                     return [1=>'男',2=>'女'][$data->sex];
                },
            ],
            'age',
            'height',
            'weight',
            'parents_names',
            'hobby',
            'source',
            // 'product_id',
            [
                'attribute'     => 'product_name',
                'value'         => function($data){
                    $product_name = Product::find()->select(['product_name'])->where(['id'=>$data->product_id])->one();

                     return $product_name->product_name;
                },
            ],
            [
                'attribute'     => 'product_camp_period',
                'value'         => function($data){
                    $product_camp_period = Product::find()->select(['product_camp_period'])->where(['id'=>$data->product_id])->one();

                     return $product_camp_period->product_camp_period;
                },
            ],
            [
                'attribute' => 'status',
                'value'     => function($data){
                    return CommonConst::$status[$data->status];
                }
            ],
            'camp_money',
            'preferential',
            /*[
                'attribute' => 'paid_in',
                'value'     => function($data){
                    return CommonConst::$paidin[$data->paid_in];
                }
            ],*/
            'money_paid',
            'time_signup:datetime',
            [
                'attribute' => 'opeater_childer',
                'value'     => function($data){
                    $name = \backend\models\User::find()->select(['username'])->where(['id'=>trim($data->opeater_childer)])->one();
                    return (isset($name->username) && !empty($name->username))?$name->username:'';
                }
            ],
            'remark:ntext',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
