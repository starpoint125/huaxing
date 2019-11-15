<?php
use common\models\Options;
use frontend\models\Article;
use frontend\models\FriendlyLink;
use frontend\models\ArticleContent;
use frontend\widgets\ArticleListView;
use frontend\widgets\ScrollPicView;
use common\widgets\JsBlock;
use frontend\assets\IndexAsset;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\widgets\LinkPager;

use yii\helpers\Url;
IndexAsset::register($this);
$this->title = ( !empty($category) ? $category . " - " : "" ) . Yii::$app->feehi->website_title;
?>
<!--中间内容一-->
<div class="list">
    <div class="width1178 clearfix">

        <!-- 左边开始 -->
        <div class="sidebar_left" >
            <div class="column bj_survey"><?php echo $type == 'yqlj'?"友情链接":"合作伙伴";?></div>
            <ul class="menu">

                <li  class='on'>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['article/friend','type'=>empty($type)?"yqlj":"hzhb"]) ?>"
                    ><?= $type == 'yqlj'?"友情链接":"合作伙伴";?></a>
                </li>
            </ul>
        </div>
        <!-- 左边结束-->
        <!-- 右边开始 -->
        <div class="sidebar_right">
            <h2><?php echo $type == 'yqlj'?"友情链接":"合作伙伴";?></h2>
            <ul class="ky_news">
              <?php
                if(!empty($data)){
                    foreach ($data as $key=>$value){
               ?>
                        <strong><a target="_blank" href="<?php echo $value['url']; ?>" title="<?= $value['name']?>">
                            <img src="<?=Yii::$app->getRequest()->getBaseUrl().$value['image'] ?>" />
                        </a>
                        </strong>
              <?php
                    }
                }
              ?>
            </ul>
        </div>
    </div>
</div>
