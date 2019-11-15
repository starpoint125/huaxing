<?php

use backend\widgets\ActiveForm;
use backend\models\PlayersSignup;
use kartik\select2\Select2;
use common\helpers\Util;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\helpers\CommonConst;
/* @var $this yii\web\View */
/* @var $model backend\models\PlayersMoney */
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

                        <?php
                            if($this->context->action->id != 'update') {
                                $a = PlayersSignup::find()->select(['id','username'])->where(['id'=>$player_id])->one();

                        ?>
                        <?= Html::activeHiddenInput($model,'sig_id',array('value'=>$player_id)) ?>
                        <?= $form->field($model, 'username')->textInput(['value'=>$a->username,'disabled'=>'disabled']) ?>
                        <?php }else{?>
                            <?= $form->field($model, 'username')->textInput(['value'=>PlayersSignup::find()->select(['id','username'])->where(['id'=>$model->sig_id])->one()->username,'disabled'=>'disabled']) ?>
                        <?php }?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'type')->dropDownList(CommonConst::$paidin, ['prompt'=>'请选择','style'=>'width:500px',])?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>



                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
