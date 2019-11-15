<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\models\form\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend', 'Sign up') . '-' . Yii::$app->feehi->website_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrap">
    <div class="site-signup article-content" style="width:500px; margin: 0 auto">
        <h1><?= Html::encode($this->title) ?></h1>
        <style>
             label {
                float: left;
                width: 103px;
                margin:15px 0 0 10px;
            }
            .huiyuan_indexx {
                width: 100%;
                height: 250px;
                margin-top: 20px;
                box-shadow: 0 0 5px #d8d5d5;
                margin-right: 5px;
                background: #fff;
                float: right;
            }
            .login_button {
                clear: both;
                width: 20%;
                height: 39px;
                line-height: 36px;
                background: #0066cc;
                border-radius: 30px;
                color: #fff;
                font-size: 18px;
                margin: 10px 0px 0 -70px;
                cursor: pointer;
                outline: none;
            }
             input {
                /*width: 80%;*/
                height: 40px;
                border-radius: 0;
                padding-left: 0px;
                font-size: 16px;
                border: none;
                border-bottom: 1px solid #000;
                outline: none;
            }
            .x-red-field-invalid{
                outline:#F00 double 1px;
            }
            .form-controls {
                width: 85%;
                height: 50px;
                line-height: 50px;
                position: relative;
                font-size: 16px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                margin-bottom: 36px;
            }
            p{
                margin:1px 0 0 120px;
            }
        </style>
        <p style="margin:10px 52px 0 0;"><?= Yii::t('frontend', 'Please fill out the following fields to signup') ?>:</p>

        <div class="huiyuan_indexx">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <br><br>
                <?= $form->field($model, 'username', ['template' => "<div style='position:relative'>{label}{input}\n{error}\n{hint}</div>"])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email', ['template' => "<div style='position:relative'>{label}{input}\n{error}\n{hint}</div>"])->textInput() ?>

                <?= $form->field($model, 'password', ['template' => "<div style='position:relative'>{label}{input}\n{error}\n{hint}</div>"])->passwordInput() ?>

                <div class="form-group" style="margin-left: 180px">
                    <?= Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'login_button', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
