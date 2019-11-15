<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\PlayersMoney */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Players Money'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Players Money')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
    'player_id'=>Yii::$app->request->get('player_id'),
]) ?>
