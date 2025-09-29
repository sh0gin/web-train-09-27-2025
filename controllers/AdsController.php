<?php

namespace app\controllers;

use app\models\ads;
use app\models\adsSeacrh;
use app\models\Category;
use app\models\Image;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * AdsController implements the CRUD actions for ads model.
 */
class AdsController extends Controller
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
     * Lists all ads models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new adsSeacrh();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ads model.
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
     * Creates a new ads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ads();
        $category = Category::getCategory();
        if ($this->request->isPost) {
            // VarDumper::dump($this->request->post(), 10, true); die;
            if ($model->load($this->request->post()['Ads'], '')) {
                $model->user_id = Yii::$app->user->id;
                $model->image_download = UploadedFile::getInstance($model, 'image_download');
                
                
                if ($model->save()) {
                    $newImage = new Image();
                    $newImage->ads_id = $model->id;
                    
                    if (!$model->image_download) {
                        $newImage->extension = 'png';
                        $newImage->title = 'non';
                    } else {
                        $model->image_download->saveAs('../web/image/' . $model->image_download->baseName . '.' . $model->image_download->extension);
                        $newImage->title = $model->image_download->baseName;
                        $newImage->extension = $model->image_download->extension;
                    }
                    
                    $newImage->save(false);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    VarDumper::dump('adsController', 10, true);
                    VarDumper::dump($model->attributes, 10, true);
                    die;
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'category' => $category,
        ]);
    }

    /**
     * Updates an existing ads model.
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
     * Deletes an existing ads model.
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
     * Finds the ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ads::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
