<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use backend\behaviors\TimeSearchBehavior;
use backend\components\search\SearchEvent;

use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_camp_period', 'days'], 'integer'],
            [['product_name', ], 'safe'],//'product_contect', 'lead_info'
            [['money'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        /**
         * 按部门查询
         */
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (!empty(array_keys($roles)[0])) {
             $query->andFilterWhere(['=', 'opearter', array_keys($roles)[0]]);
        }

        if (isset($params['ProductSearch']['created_at']) && !empty($params['ProductSearch']['created_at'])) {
            $time_ex    = explode('~', trim($params['ProductSearch']['created_at']));
            $begin_time = strtotime($time_ex[0]);
            $end_time   = strtotime($time_ex[1]);
        }
        if (isset($params['ProductSearch']['begin_time']) && !empty($params['ProductSearch']['begin_time'])) {
            $time_ex    = explode('~', trim($params['ProductSearch']['begin_time']));
            $begins_time = strtotime($time_ex[0]);
            $ends_time   = strtotime($time_ex[1]);
        }
        if (isset($params['ProductSearch']['end_time']) && !empty($params['ProductSearch']['end_time'])) {
            $time_ex    = explode('~', trim($params['ProductSearch']['end_time']));
            $begind_time = strtotime($time_ex[0]);
            $endd_time   = strtotime($time_ex[1]);
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'                  => $this->id,
            'product_camp_period' => $this->product_camp_period,
            'days'                => $this->days,
            'money'               => $this->money,
            'updated_at'          => $this->updated_at,
        ]);
        if (!empty($params['ProductSearch']['created_at'])) {
            $query->andFilterWhere(['>=', 'created_at', trim($begin_time)])
            ->andFilterWhere(['<=', 'created_at', trim($end_time)]);
        }
        if (!empty($params['ProductSearch']['begin_time'])) {
            $query->andFilterWhere(['>=', 'begin_time', trim($begins_time)])
            ->andFilterWhere(['<=', 'begin_time', trim($ends_time)]);
        }
        if (!empty($params['ProductSearch']['end_time'])) {
            $query->andFilterWhere(['>=', 'end_time', trim($begind_time)])
            ->andFilterWhere(['<=', 'end_time', trim($endd_time)]);
        }
        $query->andFilterWhere(['like', 'product_name', $this->product_name]);
            // ->andFilterWhere(['like', 'product_contect', $this->product_contect])
            // ->andFilterWhere(['like', 'lead_info', $this->lead_info]);

        return $dataProvider;
    }
}
