<?php

namespace app\controllers;

use Yii;
use app\models\Asigna;
use app\models\AsignaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * AsignaController implements the CRUD actions for Asigna model.
 */
class AsignaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','delete','update','view'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Asigna models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsignaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asigna model.
     * @param integer $F_IDPROD
     * @param integer $F_IDRESP
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($F_IDPROD, $F_IDRESP)
    {
        return $this->render('view', [
            'model' => $this->findModel($F_IDPROD, $F_IDRESP),
        ]);
    }

    /**
     * Creates a new Asigna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Asigna();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'F_IDPROD' => $model->F_IDPROD, 'F_IDRESP' => $model->F_IDRESP]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Asigna model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $F_IDPROD
     * @param integer $F_IDRESP
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($F_IDPROD, $F_IDRESP)
    {
        $model = $this->findModel($F_IDPROD, $F_IDRESP);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'F_IDPROD' => $model->F_IDPROD, 'F_IDRESP' => $model->F_IDRESP]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Asigna model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $F_IDPROD
     * @param integer $F_IDRESP
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($F_IDPROD, $F_IDRESP)
    {
        $this->findModel($F_IDPROD, $F_IDRESP)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Asigna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $F_IDPROD
     * @param integer $F_IDRESP
     * @return Asigna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($F_IDPROD, $F_IDRESP)
    {
        if (($model = Asigna::findOne(['F_IDPROD' => $F_IDPROD, 'F_IDRESP' => $F_IDRESP])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
