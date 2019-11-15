<?php
use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\CommonConst;
use backend\grid\DateColumn;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PlayersMoneySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Players Moneys');
$this->params['breadcrumbs'][] = yii::t('app', 'Players Money');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Html::a('返回', ['players-signup/index',], ['class' => 'btn btn-white btn-sm','title'=>'刷新','data-pjax'=>"0"]);
                ?>
                <?= Html::a('创建', ['players-money/create','player_id'=>Yii::$app->request->get('id')], ['class' => 'btn btn-white btn-sm fa fa-plus','title'=>'创建','data-pjax'=>"0"]);
                ?>
                <?= Html::a('删除', ['players-money/delete'], ['class' => 'btn btn-white btn-sm multi-operate  fa fa-trash-o','title'=>'删除','data-pjax'=>"0",'data-confirm'=>'真的要删除吗？']);
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],
                        [
                            'attribute'     => 'username',
                            'headerOptions' => ['width' => '10%'],
                            'value'         => 'playersSignup.username',
                            'filter'        =>  Html::activeTextInput($searchModel, 'username',['class'=>'form-control']),
                        ],
                        [
                            // 'headerOptions' => ['width' => '8%'],
                            'attribute' =>'type',
                            'filter'    => Html::activeDropDownList($searchModel, 'type', CommonConst::$paidin, ['prompt' => '全部', "class" => "form-control "]),
                            'value'     => function ($data){
                                if(!empty($data->type)){
                                    return CommonConst::$paidin[$data->type];
                                }else{
                                    return '其它';
                                }
                            },
                        ],
                        'remark:ntext',
                        [
                            'attribute'     => 'created_at',
                            'class'         => DateColumn::className(),
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{update}{delete}',
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
