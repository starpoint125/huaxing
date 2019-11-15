<?php

namespace backend\controllers;

use Yii;
use backend\models\search\JobsSearch;
use backend\models\Jobs;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;

/**
 * JobsController implements the CRUD actions for Jobs model.
 */
class JobsController extends \yii\web\Controller
{
    /**
    * @auth
    * - item group=未分类 category=Jobs description-get=列表 sort=000 method=get
    * - item group=未分类 category=Jobs description-get=查看 sort=001 method=get  
    * - item group=未分类 category=Jobs description=创建 sort-get=002 sort-post=003 method=get,post  
    * - item group=未分类 category=Jobs description=修改 sort=004 sort-post=005 method=get,post  
    * - item group=未分类 category=Jobs description-post=删除 sort=006 method=post  
    * - item group=未分类 category=Jobs description-post=排序 sort=007 method=post  
    * @return array
    */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function(){
                    
                        $searchModel = new JobsSearch();
                        $dataProvider = $searchModel->search(yii::$app->getRequest()->getQueryParams());
                        return [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                        ];
                    
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'modelClass' => Jobs::className(),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'modelClass' => Jobs::className(),
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Jobs::className(),
            ],
            'sort' => [
                'class' => SortAction::className(),
                'modelClass' => Jobs::className(),
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'modelClass' => Jobs::className(),
            ],
        ];
    }
}
