<?php

namespace backend\controllers;

use Yii;
use backend\models\search\PlayersPeriodSearch;
use backend\models\PlayersPeriod;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;

/**
 * PlayersPeriodController implements the CRUD actions for PlayersPeriod model.
 */
class PlayersPeriodController extends \yii\web\Controller
{
    /**
    * @auth
    * - item group=未分类 category=Players Periods description-get=列表 sort=000 method=get
    * - item group=未分类 category=Players Periods description-get=查看 sort=001 method=get  
    * - item group=未分类 category=Players Periods description=创建 sort-get=002 sort-post=003 method=get,post  
    * - item group=未分类 category=Players Periods description=修改 sort=004 sort-post=005 method=get,post  
    * - item group=未分类 category=Players Periods description-post=删除 sort=006 method=post  
    * - item group=未分类 category=Players Periods description-post=排序 sort=007 method=post  
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){

                        $searchModel = new PlayersPeriodSearch();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];

                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => PlayersPeriod::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => PlayersPeriod::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => PlayersPeriod::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => PlayersPeriod::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => PlayersPeriod::className(),
            ],
        ];
    }
}
