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
use yii\filters\AccessControl;
use app\models\User;

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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout', 
                            'index', 
                            'create',
                            'view',
                            'update',
                            'createh1',
                            'delete',
                        ],
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
            
            $employee = arrayHelper::map(Employee::find()->all(), 'id', 'first_name');
            $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
            $periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
            return $this->render('create', [
                'model' => $model,               
                'employee'=>$employee,
                'dtLeaveType'=>$dtLeaveType,
                'periodYear'=>$periodYear, 
            ]);
        }
    }

    public function actionCreateh1()
    {
        $model = new LeaveEntitlement(['scenario'=>LeaveEntitlement::SCENARIO_INSERT]);
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } */
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $period = split('to', $model->period_year); 
            $user = User::find()->where(['employee_id'=>$model->employee_id])->one();
            $model->user_id = $user->id;
            //$redudanceEntitlement = LeaveEntitlement::find(['from_date'=>$period[0], 'to_date'=>$period[1], 'employee_id'=>$model->employee_id])->one();
            $redudanceEntitlement = LeaveEntitlement::find()
            ->where(['employee_id'=>$model->employee_id, 'from_date'=>$period[0], 'to_date'=>$period[1], 'leave_type_id'=>$model->leave_type_id])
            ->count();
            if ($redudanceEntitlement >= 1){
                yii::$app->session->setFlash('error', 'Leave Entitlement for this user wash entry');
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

            $model->from_date = $period[0];
            $model->to_date = $period[1];
            if ($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);   
            }
            $employee = arrayHelper::map(Employee::find()->all(), 'id', 'first_name');
            $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
            $periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
            return $this->render('createh1', [
                'model' => $model,               
                'employee'=>$employee,
                'dtLeaveType'=>$dtLeaveType,
                'periodYear'=>$periodYear,
                
            ]);

        } else {
            
            $employee = arrayHelper::map(Employee::find()
                ->select('employee.*')
                ->innerjoin('user')
                ->where(['is not','user.employee_id', Null])
                ->all(), 'id', 'first_name');
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
                'dtLeaveType'=>$dtLeaveType,

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
