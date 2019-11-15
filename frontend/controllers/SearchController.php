<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-05 13:08
 */

namespace frontend\controllers;

use common\models\meta\ArticleMetaTag;
use Yii;
use frontend\models\Article;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


class SearchController extends Controller
{

    /**
     * 搜索
     *
     * @return string
     */
   /* public function actionIndex()
    {
        $where = ['type' => Article::ARTICLE];
        $query = Article::find()->select([])->where($where);
        $keyword = htmlspecialchars(Yii::$app->getRequest()->get('q'));
        $dataProvider = $query->andFilterWhere(['like', 'title', $keyword])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sort' => SORT_ASC,
                    'id' => SORT_DESC,
                ]
            ]
        ]);
        return $this->render('/article/list', [
            'dataProvider' => $dataProvider,
            'type' => Yii::t('frontend', 'Search keyword {keyword} results', ['keyword'=>$keyword]),
        ]);
    }*/
    function actionIndex()
    {
        $where = ['type' => Article::ARTICLE];
        $keyword = htmlspecialchars(Yii::$app->getRequest()->get('q'));
        $query = Article::find()->select([])->where($where);
        $query->andFilterWhere(['like', 'title', $keyword]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('/article/list', [
             'dataProvider' => $models,
             'pages' => $pages,
             'keyword' => $keyword,
            'ccat'=>'',
        ]);
    }
    public function actionTag($tag='')
    {
        $metaTagModel = new ArticleMetaTag();
        $aids = $metaTagModel->getAidsByTag($tag);
        $where = ['type' => Article::ARTICLE];
        $query = Article::find()->select([])->where($where)->where(['in', 'id', $aids]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sort' => SORT_ASC,
                    'id' => SORT_DESC,
                ]
            ]
        ]);
        return $this->render('/article/index', [
            'dataProvider' => $dataProvider,
            'type' => Yii::t('frontend', 'Tag {tag} related articles', ['tag'=>$tag]),
        ]);
    }
}
