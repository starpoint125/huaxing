<?php

/**
*常量及静态变量
*/
namespace common\helpers;

use yii\base\Exception;
use yii\imagine\Image;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

class CommonConst
{

    static $sex    = [1=>'男',2=>'女'];
    static $status = [1=>'成功',2=>'新报',3=>'退费'];
    static $statuss = [2=>'新报'];
    static $paidin = [1=>'定金',2=>'定制服务费',3=>'尾款',];
    static $minzu = [
        1=>"汉族",
        2=>"壮族",
        3=>"满族",
        4=>"回族",
        5=>"苗族",
        6=>"维吾尔族",
        7=>"土家族",
        8=>"彝族",
        9=>"蒙古族",
        10=>"藏族",
        11=>"布依族",
        12=>"侗族",
        13=>"瑶族",
        14=>"朝鲜族",
        15=>"白族",
        16=>"哈尼族",
        17=>"哈萨克族",
        18=>"黎族",
        19=>"傣族",
        20=>"畲族",
        21=>"傈僳族",
        22=>"仡佬族",
        23=>"东乡族",
        24=>"高山族",
        25=>"拉祜族",
        26=>"水族",
        27=>"佤族",
        28=>"纳西族",
        29=>"羌族",
        30=>"土族",
        31=>"仫佬族",
        32=>"锡伯族",
        33=>"柯尔克孜族",
        34=>"达斡尔族",
        35=>"景颇族",
        36=>"毛南族",
        37=>"撒拉族",
        38=>"布朗族",
        39=>"塔吉克族",
        40=>"阿昌族",
        41=>"普米族",
        42=>"鄂温克族",
        43=>"怒族",
        44=>"京族",
        45=>"基诺族",
        46=>"德昂族",
        47=>"保安族",
        48=>"俄罗斯族",
        49=>"裕固族",
        50=>"乌孜别克族",
        51=>"门巴族",
        52=>"鄂伦春族",
        53=>"独龙族",
        54=>"塔塔尔族",
        55=>"赫哲族",
        56=>"珞巴族"
    ];

}
