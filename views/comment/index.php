<?php

$this->title = "Тестовое задание - Комментарии";

?>

<div class="site-index">

    <div class="comments_block">
        <div class="comments_action mb-5 d-flex justify-content-between">
            <a href="<?=\yii\helpers\Url::to(['comment/generate-random-data'])?>" class="btn btn-success">Добавить фейковые данные</a>
            <div class="sort_block">
                Сортировать по :
                <a href="?sort=date&type=<?=($_GET['type'] == 3) ? 4 : 3?>" class="btn btn-sm btn-primary">Дату</a>
                <a href="?sort=negative&type=<?=($_GET['type'] == 3) ? 4 : 3?>" class="btn btn-sm btn-primary">Лайков <i class="fa-solid fa-thumbs-down"></i></a>
                <a href="?sort=positive&type=<?=($_GET['type'] == 3) ? 4 : 3?>" class="btn btn-sm btn-primary">Лайков <i class="fa-solid fa-thumbs-up"></i></a>
                <a href="?sort=user&type=<?=($_GET['type'] == 3) ? 4 : 3?>" class="btn btn-sm btn-primary">Пользователей</a>
            </div>
        </div>

        <div class="comments_items">
            <?php if(!empty($models)): ?>
                <?php foreach ($models as $model): ?>
                    <?php $likes = $model->getLikes();?>
                    <div class="comment_item mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5><?=$model->user->username?> - <?=date('Y-m-d H:i:s',strtotime($model->create_date))?></h5>
                                <div class="likes d-flex" style="gap: 20px">
                                    <span class="positive"><i class="fa-solid fa-thumbs-up"></i> <?=$likes['positive']?></span>
                                    <span class="negative"><i class="fa-solid fa-thumbs-down"></i> <?=$likes['negative']?></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="<?=$model->user->avatar?>" alt="" style="width: 100%">
                                    </div>
                                    <div class="col-md-10">
                                        <?=$model->body?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>