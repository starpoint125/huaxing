<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-06-21 11:07
 */
/**
 * @var $this yii\web\View
 * @var $model frontend\models\Article
 */
use frontend\models\Article;
use yii\helpers\Url;
$this->title = $model->title . '-' . Yii::$app->feehi->website_title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords], 'keywords');
$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description], 'description');
$this->registerMetaTag(['name' => 'tags', 'content'=> call_user_func(function()use($model) {
    $tags = '';
    foreach ($model->articleTags as $tag) {
        $tags .= $tag->value . ',';
    }
    return rtrim($tags, ',');
}
)], 'tags');
?>

<div class="list">
  <div class="width1178 clearfix">
<!-- 左边开始 -->
    <div class="sidebar_left">
        <div class="column bj_survey"><?= $model->title ?></div>
        <ul class="menu">
        <?php
            foreach ($menus as $menu) {
                $url = Url::to(['page/view', 'name'=>$menu['sub_title']]);
                $current = '';
                if (Yii::$app->request->get('id', '') == $menu->id) {
                    $current = " current-menu-item current-page-item ";
                }

                echo "<li class='on'><a href='{$url}?id={$id}'>{$menu->title}</a></li>";
            }
        ?>
        </ul>
    </div>
<!-- 左边结束-->
<!-- 右边开始 -->
    <div class="content_right">
          <h2><?= $model->title ?></h2>
            <div class="contents">
                <?= $model->articleContent->content ?>
            </div>
    </div>
<!-- 右边 -->
</div>
</div>



