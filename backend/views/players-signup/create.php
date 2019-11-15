<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\PlayersSignup */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Players Signup'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') . yii::t('app', 'Players Signup')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>

