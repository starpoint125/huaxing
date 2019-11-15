<?php
use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\DateColumn;
use common\helpers\CommonConst;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PlayersSignupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Players Signups');
$this->params['breadcrumbs'][] = yii::t('app', 'Players Signup');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],
                        [
                            'attribute'     => 'product_name',
                            'headerOptions' => ['width' => '10%'],
                            'value'         => 'productName.product_name',
                            'filter'        =>  Html::activeTextInput($searchModel, 'product_name',['class'=>'form-control']),
                        ],
                        [
                            'attribute'     => 'product_camp_period',
                            'value'         => 'productName.product_camp_period',
                            'filter'        =>  Html::activeTextInput($searchModel, 'product_camp_period',['class'=>'form-control']),
                        ],
                        [
                            'attribute'     => 'username',
                        ],
                        [
                            'attribute'     => 'parents_names',
                        ],
                        [
                            'attribute'     => 'phone',
                        ],
                        [
                            'attribute'     => 'time_signup',
                            // 'class'         => DateColumn::className(),
                            'value'=>function($data){
                                return date('Y-m-d',$data->time_signup);
                            },
                        ],
                        [
                            'attribute'     => 'money_paid',
                            'value'         => function($data){
                                return $data->money_paid;
                            },
                        ],
                        [
                            'attribute'     => 'status',
                            'headerOptions' => ['width' => '10%'],
                            'value'         => function($data){
                                if(!empty($data->status)){
                                    return CommonConst::$status[$data->status];
                                }else{
                                    return '其它';
                                }
                            },
                            'filter'    => Html::activeDropDownList($searchModel, 'status', CommonConst::$status, ['prompt' => '全部', "class" => "form-control "]),
                        ],
                        [
                            'attribute'     => 'opeater_childer',
                            'value'         => function($data){
                                $name = \backend\models\User::find()->select(['username'])->where(['id'=>trim($data->opeater_childer)])->one();
                                return (isset($name->username) && !empty($name->username))?$name->username:'';
                            }
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{jifei}{view-layer}{update}{delete}',
                            'buttons' => [
                                'jifei' => function ($url, $model, $key) {
                                      return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => '激费'] ) ;
                                     },
                                ],
                            'headerOptions' => ['width' => '120'],
                        ],

                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
