<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

use common\helpers\CommonConst;
use backend\models\PlayersSignup;
/* @var $this yii\web\View */
/* @var $model backend\models\PlayersMoney */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Players Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-money-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sig_id',
            'type',
            'remark:ntext',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
</div>
