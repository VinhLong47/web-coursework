<?php 
use MVC\core\Application;
use MVC\Models\CommentModel;
use MVC\Models\User;

$guest = Application::isGuest();
?>

<div class="row">
    <div class="col d-flex justify-content-center">
        <h2 class="position-relative">Threads</h2>
    </div>
</div>
<?php if(count($threads) > 0): ?>
    <?php foreach($threads as $thread): ?>
        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                    <div class="card" id="<?=$thread["id"]?>" style="width: 40rem;">
                        <?php if(!empty($thread['img'])): ?>
                            <img src="<?=$thread['img']?>" class="card-img-top" width="378" height="359" alt="<?=$thread['img']?>">
                        <?php endif ?>
                        <div class="card-body">
                            <h5 class="card-title"><a class="text-decoration-none" href="/threads/<?=$thread['id']?>"><?=$thread["name"]?></a></h5>
                            <p class="card-text">Created At: <?=$thread["created_at"]?></p>
                            <p class="card-text"><?=$thread["description"]?></p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Latest comments</h5>
                        </div>
                        <?php
                            $comments = CommentModel::findAll(["thread_id" => $thread["id"]], 5, 0, "created DESC");
                        ?>
                        <?php if(isset($comments)):?>
                            <?php foreach($comments as $comment): ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?=User::findOne(["id" => $comment["user_id"]])->getDisplayName()?></h5>
                                    <p class="card-text"><?=$comment["comment"]?></p>    
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    </div>
            </div>
        </div>
    <?php endforeach ?>
    <?php if($totalPage > 1): ?>
        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                <?php for($i = 0; $i < $totalPage; ++$i): ?>
                    <a href="/threads?page=<?php echo $i+1 ?>" class="text-decoration-none <?php echo $currentPage == $i+1 ? 'text-dark' : '' ?>"><?php echo $i+1 ?></a>
                <?php endfor ?>
            </div>
        </div>
    <?php endif ?>
<?php else: ?>
    <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                <p class="text-center">No Content Available.</p>
            </div>
        </div>
<?php endif ?>