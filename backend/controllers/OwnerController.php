<?php

namespace backend\controllers;

use Yii;
use common\models\Owner;
use common\models\OwnerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * OwnerController implements the CRUD actions for Owner model.
 */
class OwnerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Owner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OwnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Owner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Owner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
        $model = new Owner();

        if ($model->load(Yii::$app->request->post())) {
            
            //$model->save();
            //$model->user_upload = Yii::$app->user->identity->username;
            
            $image = UploadedFile::getInstance($model, 'ownerAvatar');
            if($image){
                $model->ownerAvatar = 'avat'.time().'.'.$image->extension;
            }
            //Antes de subir la imagen, comprobar si todo va bien
            if ($model->save()){
                if($image){
                    $image->saveAs(Yii::getAlias('@imgAvatarsPath').'/'. $model->ownerAvatar);
                }
            }
            return $this->redirect(['view', 'id' => $model->id_owner]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Owner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $image = UploadedFile::getInstance($model, 'ownerAvatar');
            if($image){
                $model->ownerAvatar = 'avat'.time().'.'.$image->extension;
            }
            if($model->save()) {
                if($image){
                    $image->saveAs(Yii::getAlias('@imgAvatarsPath').'/'. $model->ownerAvatar);
                }
                return $this->redirect(['view', 'id' => $model->id_owner]);    
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }   
    /**
     * Deletes an existing Owner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        $this->findModel($id)->delete();
        //Borrar la imagen fiiśica
        $photo = Yii::getAlias('@imgAvatarsPath').'/'.$model->ownerAvatar;
        
        if(!unlink($photo)){
          return false;  
        }
        return $this->redirect(['index']);
    }
    
    public function actionDeletefoto($id) {
        $photo = Owner::find()->where(['id_owner'=>$id])->one()->ownerAvatar;
        if($photo){
            $photoAddress = Yii::getAlias('@imgAvatarsPath').'/'.$photo;
            if(!unlink($photoAddress)){
                return false;
            }
        }
        $owner = Owner::findOne($id);
        $owner->ownerAvatar = NULL;
        $owner->update();
        
        return $this->redirect(['update', 'id' => $id]);
    }

        /**
     * Finds the Owner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Owner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Owner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
