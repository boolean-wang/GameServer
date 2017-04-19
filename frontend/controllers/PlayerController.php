<?php

namespace frontend\controllers;

use frontend\service\PlayerService;
use Yii;
use common\models\Player;
use common\models\PlayerSearch;
use frontend\controllers\BaseController;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlayerController implements the CRUD actions for Player model.
 */
class PlayerController extends BaseController
{
    public $enableCsrfValidation =false;
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
     * Lists all Player models.
     * @return mixed
     */
    public function actionIndex()
    {

        $id = Yii::$app->user->id;
        //列表展示这个用户的所有角色User::find()->where(['name' => '小伙儿'])->all()
        $players = Player::find()->where(['u_id' => $id])->asArray()->all();
        return $this->render('index', [
            'players' => $players,
        ]);
    }

    /**
     * Displays a single Player model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //这个id是咋传过来的?
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Player model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Player();
        $name = $this->post('name');
        $model->nickname = $name;
        $model->u_id = Yii::$app->user->id;
        $model->sex = 1;

        if($model->save()){
            echo json_encode([
                'code' => 200,
                'msg' => 'success',
                'data' => [
                    'name' => $name,
                    'userId' => Yii::$app->user->id,
                ]

            ]);
        }else{
            echo json_encode([
                'code' => 400,
                'msg' => 'failed',
                'data' => [
                    'name' => $name,
                    'userId' => Yii::$app->user->id,
                ]
            ]);
        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Updates an existing Player model.
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Player model.
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
     * 初始化角色数据  最后跳转到游戏场景
     */
    public function actionInit()
    {
        $uId = $this->post('uId');
        $userId = Yii::$app->user->id;
        //初始化用户角色存放到redis当中 没有返回

        PlayerService::getInit($uId, $userId);

        return $this->redirect('/scene/index');
    }

    public function actionDetail()
    {
        $user_id = Yii::$app->user->id;
        $data = PlayerService::getPlayerDetail($user_id);

        return $this->JsonReturn($data);
    }

    /**
     * 移动
     */
    public function actionMove()
    {
        $user_id = Yii::$app->user->id;
        $x = $this->post('xx');
        $y = $this->post('yy');
        try{
            PlayerService::setPlayerLocation($user_id, $x, $y);
            $data = [
                'code' => '200',
                'msg' => '移动成功'
            ];
            return $this->JsonReturn($data);
        }catch (Exception $e){
            return $this->JsonReturn(['code' => '400', 'msg' => '移动失败']);
        }
    }

    /**
     * Finds the Player model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Player the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Player::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
