<?php

namespace app\controllers;

use app\models\Kriteria;
use app\models\Pasien;
use app\models\PasienSearch;
use app\models\Pemeriksaan;
use app\models\PemeriksaanKriteria;
use app\models\Subkriteria;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PasienController implements the CRUD actions for Pasien model.
 */
class PasienController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pasien models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PasienSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pasien model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pasien model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pasien();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pasien model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pasien model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pasien model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Pasien the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pasien::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPemeriksaanCreate($id)
    {
        $model = $this->findModel($id);
        $pemeriksaan = new Pemeriksaan();
        $pemeriksaan->pasien_id = $model->id;

        $array = [];
        $kriterias = Kriteria::find()->orderBy('jenis ASC, nama ASC')->all();
        foreach ($kriterias as $kriteria) {
            $array[] = new PemeriksaanKriteria(['kriteria_id' => $kriteria->id]);
        }
        if (!$pemeriksaan->pemeriksaanKriterias) $pemeriksaan->setPemeriksaanKriterias($array);

        if ($this->request->isPost && $pemeriksaan->load($this->request->post())) {
            $pemeriksaan->pemeriksaanKriterias = Yii::$app->request->post('PemeriksaanKriteria', []);
            if (!$pemeriksaan->save()) Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($pemeriksaan->errors));
            return $this->redirect(['pemeriksaan-view', 'pemeriksaan_id' => $pemeriksaan->id]);
        }
        return $this->render('pemeriksaan-create', [
            'model' => $model,
            'pemeriksaan' => $pemeriksaan,
        ]);
    }

    public function actionPemeriksaanUpdate($pemeriksaan_id)
    {
        $pemeriksaan = Pemeriksaan::findOne($pemeriksaan_id);
        $model = $pemeriksaan->pasien;

        $array = [];
        $kriterias = Kriteria::find()->all();
        foreach ($kriterias as $kriteria) {
            $array[] = new PemeriksaanKriteria(['kriteria_id' => $kriteria->id]);
        }
        if (!$pemeriksaan->pemeriksaanKriterias) $pemeriksaan->setPemeriksaanKriterias($array);

        if ($this->request->isPost && $pemeriksaan->load($this->request->post())) {
            $pemeriksaan->pemeriksaanKriterias = Yii::$app->request->post('PemeriksaanKriteria', []);
            if (!$pemeriksaan->save()) Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($pemeriksaan->errors));
            return $this->redirect(['pemeriksaan-view', 'pemeriksaan_id' => $pemeriksaan->id]);
        }
        return $this->render('pemeriksaan-update', [
            'model' => $model,
            'pemeriksaan' => $pemeriksaan,
        ]);
    }

    public function actionPemeriksaanDelete($pemeriksaan_id)
    {
        $pemeriksaan = Pemeriksaan::findOne($pemeriksaan_id);
        $pemeriksaan->delete();
        return $this->redirect(['view', 'id' => $pemeriksaan->pasien_id]);
    }

    public function actionPemeriksaanView($pemeriksaan_id)
    {
        $pemeriksaan = Pemeriksaan::findOne($pemeriksaan_id);
        $model = $pemeriksaan->pasien;

        return $this->render('pemeriksaan-view', [
            'model' => $model,
            'pemeriksaan' => $pemeriksaan,
        ]);
    }
}
