<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Product'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Update') . yii::t('app', 'Product')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
