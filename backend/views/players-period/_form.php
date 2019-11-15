<?php

use backend\widgets\ActiveForm;
use common\helpers\CommonConst;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use common\helpers\Util;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\PlayersPeriod */
/* @var $form backend\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'form-horizontal'
                    ]
                ]); ?>
                <div class="hr-line-dashed"></div>
                    <?= $form->field($model, 'qi_name')->textInput(['maxlength' => 50]) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'start_time')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '请选择开始时间', 'value'=>$model->start_time?date('Y-m-d',$model->start_time):''],
                            'pluginOptions' => [
                                'autoclose'      => true,
                                'todayHighlight' => true,
                                'format'         => 'yyyy-mm-dd',
                                'minView'        => "month",
                            ]
                        ]); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'end_time')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '请选择结束时间', 'value'=>$model->end_time?date('Y-m-d',$model->end_time):''],
                            'pluginOptions' => [
                                'autoclose'      => true,
                                'todayHighlight' => true,
                                'format'         => 'yyyy-mm-dd',
                                'minView'        => "month",
                            ]
                        ]); ?>
                        <div class="hr-line-dashed"></div>

                         <?= $form->field($model, 'youhui')->textInput(['maxlength' => 3]) ?>
                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
