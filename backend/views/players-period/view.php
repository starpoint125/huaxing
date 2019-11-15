<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PlayersPeriod */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Players Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-period-view">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'updated_at:datetime',
        ],
    ]) ?>

</div>
