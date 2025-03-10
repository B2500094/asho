<?php

namespace app\controllers;

use yii;
use app\models\Personal;
use app\models\Registro;
use app\models\Estados;
use app\models\NaturalezaAccidente;
use app\models\RegistroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * RegistroController implements the CRUD actions for Registro model.
 */
class RegistroController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => [
                        'index', 'create', 'update', 'delete', 'permisos',
                    ], 
                    'rules' => [
                        ['actions' => ['index'], 'allow' => true, 'roles' => ['registro/index']],
                        ['actions' => ['create'], 'allow' => true, 'roles' => ['registro/create']],
                        ['actions' => ['update'], 'allow' => true, 'roles' => ['registro/update']],
                        ['actions' => ['delete'], 'allow' => true, 'roles' => ['registro/delete']],
                        ['actions' => ['permisos'], 'allow' => true, 'roles' => ['registro/permisos']],
                    ]
                ]
            ]
        );
    }

    /**
     * Lists all Registro models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RegistroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registro model.
     * @param int $id_registro Id Registro
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_registro)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_registro),
        ]);
    }

    /**
     * Creates a new Registro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Registro();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    // **1. Obtener el código de la región desde la tabla Estados**
                    $estado = Estados::findOne($model->id_estado); // Supongo que `id_estado` está relacionado
                    $codigoRegion = $estado !== null ? $estado->codigo_region : '00'; // Fallback a '00' si no hay región

                    // **2. Obtener los dos últimos dígitos del año actual**
                    $year = date('y');

                    // **3. Consultar el último registro del mismo año y región**
                    $ultimoAccidente = Registro::find()
                        ->where(['like', 'nro_accidente', $codigoRegion . '0' . $year . '%', false]) // Filtrar por código región y año
                        ->orderBy(['nro_accidente' => SORT_DESC])
                        ->one();

                    // **4. Generar el correlativo**
                    if ($ultimoAccidente) {
                        // Extraer el correlativo del último registro (asumo que siempre tiene 5 dígitos)
                        $ultimoCorrelativo = (int)substr($ultimoAccidente->nro_accidente, 5, 5); // 5 caracteres desde la posición 5
                        $correlativo = str_pad($ultimoCorrelativo + 1, 5, '0', STR_PAD_LEFT); // Incrementar y formatear a 5 dígitos
                    } else {
                        $correlativo = '00001'; // Si no hay registros previos, iniciar en '00001'
                    }

                    // **5. Obtener la descripción de la naturaleza desde la tabla NaturalezaAccidente**
                    $naturalezaAccidente = NaturalezaAccidente::findOne($model->id_naturaleza_accidente);
                    $descripcionNaturaleza = $naturalezaAccidente !== null ? $naturalezaAccidente->codigo : '';

                    // **6. Generar el número de accidente final**
                    $model->nro_accidente = $codigoRegion . '0' . $year . $correlativo . $descripcionNaturaleza;

                    // **7. Guardar el registro**
                    if (!$model->save(false)) { // Guardar sin validación adicional
                        throw new \yii\db\Exception('Error al guardar el registro: ' . json_encode($model->errors));
                    }

                    $transaction->commit();

                    Yii::$app->session->setFlash('success', 'Registro guardado exitosamente. Número de accidente: ' . $model->nro_accidente);
                    return $this->redirect(['index', 'id_registro' => $model->id_registro]);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Error al guardar el registro: ' . $e->getMessage());
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }




    


    public function actionGetEstados()
    {
        $regionId = Yii::$app->request->get('regionId');

        if ($regionId) {
            $estados = Estados::find()
                ->where(['id_regiones' => $regionId])
                ->all();

            $estadosData = ArrayHelper::map($estados, 'id_estado', 'descripcion');

            return \yii\helpers\Json::encode($estadosData);
        } else {
            return '';
        }
    }

    /**
     * Updates an existing Registro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_registro Id Registro
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_registro)
    {
        $model = $this->findModel($id_registro);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Actualizacion exitosa.');
            return $this->redirect(['index', 'id_registro' => $model->id_registro]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Registro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_registro Id Registro
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_registro)
    {
        $this->findModel($id_registro)->delete();
        Yii::$app->session->setFlash('success', 'Se ha eliminado exitosamente.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Registro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_registro Id Registro
     * @return Registro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_registro)
    {
        if (($model = Registro::findOne(['id_registro' => $id_registro])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}