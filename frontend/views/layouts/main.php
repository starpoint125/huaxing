<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use frontend\widgets\MenuView;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php !isset($this->metaTags['keywords']) && $this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->feehi->seo_keywords], 'keywords');?>
    <?php !isset($this->metaTags['description']) && $this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->feehi->seo_description], 'description');?>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <?=Html::cssFile('@web/static/css_b/resetcommon.css')?>
    <?=Html::cssFile('@web/static/css_b/index.css')?>
    <?=Html::jsFile('@web/static/js_b/NSW_Index.js')?>
    <?=Html::jsFile('@web/static/js_b/MSClass.js')?>
    <link rel="shortcut icon" href="/huaxing_favicon.ico" />



</head>

<?php $this->beginBody() ?>
<body class="body">
<div class="h_wrap">
    <div class="head">
        <div class="h_top">
            <span class="fr">
                <?php
                if (Yii::$app->getUser()->getIsGuest()) {
                    ?>
<!--                    <a href="--><?//= Url::to(['site/login']) ?><!--" class="signin-loader">--><?//= Yii::t('frontend', 'Hi, Log in') ?><!--</a>&nbsp; &nbsp;-->
<!--                    <a href="--><?//= Url::to(['site/signup']) ?><!--" class="signup-loader">--><?//= Yii::t('frontend', 'Sign up') ?><!--</a>-->
                <?php } else { ?>
<!--                    Welcome, --><?//= Html::encode(Yii::$app->user->identity->username) ?>
<!--                    <a href="--><?//= Url::to(['site/logout']) ?><!--" class="signup-loader">--><?//= Yii::t('frontend', 'Log out') ?><!--</a>-->
                <?php } ?>
                <a href="javascript:;" onclick="SetHome(this,window.location)" rel="nofollow"> 设为首页</a>|
                <a href="javascript:;" onclick="AddFavorite(window.location,document.title)" title="加入收藏" target="_blank">加入收藏</a>
            </span>
        </div>
        <div class="h_mid fw">
            <p class="logo fl"><a href="/"><img src="<?=Yii::$app->getRequest()->getBaseUrl()?>/static/images_b/logo.png" ></a></p>
            <!--搜索栏开始-->
            <div class="search fr">
                <form action="<?= Url::toRoute('search/index') ?>" method="get" >
                    <input class="stxt" type="text" name="q" value="请输入关键字" onfocus="if(this.value==defaultValue)this.value=''" onblur="if(this.value=='')this.value=defaultValue"/>
                    <input type="submit" class="sbtn" value="搜索"/>
                </form>
            </div>
        </div>
        <div class="h_nav">
         <?= MenuView::widget() ?>
        </div>
    </div>
</div>
<section class="container">
    <div class="speedbar"></div>
    <?= $content ?>
</section>
<!--底部开始-->
<div class="footer">
   <div class="f_nav">
      <p>@ 2008-2017 版权所有 <em>北京中教华兴科技有限公司</em><em>京ICP备13005197号-1</em><em>客服电话：010-68215070</em><span><a href="tencent://message/?uin=1003891780&amp;Site=&amp;Menu=yes"><img src="<?=Yii::$app->getRequest()->getBaseUrl()?>/static/images_b/qq.png" /> <b>考务服务</b></a></span></p><dl><dt><img src="<?=Yii::$app->getRequest()->getBaseUrl()?>/static/images_b/huaxingweixin.png" /></dt><dd>微信服务号</dd></dl><dl><dt><img src="<?=Yii::$app->getRequest()->getBaseUrl()?>/static/images_b/gongyeweixin.png" /></dt><dd>微信订阅号</dd></dl>
   </div>
</div>
</body>
</html>
<script type="text/javascript">
    function AddFavorite(sURL, sTitle) {
    try {
        window.external.addFavorite(sURL, sTitle);
    } catch (e) {
        try {
            window.sidebar.addPanel(sTitle, sURL, "");
        } catch (e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}
//设为首页 <a onclick="SetHome(this,window.location)" >设为首页</a>
function SetHome(obj, vrl) {
    try {
        obj.style.behavior = 'url(#default#homepage)';
        obj.setHomePage(vrl);
    } catch (e) {
        if (window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            } catch (e) {
                alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
            }
            var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
            prefs.setCharPref('browser.startup.homepage', vrl);
        }
    }
}
</script>
<script type="text/javascript">
function setContentTab(name, curr, n) {
    for (i = 1; i <= n; i++) {
        var menu = document.getElementById(name + i);
        var cont = document.getElementById("con_" + name + "_" + i);
        menu.className = i == curr ? "up" : "";
        if (i == curr) {
            cont.style.display = "block";
        } else {
            cont.style.display = "none";
        }
    }
}
</script>
<?php $this->endPage() ?>
