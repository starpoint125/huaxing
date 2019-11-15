<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-09-15 12:29
 */

namespace backend\models\search;

use Yii;
use yii\data\ArrayDataProvider;
use backend\models\form\Rbac;

class RbacSearch extends Rbac
{
    public function searchPermissions($params)
    {
        $array = $this->getPermissionsByGroup();
        $this->load($params);
        $temp = explode('\\', self::className());
        $temp = end($temp);
        if (isset($params[$temp])) {
            $searchArr = $params[$temp];
            foreach ($searchArr as $k => $v) {
                if ($v !== '') {
                    foreach ($array as $key => $val) {
                        if (in_array($k, ['sort'])) {
                            if ($val[$k] != $v) {
                                unset($array[$key]);
                            }
                        } else {
                            if (strpos($val[$k], $v) === false) {
                                unset($array[$key]);
                            }
                        }
                    }
                }
            }
        }
        $dataProvider = Yii::createObject([
            'class' => ArrayDataProvider::className(),
            'allModels' => $array,
            'pagination' => [
                'pageSize' => -1,
            ],
        ]);
        return $dataProvider;
    }

    public function searchRoles($params)
    {
        $array = $this->getRoles();
        $this->load($params);
        $temp = explode('\\', self::className());
        $temp = end($temp);

        $username = Yii::$app->user->identity->username;
        if (isset($params[$temp])) {
            $searchArr = $params[$temp];
            foreach ($searchArr as $k => $v) {
                if ($v !== '') {
                    foreach ($array as $key => $val) {
                        if (in_array($k, ['sort'])) {
                            if ($val[$k] != $v) {
                                unset($array[$key]);
                            }
                        } else {
                            if (strpos($val[$k], $v) === false) {
                                unset($array[$key]);
                            }
                        }
                    }
                }
            }
        }
        if(!empty($array)){
            foreach ($array as $key => $value) {
                if($username != 'admin' && $value['name']=='系统'){
                    unset($array[$key]);
                }
            }
        }
        $dataProvider = Yii::createObject([
            'class' => ArrayDataProvider::className(),
            'allModels' => $array,
            'pagination' => [
                'pageSize' => -1,
            ],
        ]);
        return $dataProvider;
    }
}
