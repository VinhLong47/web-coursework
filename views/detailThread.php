<?php 
use MVC\core\Application;
use MVC\models\User;
use MVC\models\ModuleModel;

$guest = Application::isGuest();
if (!$guest) $me = Application::$app->user;
?>

<div class="row">
    <div class="col d-flex justify-content-center">
        <h2 class="position-relative"><?=$thread->name?></h2>
    </div>
</div>
<div class="row mb-4">
    <div class="col d-flex justify-content-center">
            <div class="card" id="<?echo $thread->id?>" style="width: 40rem;">
                <?php if(!empty($thread->img)): ?>
                    <img src="<?=$thread->img?>" class="card-img-top" width="378" height="359" alt="<?=$thread->img?>">
                <?php endif ?>
                <div class="card-body">
                    <p class="card-text">Created At: <?=$thread->created_at?>
                        <?php if(isset($me) && $me->id == $thread->user_id): ?>
                            <span> | </span>
                            <span><a href="/#" data-toggle="modal" data-target="#editThread<?=$thread->id?>">Edit</a></span>
                            <span> | </span>
                            <span><a href="/#" data-toggle="modal" data-target="#deleteThread<?=$thread->id?>">Delete</a></span>
                        <?php endif ?>
                    </p>
                    <h4 class="mt-2">Description</h3>
                    <p class="card-text"><?=$thread->description?></p>
                </div>
                <div class="card-body">
                    <form action="/threads/<?=$thread->id?>/comment" method="post">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                            <button class="btn btn-success mt-2">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Latest comments</h5>
                </div>
                <?php if(isset($comments)):?>
                    <?php foreach($comments as $comment): ?>
                        <div class="card-body">
                            <h5 class="card-title"><?=User::findOne(["id" => $comment["user_id"]])->getDisplayName()?></h5>
                            <p class="card-text"><?=$comment["comment"]?></p>    
                        </div>
                    <?php endforeach ?>
                    <?php if($totalPage > 1): ?>
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <?php for($i = 0; $i < $totalPage; ++$i): ?>
                                    <a href="/threads/<?=$thread->id?>?page=<?php echo $i+1 ?>" class="text-decoration-none <?php echo $currentPage == $i+1 ? 'text-dark' : '' ?>"><?php echo $i+1 ?></a>
                                <?php endfor ?>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endif ?>
                <div class="modal" id="editThread<?=$thread->id?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit This Thread!</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">x</button>
                            </div>
                            <form action="/threads/<?=$thread->id?>/edit" method="post" enctype="multipart/form-data">
                                <div class="modal-body">  
                                        <div class="mb-3">
                                            <label for="subject" class="col-form-label">Subject:</label>
                                            <input type="text" class="form-control" id="subject" name="name" value="<?=$thread->name?>">
                                        </div>
                                        <input class="form-control" type="hidden" name="id" value="<?=$thread->id?>"/>
                                        <div class="mb-3">
                                            <label for="descriptopm" class="col-form-label">Message:</label>
                                            <input type="text" class="form-control" id="descriptopm" name="descriptoion" value="<?=$thread->description?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" class="col-form-label">Select A Module</label>
                                            <select id="exampleFormControlSelect1" required name="module_id" class="form-control">
                                                <?php 
                                                foreach(ModuleModel::findAll() as $module): 
                                                ?>
                                                    <option value="<?=$module['id']?>" <?=$thread->module_id == $module['id'] ? 'selected' : ''?>><?=$module['name']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-outline flex-fill mb-4">
                                            <input type="file" id="img" class="form-control" name="img" accept="image/*"/>
                                            <label class="form-label" for="form3Example4cd">Image</label>
                                        </div>
                                        <?php if(isset($thread->img)): ?>
                                            <div class="form-outline flex-fill mb-4">
                                                <p>Filename Uploaded Before: <?=$thread->img?></p>
                                            </div>
                                        <?php endif ?>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-outline-primary" role="button">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal" id="deleteThread<?=$thread->id?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete This Thread!</h5>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to delete this thread?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                            <a href="/threads/<?=$thread->id?>/delete" class="btn btn-outline-danger" role="button">Yes</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>