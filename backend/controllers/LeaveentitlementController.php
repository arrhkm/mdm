<?php

namespace backend\controllers;

use Yii;
use app\models\LeaveEntitlement;
use app\models\LeaveEntitlementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Employee;
use app\models\LeaveType;
//use yii\db\Query;
use yii\helpers\ArrayHelper;
use app\models\PeriodYear;

/**
 * LeaveentitlementController implements the CRUD actions for LeaveEntitlement model.
 */
class LeaveentitlementController extends Controller
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
     * Lists all LeaveEntitlement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeaveEntitlementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LeaveEntitlement model.
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
     * Creates a new LeaveEntitlement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LeaveEntitlement(['scenario'=>LeaveEntitlement::SCENARIO_1]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            
            $data = arrayHelper::map(Employee::find()->all(), 'id', 'first_name');
            $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
            return $this->render('create', [
                'model' => $model,               
                'data'=>$data,
                'dtLeaveType'=>$dtLeaveType,
            ]);
        }
    }

    public function actionCreateh1()
    {
        $model = new LeaveEntitlement(['scenario'=>LeaveEntitlement::SCENARIO_INSERT]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            
            $employee = arrayHelper::map(Employee::find()->all(), 'id', 'first_name');
            $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
            $periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
            return $this->render('createh1', [
                'model' => $model,               
                'employee'=>$employee,
                'dtLeaveType'=>$dtLeaveType,
                'periodYear'=>$periodYear,
            ]);
        }
    }

    /**
     * Updates an existing LeaveEntitlement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $employee = arrayHelper::map(Employee::find()->all(), 'id', 'first_name');
            $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
            //$periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
            return $this->render('update', [
                'model' => $model,
                'employee'=>$employee,
                'periodYear'=>$periodYear,

            ]);
        }
    }

    /**
     * Deletes an existing LeaveEntitlement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LeaveEntitlement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LeaveEntitlement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LeaveEntitlement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
