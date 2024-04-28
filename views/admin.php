<?php

$this->title = 'Admin Dashboard';
enum Tab: string
{
    case Module = "modules";
    case User = "users";
    case Thread = "threads";
    case Contact = "contacts";
    case Comment = "comments";
}
?>

<?php  
use MVC\Core\Application;
use MVC\models\ModuleModel;
use MVC\models\User;
use MVC\models\ThreadModel;

    $user = Application::$app->user;
?>

<h1>Admin Dashboard</h1>
<div class="card mb-5">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?=$tab == Tab::Module->value ? 'active' : ''?>"  href="/admin?tab=modules&page=1">Modules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$tab == Tab::User->value ? 'active' : ''?>" href="/admin?tab=users&page=1">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$tab == Tab::Thread->value ? 'active' : ''?>" href="/admin?tab=threads&page=1">Threads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$tab == Tab::Contact->value ? 'active' : ''?>" href="/admin?tab=contacts&page=1">Contacts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$tab == Tab::Comment->value ? 'active' : ''?>" href="/admin?tab=comments&page=1">Comments</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content mt-3">
            <div class="table-responsive tab-pane <?=$tab == Tab::Module->value ? 'active' : ''?>" id="modules" role="tabpanel">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <tr>
                            <a role="button" class="btn btn-outline-primary" href="/admin/modules/add">
                                Add
                            </a>
                        </tr>
                        <?php if($totalPageModules > 0): ?>
                            <tr>
                                <p class="mt-4">
                                    Total modules: <?=$totalModules?> | Page:
                                    <?php for($moduleIndex = 0; $moduleIndex < $totalPageModules; ++$moduleIndex): ?>
                                        <a
                                            href="/admin?page=<?=$moduleIndex+1?>&tab=modules" 
                                            class="text-decoration-none <?=$currentPage == $moduleIndex+1 ? 'text-dark' : ''?>">
                                            <?=$moduleIndex+1?>
                                        </a>
                                    <?php endfor ?>
                                </p>
                            </tr>
                        <?php endif ?>
                    </thead>
                    <tbody>
                        <?php
                            if($modules):
                        ?>
                            <?php
                                foreach ($modules as $module):
                            ?>
                                <tr>
                                    <td><a href="/admin/modules/<?=$module["id"]?>/edit"><?=$module["name"]?></a></td>
                                    <td><?=$module["created"]?></td>
                                    <td>
                                        <a href="/admin/modules/<?=$module["id"]?>/edit">Edit</a> | 
                                        <a href="/#" data-toggle="modal" data-target="#deleteModule<?=$module["id"]?>">Delete</a>
                                    </td>
                                </tr>
                                <div class="modal" id="deleteModule<?=$module["id"]?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <p>Do you want to delete this module?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                            <a href="/admin/modules/<?=$module["id"]?>/delete" class="btn btn-outline-danger" role="button">Yes</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8"><p class="mt-4 text-center">No Content.</p></td>
                            </td>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
                
            <div class="table-responsive tab-pane <?=$tab == Tab::User->value ? 'active' : ''?>" id="users" role="tabpanel" aria-labelledby="users-tab">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Is Admin</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <tr>
                            <a role="button" class="btn btn-outline-primary" href="/admin/users/add">
                                Add
                            </a>
                        </tr>
                        <?php if($totalPageUsers > 0): ?>
                            <tr>
                                <p class="mt-4">
                                    Total users: <?=$totalUsers?> | Page:
                                    <?php for($userPageIndex = 0; $userPageIndex < $totalPageUsers; ++$userPageIndex): ?>
                                        <a 
                                            href="/admin?page=<?=$userPageIndex+1?>&tab=users" 
                                            class="text-decoration-none <?=$currentPage == $userPageIndex+1 ? 'text-dark' : ''?>">
                                            <?=$userPageIndex+1?>
                                        </a>
                                    <?php endfor ?>
                                </p>
                            </tr>
                        <?php endif ?>
                    </thead>
                    <tbody>
                        <?php if($users): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><a href="/admin/users/<?=$user["id"]?>/edit"><?=$user["username"]?></a></td>
                                    <td><a href="/admin/users/<?=$user["id"]?>/edit"><?=$user["email"]?></a></td>
                                    <td><?=$user["is_admin"] ? "Yes" : "No"?></td>
                                    <td><?=$user["created"]?></td>
                                    <td>
                                        <a href="/admin/users/<?=$user["id"]?>/edit">Edit</a>
                                        <a href="/#" data-toggle="modal" data-target="#deleteUser<?=$user["id"]?>">Delete</a>
                                    </td>
                                </tr>
                                <div class="modal" id="deleteUser<?=$user["id"]?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete This User!</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to delete this user?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                            <a href="/admin/users/<?=$user["id"]?>/delete" class="btn btn-outline-danger" role="button">Yes</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><p class="mt-4 text-center">No Content.</p></td>
                            </td>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive tab-pane <?=$tab == Tab::Thread->value ? 'active' : ''?>" id="threads" role="tabpanel" aria-labelledby="threads-tab">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">Description</th>
                            <th scope="col">Author</th>
                            <th scope="col">Module</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php if($totalPageThreads > 0): ?>
                            <tr>
                                <p class="mt-4">
                                    Total threads: <?=$totalThreads?> | Page:
                                    <?php for($threadIndex = 0; $threadIndex < $totalPageThreads; ++$threadIndex): ?>
                                        <a 
                                            href="/admin?page=<?=$threadIndex+1?>&tab=threads" 
                                            class="text-decoration-none <?=$currentPage == $threadIndex+1 ? 'text-dark' : ''?>">
                                            <?=$threadIndex+1?>
                                        </a>
                                    <?php endfor ?>
                                </p>
                            </tr>
                        <?php endif ?>
                    </thead>
                    <tbody>
                        <?php if($threads): ?>
                            <?php foreach ($threads as $thread): ?>
                                <tr>
                                    <td><?=$thread["name"]?></td>
                                    <td><?=$thread["description"]?></td>
                                    <td><?=User::findOne(["id" => $thread["user_id"]])->username?></td>
                                    <td><?=ModuleModel::findOne(["id" => $thread["module_id"]])->name?></td>
                                    <td><?=$thread["created_at"]?></td>
                                    <td>
                                        <a href="/#" data-toggle="modal" data-target="#deleteThread<?=$thread["id"]?>">Delete</a>
                                    </td>
                                </tr>
                                <div class="modal" id="deleteThread<?=$thread["id"]?>" tabindex="-1">
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
                                            <a href="/admin/threads/<?=$thread["id"]?>/delete" class="btn btn-outline-danger" role="button">Yes</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><p class="mt-4 text-center">No Content.</p></td>
                            </td>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive tab-pane <?=$tab == Tab::Contact->value ? 'active' : ''?>" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php if($totalPageContacts > 0): ?>
                            <tr>
                                <p class="mt-4">
                                    Total contacts: <?=$totalContacts?> | Page:
                                    <?php for($contactIndex = 0; $contactIndex < $totalPageContacts; ++$contactIndex): ?>
                                        <a 
                                            href="/admin?page=<?=$contactIndex+1?>&tab=contacts" 
                                            class="text-decoration-none <?=$currentPage == $contactIndex+1 ? 'text-dark' : ''?>">
                                            <?=$contactIndex+1?>
                                        </a>
                                    <?php endfor ?>
                                </p>
                            </tr>
                        <?php endif ?>
                    </thead>
                    <tbody>
                        <?php if($contacts): ?>
                            <?php foreach ($contacts as $contact): ?>
                                <tr>
                                    <td><?=$contact["subject"]?></td>
                                    <td><?=$contact["message"]?></td>
                                    <td><?=$contact["email"]?></td>
                                    <td><?=$contact["created_at"]?></td>
                                    <td>
                                        <a href="/#" data-toggle="modal" data-target="#deleteContact<?=$contact["id"]?>">Delete</a>
                                    </td>
                                </tr>
                                <div class="modal" id="deleteContact<?=$contact["id"]?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete This Contact!</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to delete this contact?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                            <a href="/admin/contacts/<?=$contact["id"]?>/delete" class="btn btn-outline-danger" role="button">Yes</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><p class="mt-4 text-center">No Content.</p></td>
                            </td>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive tab-pane <?=$tab == Tab::Comment->value ? 'active' : ''?>" id="<?=Tab::Comment->value?>" role="tabpanel" aria-labelledby="<?=Tab::Comment->value?>-tab">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Comment</th>
                            <th scope="col">Thread</th>
                            <th scope="col">Author</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php if($totalPageComments > 0): ?>
                            <tr>
                                <p class="mt-4">
                                    Total comemnts: <?=$totalComments?> | Page:
                                    <?php for($contactIndex = 0; $contactIndex < $totalPageComments; ++$contactIndex): ?>
                                        <a 
                                            href="/admin?page=<?=$contactIndex+1?>&tab=<?=Tab::Comment->value?>" 
                                            class="text-decoration-none <?=$currentPage == $contactIndex+1 ? 'text-dark' : ''?>">
                                            <?=$contactIndex+1?>
                                        </a>
                                    <?php endfor ?>
                                </p>
                            </tr>
                        <?php endif ?>
                    </thead>
                    <tbody>
                        <?php if($comments): ?>
                            <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <td><?=$comment["comment"]?></td>
                                    <td><?=ThreadModel::findOne(["id" => $comment["thread_id"]])->name?></td>
                                    <td><?=User::findOne(["id" => $comment["user_id"]])->username?></td>
                                    <td><?=$comment["created"]?></td>
                                    <td>
                                        <a href="/#" data-toggle="modal" data-target="#deleteComment<?=$comment["id"]?>">Delete</a>
                                    </td>
                                </tr>
                                <div class="modal" id="deleteComment<?=$comment["id"]?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete This Comment!</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to delete this comment?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                            <a href="/admin/comments/<?=$comment["id"]?>/delete" class="btn btn-outline-danger" role="button">Yes</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><p class="mt-4 text-center">No Content.</p></td>
                            </td>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>