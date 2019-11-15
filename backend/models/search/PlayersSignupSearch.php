<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PlayersSignup;

/**
 * PlayersSignupSearch represents the model behind the search form about `backend\models\PlayersSignup`.
 */
class PlayersSignupSearch extends PlayersSignup
{

    public $product_name;
    public $product_camp_period;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province', 'city', 'area', 'sex', 'age', 'height', 'weight', 'product_id', 'status', 'paid_in', 'time_signup', 'created_at', 'updated_at'], 'integer'],
            [['username', 'national', 'phone', 'parents_names', 'hobby', 'source', 'preferential', 'results_people', 'remark'], 'safe'],
            [['camp_money'], 'number'],
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
        $query = PlayersSignup::find();
        $query->joinWith(['productName']);
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
        if (!empty(array_keys($roles)[0]) && !strstr( array_keys($roles)[0],'财务')) {
             $query->andFilterWhere(['=', 'opeater', array_keys($roles)[0]]);
        }

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'          => $this->id,
            'province'    => $this->province,
            'city'        => $this->city,
            'area'        => $this->area,
            'sex'         => $this->sex,
            'age'         => $this->age,
            'height'      => $this->height,
            'weight'      => $this->weight,
            'product_id'  => $this->product_id,
            'status'      => $this->status,
            'camp_money'  => $this->camp_money,
            'paid_in'     => $this->paid_in,
            'time_signup' => $this->time_signup,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'national', $this->national])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'parents_names', $this->parents_names])
            ->andFilterWhere(['like', 'hobby', $this->hobby])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'preferential', $this->preferential])
            ->andFilterWhere(['like', 'results_people', $this->results_people])
            ->andFilterWhere(['like', 'remark', $this->remark]);
        if (isset($params['PlayersSignupSearch']['product_name']) && !empty($params['PlayersSignupSearch']['product_name'])) {
            $query->andFilterWhere(['like', 'pro_product.product_name', trim($params['PlayersSignupSearch']['product_name'])]) ;
        }elseif (isset($params['PlayersSignupSearch']['product_camp_period']) && !empty($params['PlayersSignupSearch']['product_camp_period'])) {
            $query->andFilterWhere(['like', 'pro_product.product_camp_period', trim($params['PlayersSignupSearch']['product_camp_period'])]) ;
        }

        // echo $query->createCommand()->getRawSql();exit;
        return $dataProvider;
    }
}
