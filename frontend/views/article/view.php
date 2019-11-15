<?php
/**
 * @var $this yii\web\View
 * @var $model frontend\models\Article
 * @var $commentModel frontend\models\Comment
 * @var $prev frontend\models\Article
 * @var $next frontend\models\Article
 * @var $recommends array
 * @var $commentList array
 */
use frontend\widgets\ArticleListView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use frontend\assets\ViewAsset;
use common\widgets\JsBlock;
use yii\helpers\Html;
use common\models\Category;
use yii\widgets\ActiveForm;
$this->title = $model->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords], 'keywords');
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description], 'description');
$this->registerMetaTag(['name' => 'tags', 'content' => call_user_func(function()use($model) {
    $tags = '';
    foreach ($model->articleTags as $tag) {
        $tags .= $tag->value . ',';
    }
    return rtrim($tags, ',');
    }
)], 'tags');
$this->registerMetaTag(['property' => 'article:author', 'content' => $model->author_name]);
$categoryName = $model->category ? $model->category->name : Yii::t('app', 'uncategoried');
ViewAsset::register($this);
?>
<!--中间内容一-->
<div class="list">
  <div class="width1178 clearfix">
<!-- 左边开始 -->

    <div class="sidebar_left" >
        <div class="column bj_survey"><?= Category::findOne(['id' =>$model->cid])['name'];?></div>
        <ul class="menu">
            <?php
            if(!empty($cates)) {
                foreach ($cates as $key => $value) {
                    $urls = explode(',', $value['url']);
                    $cat = explode(":", $urls[1]);
                    $template = explode(":", $urls[2]);
                    ?>
                    <li class='on'>
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['article/index', 'cat' => trim($cat[1], '"'), 'template' => trim(trim($template[1], '"'), '"}')]) ?>"><?php echo $value['name']; ?></a>

                    </li>
                    <?php
                }
            }else{
             ?>
                <li  class='on'>
                    <a href="#" ><?= Category::findOne(['id' =>$model->cid])['name'];?></a>
                </li>
            <?php }?>
        </ul>
    </div>
<!-- 左边结束-->
<!-- 右边开始 -->
    <div class="gu_sidebarR">
       <div class="xwxq">
       <h2><?= $model->title ?></h2>
       <div class="xwxq1" style="margin-left:0;">
<form><table border="0" cellspacing="0" cellpadding="0" align="center" style="margin:0 auto">
  <tbody><tr>
    <td>发布时间：<?= date("Y-m-d H:i:s",$model->created_at) ?></td>
    <td>文章来源：<?=  $model->author_name == 'admin'?"中教华兴":$model->author_name;?></td>
    <td height="30"></td>
<td>阅读次数:<span id="test"><?= $model->scan_count ?></span></td>
    <td>【<a class="content_big" onclick="xwxq2.style.fontSize='16px'">大</a><a class="content_middle" onclick="xwxq2.style.fontSize='14px';">中</a><a class="content_small" onclick="xwxq2.style.fontSize='12px';">小</a>】</td>
  </tr>
</tbody></table>
</form>
        </div>
        </div>
<div class="xwxq2" id="xwxq2" style="border-bottom:0px ">
<div class="TRS_Editor">
<?= $model->articleContent->content ?>
</div>
</div>
</div>
<!-- 右边 -->
</div>
</div>
