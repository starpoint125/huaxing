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
/* @var $model backend\models\PlayersSignup */
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

                        <?= $form->field($model, 'username')->textInput(['maxlength' => 50]) ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'province')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(\common\models\CommonRegion::find()->all(),'region_id','merge_name'),
                            'language'      => 'en',
                            'size'          => 7,
                            'options'       => ['placeholder' => '请选择'],
                            'pluginOptions' => ['allowClear' => true],
                        ]); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'national')->dropDownList(CommonConst::$minzu); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'phone')->textInput(['maxlength' => 11]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'sex')->dropDownList(CommonConst::$sex); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'age')->textInput(['maxlength' => 3]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'height')->textInput(['maxlength' => 4]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'weight')->textInput(['maxlength' => 4]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'parents_names')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'hobby')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(\backend\models\Product::find()->all(),'id','product_name'),
                            'language'      => 'en',
                            'size'          => 7,
                            'options'       => ['placeholder' => '请选择'],
                            'pluginOptions' => ['allowClear' => true],
                        ]); ?>


                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'preferential')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(\backend\models\PlayersPeriod::find()->all(),'id','qi_name'),
                            'language'      => 'en',
                            'size'          => 7,
                            'options'       => ['placeholder' => '请选择'],
                            'pluginOptions' => ['allowClear' => true],
                        ]); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'camp_money')->textInput(['maxlength' => 10,'readonly'=>'readonly']) ?>
                        <div class="hr-line-dashed" style="display:none;"></div>

                        <?php //$form->field($model, 'paid_in')->dropDownList(CommonConst::$paidin); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'money_paid')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>

                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'time_signup')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '请选择开始时间', 'value'=>$model->time_signup?date('Y-m-d H:i',$model->time_signup):''],
                            'pluginOptions' => [
                                'autoclose'      => true,
                                'todayHighlight' => true,
                                'format'         => 'yyyy-mm-dd',
                                'minView'        => "month",
                            ]
                        ]); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
                        <div class="hr-line-dashed"></div>
                        <?php
                            $id       = yii::$app->user->identity->id;
                            $role     = Yii::$app->authManager->getRolesByUser($id);

                            if (empty($role) || strstr( array_keys($role)[0],'财务')) {
                        ?>
                            <?= $form->field($model, 'status')->dropDownList(CommonConst::$status); ?>
                        <?php
                            }else{
                        ?>
                            <?= $form->field($model, 'status')->dropDownList(CommonConst::$statuss); ?>
                        <?php }?>

                        <div class="hr-line-dashed"></div>
                        <?= $form->defaultButtons() ?>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#playerssignup-product_id").change(function(event) {
        var money = $(this).val();
        $.ajax({
           url: "<?php echo \Yii::$app->getUrlManager()->createUrl('players-signup/selname') ?>",
           data: {id: money},
           success: function(data) {
               $("#playerssignup-camp_money").val(data);
           }
        });
    });

     $("#playerssignup-preferential").change(function(event) {
        var qishu = $(this).val();
        $.ajax({
           url: "<?php echo \Yii::$app->getUrlManager()->createUrl('players-signup/automoey') ?>",
           data: {id: qishu},
           success: function(data) {
                var  mm = $("#playerssignup-camp_money").val();
                var  mmm= mm-data;
               $("#playerssignup-money_paid").val(mmm);
           }
        });
    });
</script>
