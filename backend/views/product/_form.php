<?php
use backend\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use common\helpers\Util;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Product */
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
                        <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'product_camp_period')->textInput(['maxlength'=>3]) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'begin_time')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '请选择开营时间', 'value'=>$model->begin_time?date('Y-m-d H:i',$model->begin_time):''],
                            'pluginOptions' => [
                                'autoclose'      => true,
                                'todayHighlight' => true,
                                'format'         => 'yyyy-mm-dd',
                                'minView'        => "month",
                            ]
                        ]); ?>
                        <?= $form->field($model, 'end_time')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '请选择结营时间', 'value'=>$model->end_time?date('Y-m-d H:i',$model->end_time):''],
                            'pluginOptions' => [
                                'autoclose'      => true,
                                'todayHighlight' => true,
                                'format'         => 'yyyy-mm-dd',
                                'minView'        => "month",
                            ]
                        ]); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'days')->textInput(['maxlength'=>3]) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
