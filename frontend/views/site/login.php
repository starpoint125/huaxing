<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

/* @var $this yii\web\View */
/* @var $form \yii\bootstrap\ActiveForm*/
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login') . '-' . Yii::$app->feehi->website_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrap">
    <div class="site-login article-content" style="width:500px;margin: 0 auto;text-align: center">
        <h1><?= Html::encode($this->title) ?></h1>
        <style>
            label {
                float: left;
                width: 103px;
                margin:13px 0 0 10px;
            }

            div.row input{
                margin-right: 100px;
            }
            .huiyuan_indexx {
                width: 100%;
                height: 200px;
                margin-top: 25px;
                box-shadow: 0 0 5px #d8d5d5;
                margin-right: 5px;
                background: #fff;
                float: right;
            }
            #login_button {
                clear: both;
                width: 20%;
                height: 39px;
                line-height: 36px;
                background: #0066cc;
                border-radius: 30px;
                color: #fff;
                font-size: 18px;
                margin: 0 0 0 100px;
                cursor: pointer;
                outline: none;
                top:10px;
            }

            input {
                /*width: 80%;*/
                height: 40px;
                border-radius: 0;
                padding-left: 0px;
                font-size: 16px;
                border: none;
                border-bottom: 1px solid #ccc;
                outline: none;
            }


        </style>

        <div class="huiyuan_indexx">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-login']); ?>
                <br>
                <?= $form->field($model, 'username', ['template' => "<div style='position:relative'>{label}{input}\n{error}\n{hint}</div>"])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password', ['template' => "<div style='position:relative'>{label}{input}\n{error}\n{hint}</div>"])->passwordInput() ?>

                <?= $form->field($model, 'rememberMe', ['labelOptions'=>['style'=>'margin:0 0 0 200px']])->checkbox(['style'=>'margin-right:0px;position:relative;top:-2px'])?>

                <div class="form-group" style="color:#999;margin:10px 45px 0 0;">
                     <?= Html::a(Yii::t('frontend', 'reset it'), ['site/request-password-reset']) ?>
                </div>

                <div class="form-group" style="margin:20px 100px 0 0;">
                    <?= Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn-primary','id'=>'login_button', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
