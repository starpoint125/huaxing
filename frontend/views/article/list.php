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
    <?php
            if(isset($keyword) && !empty($keyword)){
                $flag =  $keyword;
            }elseif (isset($template) && !empty($template) && $template != 'list') {
                $flag =  $template;
            }else{
                $flag =  $cate;
            }
    ?>
<!-- 左边开始 -->
    <div class="sidebar_left" >
        <div class="column bj_survey"><?php echo $flag;?></div>
        <ul class="menu">
        <?php
            if(!empty($cates)){
            foreach ($cates as  $key =>$value) {
                $urls     = explode(',', $value['url']);
                $cat      = explode(":", $urls[1]);
                $template = explode(":", $urls[2]);
        ?>
             <li  class='on'>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['article/index', 'cat'=>trim($cat[1],'"'),'template'=>trim(trim($template[1],'"'),'"}')])?>" ><?php echo $value['name'];?></a>

            </li>
        <?php
            }
        }else{
        ?>
             <li  class='on'>
                <a href="#" ><?php echo $flag;?></a>

            </li>
        <?php
        }
        ?>


        </ul>
    </div>
<!-- 左边结束-->
<!-- 右边开始 -->
    <div class="sidebar_right">
        <h2><?php echo $flag;?></h2>
        <ul class="ky_news">
            <?php
                if (!empty($dataProvider)) {
                    foreach ($dataProvider as $key => $value) {
            ?>
            <li>
                <a href="<?php echo Yii::$app->urlManager->createUrl(["view/".$value['id'],"cat"=>$ccat]);?>"
                target="_blank"><?php
                    echo $value['title'];?></a>
                <p><?php echo $value['summary'];?></p>
                <span><?php echo date("Y-m-d",$value['updated_at'])?></span>
            </li>
            <?php
                    }
                }
            ?>
        </ul>
        <div class="duty_pag">
           <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
           ?>
        </div>
     </div>
</div>
</div>
