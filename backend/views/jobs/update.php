<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Jobs */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Jobs'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Jobs')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
