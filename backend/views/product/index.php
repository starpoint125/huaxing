<?php
use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use backend\grid\DateColumn;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = yii::t('app', 'Product');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?php //$this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],
                        'product_name',
                        'product_camp_period',
                        // 'product_contect:ntext',
                        [
                            'attribute' => 'begin_time',
                            'class'     => DateColumn::className(),
                            'format' => ['date', 'php:Y-m-d']
                        ],
                        [
                            'attribute' => 'end_time',
                            'class'     => DateColumn::className(),
                            'format' => ['date', 'php:Y-m-d'],
                            // 'value' => function($data){
                            //     return empty($data->end_time) ? date('Y-m-d'):'';
                            // }
                        ],
                        'days',
                        'money',
                        // 'lead_info:ntext',
                        // [
                        //     'attribute' => 'created_at',
                        //     'class'     => DateColumn::className(),
                        // ],
                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
