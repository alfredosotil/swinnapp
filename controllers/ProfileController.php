<?php

namespace app\controllers;

use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\models\Access;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\assets\AppAsset;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ["bulkDelete", "create", "delete", "index", "update", "view", "addmodule", "deletemodule"],
                'rules' => [
                    [
                        'actions' => ["bulkDelete", "create", "delete", "index", "update", "view", "addmodule", "deletemodule"],
                        'allow' => AppAsset::getAccess("profile"),
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $dataprovidermodule = new ActiveDataProvider([
            'query' => Access::find()->where(["profile_id" => $id])
                    ->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Profile #" . $id,
                'content' => $this->renderPartial('view', [
                    'model' => $this->findModel($id),
                    'dataprovidermodule' => $dataprovidermodule
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'dataprovidermodule' => $dataprovidermodule
            ]);
        }
    }

    /**
     * Creates a new Profile model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new Profile();

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new Profile",
                    'content' => $this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => 'true',
                    'title' => "Create new Profile",
                    'content' => '<span class="text-success">Create Profile success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Create new Profile",
                    'content' => $this->renderPartial('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing Profile model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $dataprovidermodule = new ActiveDataProvider([
            'query' => Access::find()->where(["profile_id" => $model->id])
                    ->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {

                return [
                    'title' => "Update Profile #" . $id,
                    'content' => $this->renderPartial('update', [
                        'model' => $this->findModel($id),
                        'dataprovidermodule' => $dataprovidermodule
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => 'true',
                    'title' => "Profile #" . $id,
                    'content' => $this->renderPartial('view', [
                        'model' => $this->findModel($id),
                        'dataprovidermodule' => $dataprovidermodule
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update Profile #" . $id,
                    'content' => $this->renderPartial('update', [
                        'model' => $this->findModel($id),
                        'dataprovidermodule' => $dataprovidermodule
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'dataprovidermodule' => $dataprovidermodule
                ]);
            }
        }
    }

    /**
     * Delete an existing Profile model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => true];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Profile model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete() {
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (Profile::findAll(json_decode($pks)) as $model) {
            $model->delete();
        }


        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => true];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddmodule() {
        $data = [];
        $exist = Access::find()->where(["module_id" => $_POST['module_id'], "profile_id" => $_POST['profile_id']])->all();
        if (count($exist) === 0) {
            $access = new Access();
            $access->module_id = $_POST['module_id'];
            $access->profile_id = $_POST['profile_id'];
            $access->save();
        }

        $data['message'] = "Module Granted";

        $dataProvider = new ActiveDataProvider([
            'query' => Access::find()->where(["profile_id" => $_POST['profile_id'],])
                    ->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $data['gridmodules'] = GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        ['attribute' => 'module', 'value' => 'module.label'],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{deletemodule}',
                            'buttons' => [
                                'deletemodule' => function () {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', null, [
                                                'data-confirm' => 'Are you sure you want to delete this item?',
                                                'class' => "deletemoduleajax"
                                    ]);
                                }
                                    ]
                                ]
                            ],
                            'options' => ['class' => '', 'id' => 'grid-accesses'],
                ]);

                Yii::$app->response->format = Response::FORMAT_JSON;
                return $data;
            }

            public function actionDeletemodule() {

                $data = [];
                $module = Access::findOne(["id" => $_POST["module_id"]]);
                $profile_id = $module->profile_id;
                $rowdeleted = $module->delete();
                $data['message'] = "$rowdeleted Module(s) Deleted";

                $dataProvider = new ActiveDataProvider([
                    'query' => Access::find()->where(["profile_id" => $profile_id])
                            ->orderBy('id DESC'),
                    'pagination' => [
                        'pageSize' => 20,
                    ],
                ]);

                $data['gridmodules'] = GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                ['attribute' => 'module', 'value' => 'module.label'],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{deletemodule}',
                                    'buttons' => [
                                        'deletemodule' => function () {
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', null, [
                                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                                        'class' => "deletemoduleajax"
                                            ]);
                                        }
                                            ]
                                        ]
                                    ],
                                    'options' => ['class' => '', 'id' => 'grid-accesses'],
                        ]);
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return $data;
                    }

                }
                