<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-09-12 11:30
 */

namespace backend\controllers;

use Yii;
use backend\models\search\RbacSearch;
use backend\models\form\Rbac;
use yii\web\MethodNotAllowedHttpException;
use yii\web\Response;
use yii\web\UnprocessableEntityHttpException;

class RbacController extends \yii\web\Controller
{
    /**
     * @auth - item group=权限 category=规则 description-get=列表 sort=500 method=get
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPermissions()
    {
        /** @var RbacSearch $searchModel */
        $searchModel = Yii::createObject(['class' => RbacSearch::className(),'scenario'=>'permission']);
        $dataProvider = $searchModel->searchPermissions(Yii::$app->getRequest()->getQueryParams());
        return $this->render('permissions', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * @auth - item group=权限 category=规则 description-post=排序 sort=501 method=post
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPermissionSort()
    {
        if (Yii::$app->getRequest()->getIsPost()) {
            $data = Yii::$app->getRequest()->post();
            if (! empty($data['sort'])) {
                foreach ($data['sort'] as $key => $value) {
                    /** @var Rbac $model */
                    $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'permission']);
                    $model->fillModel($key);
                    if ($model->sort != $value) {
                        $model->sort = $value;
                        $model->updatePermission($key);
                    }
                }
            }
        }
        return [];
    }

    /**
     * @auth - item group=权限 category=规则 description=创建 sort-get=502 sort-post=503 method=get,post
     * @return string|Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPermissionCreate()
    {
        /** @var Rbac $model */
        $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'permission']);
        if( Yii::$app->getRequest()->getIsPost() ) {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->createPermission()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['permissions']);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }
        return $this->render('permission-create', [
            'model' => $model,
        ]);
    }

    /**
     * @auth - item group=权限 category=规则 description=修改 sort-get=504 sort-post=505 method=get,post
     * @param $name
     * @return string|Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPermissionUpdate($name)
    {
        /** @var Rbac $model */
        $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'permission']);
        $model->fillModel($name);
        if( Yii::$app->getRequest()->getIsPost() ) {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->updatePermission($name)) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['permissions']);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }
        return $this->render('permission-update', [
            'model' => $model,
        ]);
    }

    /**
     * @auth - item group=权限 category=规则 description-get=查看 sort=506 method=get
     * @param $name
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPermissionViewLayer($name)
    {
        /** @var Rbac $model */
        $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'permission']);
        $model->fillModel($name);
        return $this->render('permission-view-layer', [
            'model' => $model,
        ]);
    }

    /**
     * @auth - item group=权限 category=规则 description-post=删除 sort=507 method=post
     * @param null $name
     * @return array
     * @throws MethodNotAllowedHttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPermissionDelete($name=null)
    {
        /** @var Rbac $model */
        $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'permission']);
        if( Yii::$app->getRequest()->getIsPost() ){
            Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            $param = Yii::$app->getRequest()->post('id', null);
            if($param !== null){
                $name = $param;
            }
            $ids = explode(',', $name);
            $errorIds = [];
            foreach ($ids as $id) {
                $model->fillModel($id);
                if (! $model->deletePermission()) {
                    $errorIds[] = $id;
                }
            }
            if (count($errorIds) == 0) {
                return ['code' => 0, 'message' => Yii::t('app', 'Success')];
            } else {
                return ['code' => 1, 'message' => 'id ' . implode(',', $errorIds) . Yii::t('app', 'Error')];
            }
        }else {
            throw new MethodNotAllowedHttpException( Yii::t('app', "Delete must be POST http method") );
        }
    }

    /**
     * @auth - item group=权限 category=角色 description-get=列表 sort=510 method=get
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionRoles()
    {
        /** @var RbacSearch $searchModel */
        $searchModel = Yii::createObject(['class' => RbacSearch::className(), 'scenario'=>'role']);

        $dataProvider = $searchModel->searchRoles( Yii::$app->getRequest()->getQueryParams() );
        return $this->render('roles', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * @auth - item group=权限 category=角色 description=创建 sort-get=511 sort-post=512 method=get,post
     * @return string|Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionRoleCreate()
    {
        /** @var Rbac $model */
        $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'role']);
        if( Yii::$app->getRequest()->getIsPost() ) {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->createRole()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['roles']);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }
        return $this->render('role-create', [
            'model' => $model,
        ]);
    }

    /**
     * @auth - item group=权限 category=角色 description=修改 sort-get=513 sort-post=514 method=get,post
     * @param $name
     * @return string|Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRoleUpdate($name)
    {
        /** @var Rbac $model */
        $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'role']);
        $model->fillModel($name);
        if( Yii::$app->getRequest()->getIsPost() ) {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->updateRole($name)) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['roles']);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);
            }
        }
        return $this->render('role-update', [
            'model' => $model
        ]);
    }

    /**
     * @auth - item group=权限 category=角色 description-get=查看 sort=515 method=get
     * @param $name
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRoleViewLayer($name)
    {
        /** @var Rbac $model */
        $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'role']);
        $model->fillModel($name);
        return $this->render('role-view-layer', [
            'model' => $model,
        ]);
    }

    /**
     * @auth - item group=权限 category=角色 description=排序 sort=516 method=post
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRolesSort()
    {
        if (Yii::$app->getRequest()->getIsPost()) {
            $data = Yii::$app->getRequest()->post();
            if (! empty($data['sort'])) {
                foreach ($data['sort'] as $key => $value) {
                    /** @var Rbac $model */
                    $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'role']);
                    $model->fillModel($key);
                    if ($model->sort != $value) {
                       $model->sort = $value;
                       $model->updateRole($key);
                    }
                }
            }
        }
        return [];
    }

    /**
     * @auth - item group=权限 category=角色 description-post=删除 sort=517 method=post
     * @param string $name
     * @param null $id
     * @return array|Response
     * @throws MethodNotAllowedHttpException
     * @throws UnprocessableEntityHttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRoleDelete($name='', $id=null)
    {
        if( Yii::$app->getRequest()->getIsPost() ) {
            /** @var Rbac $model */
            $model = Yii::createObject(['class' => Rbac::className(), 'scenario'=>'role']);
            if ($name == '') {
                Yii::$app->getResponse()->format = Response::FORMAT_JSON;
                $param = Yii::$app->getRequest()->post('id', null);
                if($param !== null) $id = $param;
                if (!$id) {
                    return ['code' => 1, 'message' => Yii::t('app', "Name doesn't exit")];
                }
                $ids = explode(',', $id);
                $errorIds = [];
                foreach ($ids as $one) {
                    $model->fillModel($one);
                    if (!$model->deleteRole()) {
                        $errorIds[] = $one;
                    }
                }
                if (count($errorIds) == 0) {
                    return [];
                } else {
                    throw new UnprocessableEntityHttpException('id ' . implode(',', $errorIds));
                }
            } else {
                $model->fillModel($name);
                if ($model->deleteRole()) {
                    if (Yii::$app->getRequest()->getIsAjax()) {
                        return [];
                    } else {
                        return $this->redirect(Yii::$app->request->headers['referer']);
                    }
                } else {
                    throw new UnprocessableEntityHttpException(Yii::t('app', 'Error'));
                }
            }
        }else{
            throw new MethodNotAllowedHttpException(Yii::t('app', "Delete must be POST http method"));
        }
    }

}
