<?php

namespace backend\controllers;

use Yii;
use common\models\House;
use common\models\HouseSearch;
use common\models\Room;
use common\models\Model;

use yii\helpers\ArrayHelper;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * HouseController implements the CRUD actions for House model.
 */
class HouseController extends Controller
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
     * Lists all House models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single House model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->getManyToManyRelation('facilities')->fill();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new House model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   
    public function actionCreate()
    {
        $model = new House;
        $modelsRooms = [new Room];
        $model->getManyToManyRelation('facilities')->fill();
        
        if ($model->load(Yii::$app->request->post())) {

            $modelsRooms = Model::createMultiple(Room::classname());
            Model::loadMultiple($modelsRooms, Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($model),
                    ActiveForm::validate($modelsRooms)
                );
            }
            // validate all models
            $validHouse = $model->validate();
            $validRooms = Model::validateMultiple($modelsRooms) && $validHouse;
            
            if ($validRooms) {

                $model->houseFotos = $model->uploadMultiple($model,'fotos');
            
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save()) {
                        
                        foreach ($modelsRooms as $modelRoom) {
                            $modelRoom->houseId = $model->id;
                            $modelRoom->roomfacilities = implode(",", $modelRoom->roomfacilities);
                            if (!($flag = $modelRoom->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelsRooms' => $modelsRooms,
        ]);
    }

    /**
     * Updates an existing House model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->getManyToManyRelation('facilities')->fill();
        $modelsRooms = $model->rooms;
        //$model->oldfotos = $model->houseFotos;
        //$model->services = explode(",", $model->services);
        //$model->facilities = explode(',', $model->facilities);
        //$model->houseAdresse = decode($model->houseAdresse);

        /*foreach ($modelsRooms as $modelRoom) {
            $modelRoom->roomfacilities = explode(",", $modelRoom->roomfacilities);
        }*/
        
       if ($model->load(Yii::$app->request->post())) {
           
            $oldIDs = ArrayHelper::map($modelsRooms, 'idroom', 'idroom');
            $modelsRooms = Model::createMultiple(Room::classname(), $modelsRooms);
            Model::loadMultiple($modelsRooms, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsRooms, 'idroom', 'idroom')));
            
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsRooms) && $valid;
            
            if ($valid) {
                $images = $model->uploadMultiple($model,'fotos');
                if($images !== false){
                    $model->houseFotos = $images;
                }
                //$model->services = implode(',', $model->services);
                //$model->facilities = implode(',', $model->facilities);
                //$model->houseAdresse = implode('', $model->houseAdresse);

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag=$model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Room::deleteAll(['idroom' => $deletedIDs]);
                        }
                        foreach ($modelsRooms as $modelRoom) {
                            $modelRoom->houseId = $model->id;
                            $modelRoom->roomfacilities = implode(",", $modelRoom->roomfacilities);
                            if (!($flag = $modelRoom->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }}
            return $this->render('update', [
                'model' => $model,
                'modelsRooms' => (empty($modelsRooms)) ? [new Room] : $modelsRooms,
                //'modelsRooms' => $modelsRooms,
            ]);
    }

    /**
     * Deletes an existing House model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $modelsRooms = $model->rooms;  

        $modelsRoomsIDs = ArrayHelper::map($model->rooms, 'idroom', 'idroom');

        //Delete all rows
        Room::deleteAll(['idroom' => $modelsRoomsIDs]);      

        $nameHouse = $model->houseName;

        $fotos = $model->houseFotos ? @explode(',',$model->houseFotos) : [];
        $path = Yii::getAlias('@imgCasasPath').'/';
        
        foreach ($fotos as $houseFotos){
            $deleteFoto = $path.$houseFotos;
            if(file_exists($deleteFoto)){
                if(!unlink($deleteFoto)){
                    return false;
                }
            }
        }

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'House  <strong>"' . $nameHouse . '"</strong> deleted successfully.');
        }
        return $this->redirect(['index']);
    }
    
    public function actionRegion() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = House::getRegionList($cat_id);
                echo Json::encode($out);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Finds the House model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return House the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = House::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
