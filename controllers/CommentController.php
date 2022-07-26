<?php


namespace app\controllers;



use app\models\Comment;
use app\models\Like;
use app\models\User;
use Faker\Provider\Base;
use Faker\Provider\Image;
use Faker\Provider\Internet;
use Faker\Provider\Lorem;
use Faker\Provider\Person;
use Yii;
use yii\web\Controller;

class CommentController extends Controller
{


    public function actionIndex(){
        $models = Comment::find();

        if(!empty($_GET['sort'])){

            $type = Yii::$app->request->get('type');


            switch ($_GET['sort']){

                case 'date':
                    $models = $models->orderBy(['create_date' => Yii::$app->params['sortType'][$type]]);
                break;

                case 'negative':
                    $models = $models->select(['comment.*','COUNT(like.comment_id) AS likecount'])->filterWhere(['like.status' => 0])->join('LEFT JOIN',Like::tableName(),'comment.id=like.comment_id')->groupBy('comment.id');
                    $models = $models->orderBy(['likecount' => Yii::$app->params['sortType'][$type]]);
                break;

                case 'positive':
                    $models = $models->select(['comment.*','COUNT(like.comment_id) AS likecount'])->where(['like.status' => 1])->join('LEFT JOIN',Like::tableName(),'comment.id=like.comment_id')->groupBy('comment.id');
                    $models = $models->orderBy(['likecount' => Yii::$app->params['sortType'][$type]]);
                break;

                case 'user':
                    $models = $models->orderBy(['user_id' => Yii::$app->params['sortType'][$type]]);
                break;
            }
        }

        $models = $models->all();

        return $this->render('index',compact('models'));

    }

    public function actionGenerateRandomData(){

        $user = new User();
        $user->username = Person::firstNameMale();
        $user->password = md5(Base::randomNumber());
        $user->email = Internet::freeEmailDomain();
        $user->avatar = Image::imageUrl(200,200,'avatar');
        $user->status = 1;

        if($user->save()){

            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->body = Lorem::text(150);
            $comment->create_date = date('Y-m-d H:i:s',strtotime(\Faker\Provider\DateTime::dateTime()->format('Y-m-d H:i:s')));
            $comment->status = 1;

            if($comment->save()){
                $users = User::find()->all();
                foreach ($users as $item){
                    $like = new Like();
                    $like->user_id = $item->id;
                    $like->comment_id = $comment->id;
                    $like->status = rand(0,1);
                    if($like->save()){

                    }else{
                        print_r($like->errors);
                    }
                }

                return $this->redirect('index');
            }else{
                print_r($comment->errors);
            }


        }else{
            print_r($user->errors);
        }


    }
}