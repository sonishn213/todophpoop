<?php
include 'Configure/database.php';
include 'controllers/todoController.php';

//todo from database
$todosObj = new Todo($conn);

//ADD TO TODO
if (isset($_POST['submitform'])) {
    //get data from form
    $tododata = $_POST['todo'];
    //add to table
    $message = $todosObj->addTodo($tododata);
    // displat success or failure
    echo $message;
}

//DELETE TODO
if (isset($_POST['deletetodo'])) {
    //get id 
    $id = $_POST['todoid'];
    //delete todo
    $message = $todosObj->deleteTodo($id);
    //display success or failure
    echo $message;
}

//UPDATE TODO
if (isset($_POST['updatetodo'])) {
    //get id 
    $id = $_POST['todoid'];
    $data = $_POST['updateValue'];

    $message = $todosObj->updateTodo($id, $data);
    echo $message;
}
//GET ALL TODO
$todos = $todosObj->getAllTodo();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Todo App</h1>
    <form method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
        <input type="text" name="todo">
        <input type="submit" name="submitform" value="ADD">
    </form>
    <ul>
        <?php
        if (!empty($todos)) :
            foreach ($todos as $todo) :
                $todoname = $todo['todo'];
                $id = $todo['id'];
        ?>
                <li>
                    <?php echo $todoname ?>
                    <div style="display:flex;">
                        <form method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
                            <input type="text" name="todoid" value=<?php echo $id ?> hidden>
                            <input type="submit" name="deletetodo" value="DELETE">
                        </form>
                        <form method='post' action=<?php echo $_SERVER['PHP_SELF'] ?>>
                            <input type="text" name="todoid" value=<?php echo $id ?> hidden>
                            <input type="text" name="updateValue">
                            <input type="submit" name="updatetodo" value="UPDATE">
                        </form>
                    </div>

                </li>
        <?php
            endforeach;
        endif;
        ?>


    </ul>
</body>

</html>