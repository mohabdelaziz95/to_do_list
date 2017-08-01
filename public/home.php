<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 7/12/17
 * Time: 3:02 AM
 */

require_once '../private/core/init.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$user = new User($username);
if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
} else {
    if (!$user->exists()) {
        Redirect::to(404);
    } else {
        $data = $user->data();
    }
}

?>

<div id="profile">

    <div class="profile-image">
        <img src="img/user.png" alt="profile-pic" title="profile-pic">
    </div>

    <div class="profile-details">
        <h2><?php if (isset($data)) {echo htmlspecialchars($data->fullname);}?></h2>
        <h3>@<?php if (isset($data)) {echo htmlspecialchars($data->username);}?></h3>
        <button onclick="showUpdatePage()" class="btn btn-success" id="edit">Edit <span class="glyphicon glyphicon-edit"></span></button>
    </div>

</div>

<div id="update-profile">

    <div class="profile-image">
        <img src="img/user.png" alt="profile-pic" title="profile-pic">
    </div>

    <div id="notifications">
        <ul id="success">
            <li class="alert-success" id="successMessage"></li>
        </ul>

        <ul id="error">
            <li class="alert-danger" id="errorMessage"></li>
        </ul>
    </div>

    <div class="profile-details">

        <form action="update.php" method="post" id="updateForm">
            <input class="form-control" id="name" name="Fullname" type="text"  placeholder="Fullname" value="<?php if (isset($data)) {echo htmlspecialchars($data->fullname);}?>">
            <input class="form-control" id="username" name="Username" type="text" placeholder="Username" value="<?php if (isset($data)) {echo htmlspecialchars($data->username);}?>">
            <input type="hidden" name="token" value="<?php echo Token::generate();?>">
            <button onclick="updateProfile()" type="button" id="update-button" name="update" class="btn btn-success">Update</button>
        </form>
    </div>
</div>

<div id="todo">
    <form action="todo.php" method="post" id="TodoForm">
        <div id="todo-head">
            <h3>Todo list</h3>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" id="todo-text" class="form-control" name="todo-text" placeholder="Add todo" autocomplete="off" required>
                    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                    <span class="input-group-btn">
                    <button onclick="todo()" id="Add" class="btn btn-success" name="add" type="button" value="add">Add!</button>
                    </span>
                </div>
            </div>
        </div>

        <div id="todo-body">
            <ul id="list-group" class="list-group">
                <?php

                $sth = DB::getInstance();
                $lastId = $sth->lastInsertId('id', 'to_do_lists');
                foreach ($lastId as $results) {
                    foreach ($results as $key => $result) {
                        if ($key == 'MAX(id)') {
                            $lastInsertedId = $result;
                        }
                    }
                }
                if (isset($lastInsertedId)) {
                    $records = $sth->get('to_do_lists', ['id', '=', 'id'], $lastInsertedId);
                    $lastRecords = $records->results();
                    if ($records->count()) {
                        foreach ($lastRecords as $lastRecord) {
                            foreach ($lastRecord as $key => $lastRecordValue) {
                                if ($key == 'lists') { ?>
                                    <li id="lastInsertedId" class="list-group-item">
                                    <label for="todo-status" id="show"> <?php echo htmlspecialchars($lastRecordValue); ?></label>
                                    <div class="options">
                                        <a href="#" name="notdone" class="mark-as" > <span style="color: #2C82C9" class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></a>
                                        <button onclick="deleteList()" type="button" class="delete" name="delete" value="delete"><span style="color: red" class="glyphicon glyphicon-trash"></span></button>                                    </div>
                                    </li>
                                    <?php
                                }
                            }
                        }
                    }
                }
                ?>

                <?php
                $db = DB::getInstance();
                $lists = $db->get('to_do_lists', ['user_id', '=', 'user_id'], $data->id, "id DESC");
                $listsData = $lists->results();
                if ($lists->count()) {
                    foreach ($listsData as $results) { ?>
                        <li class="list-group-item">
                            <div class="options">
                                <button onclick="deleteList()" type="button" class="delete" name="delete" value="delete"><span style="color: red" class="glyphicon glyphicon-trash"></span></button>
                            </div>

                            <?php if ($results->status) { ?>
                                <label for="todo-status"><span class="<?php echo 'done'?>"><?php echo htmlspecialchars($results->lists)?></span></label>
                                <div class="options">
                                    <a href="markas.php?as=done&id=<?php echo $results->id;?>" name="done" class="mark-as <?php echo '-done';?>"> <span style="color: #2C82C9" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                </div>
                            <?php } else { ?>
                                <label for="todo-status"><span class=""><?php echo htmlspecialchars($results->lists)?></span></label>
                                <div class="options">
                                    <a href="markas.php?as=notdone&id=<?php echo $results->id;?>" name="notdone" class="mark-as" > <span style="color: #2C82C9" class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></a>
                                </div>
                            <?php }?>
                        </li>
                    <?php }} ?>
            </ul>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php';?>