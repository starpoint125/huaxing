<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\PlayersPeriod */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Players Period'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Players Period')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
