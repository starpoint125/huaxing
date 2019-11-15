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
IndexAsset::register($this);
$this->title = ( !empty($category) ? $category . " - " : "" ) . Yii::$app->feehi->website_title;
?>
<div class="fullSlide">
  <div class="bd">
    <ul style="position: relative; ">
    <?php
        $banner = Options::getBannersByType('index');
        if (is_array($banner) && !empty($banner)) {
            foreach ($banner as $key => $value) {
                if ($value['status'] == 1) {
    ?>
        <li>
            <a href="#"><img src="<?= $value['img']?>"></a>
        </li>
    <?php
                }
            }
        }
    ?>
    </ul>
  </div>
  <div class="hd">
    <ul>
     <?php
        if (is_array($banner) && !empty($banner)) {
            foreach ($banner as $key => $value) {
                if ($value['status'] == 1) {
    ?>
            <li class="on"><?php echo $key;?></li>
     <?php
                }
            }
        }
    ?>

    </ul>
  </div>
  <span class="prev png"></span> <span class="next png"></span> </div>
  <!--中间内容一-->
<div class="zjnr">
    <div class="jl_indexMain">
        <div class="jl_indexMainFir">
            <!--左侧开始-->
            <div class="jl_indexMainFirSlider">
                <div class="jl_img">
                    <div class="jl_slide_tab">
                        <div class="jl_main index_foucs" id="jl_mainz">
                            <ul id="jl_content1" class="foucs01">
                                <?php
                                        $indexPic = Options::getIndexBannerPic('sidebar_right');
                                        if (is_array($indexPic) && !empty($indexPic)) {
                                            foreach ($indexPic as $key => $value) {
                                ?>
                                    <li class="foucs02">
                                        <a href="<?php echo $value['url'];?>" target="<?php echo $value['target'];?>"><img src="<?=Yii::$app->getRequest()->getBaseUrl().$value['ad'];?>" width="370" height="210/"></a>
                                        <h1>
                                            <a href="<?php echo $value['url'];?>" target="_blank" title="<?php echo $value['desc'];?>"><?php echo $value['desc'];?></a>
                                        </h1>
                                    </li>
                                <?php
                                            }
                                        }
                                ?>
                            </ul>
                        </div>
                        <div class="jl_slidediv scy_xj_qh">
                            <ul class="jl_tab_btn scy_tab_qhxj" id="jl_myTab_btns1" style="padding: 0px; margin: 0px; list-style: none; font-size: 0px;">
                                <?php
                                    if (is_array($indexPic) && !empty($indexPic)) {
                                            foreach ($indexPic as $key => $value) {
                                ?>
                                    <li  style="font-size: 12px; overflow: hidden;" class="active">&nbsp;</li>
                                <?php
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <script type="text/javascript">
                        new Marquee(
                            {
                                MSClassID : "jl_mainz",
                                ContentID : "jl_content1",
                                TabID     : "jl_myTab_btns1",
                                Direction : 2,
                                Step      : 0.1,
                                Width     : 370,
                                Height    : 210,
                                Timer     : 20,
                                DelayTime : 5000,
                                WaitTime  : 5,
                                ScrollStep: 490,
                                SwitchType: 2,
                                AutoStart : 1
                            })
                    </script>
                </div>
            </div>
            <!--左侧结束-->
            <script type="text/javascript">
                function show(){
                    var a_b = document.getElementById("a_b");
                    var b_a = document.getElementById("b_a");
                    var a_b_ul = document.getElementById("a_b_ul");
                    var b_a_ul = document.getElementById("b_a_ul");

                    b_a.className = 'on';
                    a_b.className = '';
                    a_b_ul.style.display='block';
                    b_a_ul.style.display='none';
                }
                function show1(){
                    var a_b = document.getElementById("a_b");
                    var b_a = document.getElementById("b_a");
                    var a_b_ul = document.getElementById("a_b_ul");
                    var b_a_ul = document.getElementById("b_a_ul");

                    a_b.className = 'on';
                    b_a.className = '';
                    a_b_ul.style.display='none';
                    b_a_ul.style.display='block';
                }
            </script>
            <div class="jl_indexMainFirRight js-tab">
                <h1>
                    <a href="#"  id="a_b" onmouseover="show()" >公司要闻</a>
                    <a href="#"  class="on" id="b_a" onmouseover="show1()" >重点关注</a>
                    <a href="/?cat=news_center&template=list" class="more" target="_blank">更多</a>
                </h1>
                <ul id="a_b_ul">
                    <?php
                        $fource_news_a = Article::find()->where(['cid'=>8,'status'=>1])->with('category')->limit(4)->orderBy("id desc")->all();
                        if(is_array($fource_news_a) && !empty($fource_news_a)){
                            foreach ($fource_news_a as $key => $value) {
                    ?>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl("view/".$value['id'])?>" target="_blank" title="<?php echo $value['title']?>"><?php echo $value['title']?></a><span style="font-size:13px;">[<?php echo date("m-d",$value['created_at'])?>]</span></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
                <ul style="display:none;" id="b_a_ul">
                    <?php
                        $fource_news_b = Article::find()->where(['cid'=>9,'status'=>1])->with('category')->limit(4)->orderBy("sort desc")->all();
                        if(is_array($fource_news_b) && !empty($fource_news_b)){
                            foreach ($fource_news_b as $key => $value) {
                    ?>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl("view/".$value['id'])?>" target="_blank" title="<?php echo $value['title']?>"><?php echo $value['title']?></a><span style="font-size:13px;"><?php echo date("m-d",$value['created_at'])?>]</span></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!--右侧-->
        <div class="xxgg_index">
            <h2><a href="#">信息公告</a><a href="<?php echo Yii::$app->urlManager->createUrl(["article/index",'cat'=>'messgg','template'=>'list'])?>" class="more"  target="_blank">更多</a></h2>
            <div id="quertion02">
            <?php
                $messgg = Article::find()->where(['cid'=>6,'status'=>1])->with('category')->orderBy("sort desc")->all();
            ?>
                <ul>
                    <?php
                        if(is_array($messgg) && !empty($messgg)){
                            foreach ($messgg as $key => $value) {
                    ?>
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl("view/".$value['id'])?>" target="_blank"><?php echo $value['title'];?></a></li>

                    <?php
                            }
                        }
                    ?>

                </ul>
            </div>
        </div>
        <!--右侧-->
    </div>
    <!--第二部分-->
    <div class="er_indexMain">
        <!--左侧-->
        <script type="text/javascript">
                function show2(){
                    var z_y = document.getElementById("z_y");
                    var y_z = document.getElementById("y_z");
                    var z_y_div = document.getElementById("z_y_div");
                    var y_z_div = document.getElementById("y_z_div");

                    y_z.className = 'on';
                    z_y.className = '';
                    z_y_div.style.display='block';
                    y_z_div.style.display='none';
                }
                function show3(){
                    var z_y = document.getElementById("z_y");
                    var y_z = document.getElementById("y_z");
                    var z_y_div = document.getElementById("z_y_div");
                    var y_z_div = document.getElementById("y_z_div");

                    z_y.className = 'on';
                    y_z.className = '';
                    z_y_div.style.display='none';
                    y_z_div.style.display='block';
                }
            </script>
        <div class="jyb_index">
            <div class="xyjy01 js-tab_jy">
                <h1>
                    <a href="#" id="z_y" onmouseover="show2()">教育部-PTC校园计划</a>
                    <a href="#" class="on" id="y_z" onmouseover="show3()">工业和信息化CAD</a>
                </h1>
                <div class="jynr" id="z_y_div">
                    <div class="bingtu"><a href="/page/xmbj.html?id=3" class="a1 hover" target="_blank">项目背景</a><a href="/page/xmnr.html?id=3"  class="a2 hover" target="_blank">项目内容</a><a href="/page/xmjy.html?id=3" class="a3 hover" target="_blank">项目结业</a><a href="/page/sblc.html?id=3" class="a4 hover" target="_blank">申报流程</a><a href="/page/xmpx.html?id=3" class="a5 hover" target="_blank">项目培训</a></div>
                    <p class="tip" id="tip1"><span><a href="/page/xmbj.html?id=3" target="_blank">教育部职成司和美国参数技术软件有限公司联合推出的面向中职院校的合作计划......</a></span></p>
                    <p class="tip" id="tip2"><span><a href="/page/xmnr.html?id=3" target="_blank">教育部职成司与美国PTC公司联合授予“教育部-PTC校园计划项目学校”称号......</a></span></p>
                    <p class="tip" id="tip3"><span><a href="/page/xmjy.html?id=3" target="_blank">为规范和提高项目学校教师的专业授课水平，设立培训和考核标准<br />......</a></span></p>
                    <p class="tip" id="tip4"><span><a href="/page/xmpx.html?id=3" target="_blank">通过学习和考核，获得成绩证明专项证书<br />......</a></span></p>
                    <p class="tip" id="tip5"><span><a href="/page/sblc.html?id=3" target="_blank">申报院校需满足“PTC校园计划”的要求，学校承诺所赠软件只能用于教学培训、考试等活动......</a></span></p>
                </div>
                <div class="cad"  style="display:none;" id="y_z_div">
                    <span class="a01"><a href="/page/xspx.html?id=2" target="_blank">具备完备的理论学习系统，创新应用O2O教学模式，金牌讲师一地授课，全国学员同步学习，以保障学习质量<br />......</a></span>
                    <span class="a02"><a href="/page/xxfd.html?id=2" target="_blank">线下针对性监督辅导, 根据学生特点、学科需求制定辅导计划，教的深刻，学的透彻<br />......</a></span>
                    <span class="a03"><a href="/page/jnzs.html?id=2" target="_blank">为工业和信息化部人才培养工程培训基地“计算机辅助设计”指定发证机构,中教华兴为进一步落实国家人才兴国战略，立足产业，服务行业，全面结合企业需求，加速对高质量人才的培养落地......</a></span>
                    <span class="a04"><a href="/page/pxkc.html?id=2" target="_blank" title="点击查看详情"></a></span>
                </div>
            </div>
        </div>
        <!--右侧-->
        <div class="zjzc">
            <h2><a href="#">职教之窗</a><a href="<?php echo Yii::$app->urlManager->createUrl(["article/index",'cat'=>'zjzc','template'=>'list'])?>" class="more"  target="_blank">更多</a></h2>
            <ul>
            <?php
                $zjzc = Article::find()->where(['cid'=>5,'status'=>1])->with('category')->orderBy("id desc")
                    ->limit(8)->all();
                if(is_array($zjzc) && !empty($zjzc)){
                    foreach ($zjzc as $key => $value) {
            ?>
                <li><span><?php echo date("m-d",$value['created_at'])?></span><a href="<?php echo Yii::$app->urlManager->createUrl("view/".$value['id'])?>" target="_blank" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></li>
            <?php
                    }
                }
            ?>
            </ul>
        </div>
        <!--右侧-->
    </div>
    <!--中间内容三-->
    <div class="third_index">
        <!--左侧-->
        <div class="jl_indexMainThr">
            <div class="jl_tab_news">
                <?php
                    $hzyx = Article::find()->where(['cid'=>10,'status'=>1])->with('category')->orderBy("sort desc")->all();
                    if(is_array($hzyx) && !empty($hzyx)){
                        $j = 1;
                        foreach ($hzyx as $key => $value) {
                            $style = ($j == 1) ? "block":"none";
                ?>
                <div class="jl_tab_nr" id="jl_con_1_<?php echo $j;?>" style="display: <?php echo $style;?>;">
                    <p><span></span><strong><img src="<?=Yii::$app->getRequest()->getBaseUrl().$value['thumb']; ?>" /></strong></p>
                </div>

                <?php
                    $j++;
                        }
                    }
                ?>
                <div class="jl_tab_nav">
                <style>
        /*定义滚动条样式（高宽及背景）*/ 
        ::-webkit-scrollbar { 
            width: 6px;   /* 滚动条宽度， width：对应竖滚动条的宽度  height：对应横滚动条的高度*/
        } 
        /*定义滚动条轨道（凹槽）样式*/ 
        ::-webkit-scrollbar-track { 
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);    /* 较少使用 */
            border-radius: 3px; 
        } 
        /*定义滑块 样式*/ 
        ::-webkit-scrollbar-thumb { 
            border-radius: 3px; 
            height: 100px;    /* 滚动条滑块长度 */
            background-color: #ccc; 
        }
    </style>

                    <h2><a href="<?php echo Yii::$app->urlManager->createUrl(["article/index",'cat'=>'colection_schoole','template'=>'list'])?>">合作院校</a><a href="/article/hzyx.html" class="more"  target="_blank">更多</a></h2>
                    <ul>
                        <?php
                            $hzyxz = Article::find()->where(['cid'=>10,'status'=>1])->with('category')->limit(100)->orderBy("sort desc")->all();
                            if(is_array($hzyxz) && !empty($hzyxz)){
                                $i = 1;
                                $count = count($hzyxz);
                                foreach ($hzyxz as $key => $value) {
                                    $class = ($i == 1)?"jl_hover":"jl_nochosen";
                        ?>
                            <li onmouseover="setTab(1,<?= $i;?>,<?= $count;?>)" id="jl_tab_1_<?= $i;?>"
                                class="<?php echo $class ;?>">
                            <strong><a target="_blank"  href="<?php echo Yii::$app->urlManager->createUrl(["view/".$value['id']])?>"><?php echo $value['title'];?></a></strong>
                            <span><a href="<?php echo Yii::$app->urlManager->createUrl(["view/".$value['id']])?>" title="<?php echo $value['title'];?>">点击查看</a></span>
                            </li>
                        <?php
                                $i++;
                                }
                            }
                        ?>
                    </ul>
                    <script type="text/javascript">
                        function setTab(a,b,c){
                            for(var i=1;i<=c;i++){
                                var oDiv = document.getElementById("jl_con_"+a+"_"+i);
                                var oA = document.getElementById("jl_tab_"+a+"_"+i);
                                oDiv.style.display="none";
                                oA.className = "jl_nochosen";
                            }
                            var curDiv = document.getElementById("jl_con_"+a+"_"+b);
                            curDiv.style.display = "block";
                            var curA = document.getElementById("jl_tab_"+a+"_"+b);
                            curA.className = "jl_hover";
                        }
                    </script>
                </div>
            </div>
        </div>
        <!--右侧-->
        <div class="ask_index">
            <h2><a href="<?php echo Yii::$app->urlManager->createUrl(["article/index",'cat'=>'faq','template'=>'list'])?>">常见问题解答</a><a href="<?php echo Yii::$app->urlManager->createUrl(["article/index",'cat'=>'faq','template'=>'list'])?>" class="more"  target="_blank">更多</a></h2>
            <div class="faq_c">
                <div id="">
                    <table cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                        <tbody>
                        <tr>
                            <td>
                                <?php
                                    $cjwt = Article::find()->where(['cid'=>11,'status'=>1])->with('category')->orderBy("sort desc")->all();
                                    if(is_array($cjwt) && !empty($cjwt)){
                                        foreach ($cjwt as $key => $value) {
                                           $contentModel = yii::createObject( ArticleContent::className() );
                                           $contentModel = ArticleContent::findOne(['aid' => $value['id']])['content'];
                                ?>
                                <dl>
                                    <dt>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['view/'.$value['id'],'cat'=>'faq'])?>"
                                           target="_blank" >
                                            <?php echo $value['title']; ?>
                                        </a>
                                    </dt>

                                    <dd><?php echo $value['summary'];?></dd>
                                </dl>

                                <?php
                                        }
                                    }
                                    ?>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--中间内容四-->
    <div class="fourth_index">
        <div class="xitong">

            <dl>
                <a target="_blank" href="<?php echo Yii::$app->urlManager->createUrl(["article/friend",'type'=>'yqlj']) ?>">
                    <dt><img src="/static/images_b/20190729181325_5d3ec6c52e8a4.jpg" /></dt><dd>友情链接</dd>
                </a>
            </dl>
            <dl>
                <a target="_blank" href="<?php echo Yii::$app->urlManager->createUrl(["article/friend",'type'=>'hzhb']) ?>">
                    <dt><img src="/static/images_b/20190729181406_5d3ec6eea093e.jpg" /></dt><dd>合作伙伴</dd>
                </a>
            </dl>
            <dl>
                <a target="_blank" href="https://www.miiteec.org.cn/plus/list.php?tid=66">
                    <dt><img src="/static/images_b/zhengshu.jpg" /></dt><dd>证书查询</dd>
                </a>
            </dl>

        </div>
        <!--会员-->
        <div class="huiyuan_index" style="display:block;">
            <h2><a>会员登录</a><a class="on">会员注册</a></h2>
            <form class="form">
                <ul>
                    <li>
                        <a class=" icon user"></a><input type="text" class="text" placeholder="输入用户名">
                    </li>
                    <div class="clear"> </div>
                    <li>
                        <a class="icon lock"></a><input type="password" placeholder="密码">
                    </li>
                    <div class="clear"> </div>
                </ul>
                <div class="submit">
                    <input type="submit" onclick="myFunction()" value="登录">
                    <h4><a>忘记密码</a></h4>
                    <div class="clear">  </div>
                </div>
            </form>
        </div>
        <!--会员-->
    </div>
</div>
