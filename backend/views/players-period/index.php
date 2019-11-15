<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlayersPeriodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Players Periods';
$this->params['breadcrumbs'][] = yii::t('app', 'Players Period');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?= Bar::widget() ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => CheckboxColumn::className()],

                        'qi_name',
                        [
                            'attribute' => 'start_time',
                            'value'=>function($data){
                                return date('Y-m-d',$data->start_time);
                            },
                        ],
                        [
                            'attribute' => 'end_time',
                            'value'=>function($data){
                                return date('Y-m-d',$data->end_time);
                            },
                        ],
                        'youhui',
                        'created_at:datetime',
                        // 'updated_at',

                        ['class' => ActionColumn::className(),],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
