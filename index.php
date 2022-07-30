<?php
session_start();
include 'Configure/database.php';
include 'controllers/todoController.php';

if (!isset($_SESSION['useremail'])) {
    header("Location:  /todophp/auth/login.php");
    die();
}
$displaymsg = "";
//todo from database
$todosObj = new Todo($conn);

//ADD TO TODO
if (isset($_POST['submitform'])) {
    //get data from form
    $tododata = $_POST['todo'];
    //add to table
    $message = $todosObj->addTodo($tododata);
    // displat success or failure
    $displaymsg =  $message;
}

//DELETE TODO
if (isset($_POST['deletetodo'])) {
    //get id 
    $id = $_POST['todoid'];
    //delete todo
    $message = $todosObj->deleteTodo($id);
    //display success or failure
    $displaymsg =  $message;
}

//UPDATE TODO
if (isset($_POST['updatetodo'])) {
    //get id 
    $id = $_POST['todoid'];
    $data = $_POST['updateValue'];

    $message = $todosObj->updateTodo($id, $data);
    $displaymsg = $message;
}
//GET ALL TODO
$todos = $todosObj->getAllTodo();

?>

<?php
$titleofpage = "create Todo";
include 'includes/header.php'
?>

<!----->
<!-- Render start -->

<main>
    <div class="w-50 mx-auto ">
        <div class="mb-4 w-100 d-flex justify-content-center ">
            <div>
                <h1 class="mb-4">Todo App</h1>
                <!-- form to add todo-->
                <form method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
                    <input type="text" name="todo">
                    <input type="submit" name="submitform" value="ADD">
                </form>
                <p> <?php echo $displaymsg  ?></p>
            </div>

        </div>

        <!-- display todo-->
        <ul>
            <?php
            if (!empty($todos)) :
            ?>
                <table class="table table-striped table-hover border ">
                    <thead>
                        <tr>
                            <th scope="col">todos</th>
                            <th scope="col">update</th>
                            <th scope="col">delete</th>
                        </tr>
                    </thead>

                    <?php
                    foreach ($todos as $todo) :
                        $todoname = $todo['todo'];
                        $id = $todo['id'];
                    ?>
                        <tr>
                            <!-- display todo-->
                            <td> <?php echo $todoname ?> </td>

                            <td>
                                <!-- form to update todo-->
                                <form method='post' action=<?php echo $_SERVER['PHP_SELF'] ?>>
                                    <input type="text" name="todoid" value=<?php echo $id ?> hidden>
                                    <input type="text" name="updateValue" placeholder="Enter new todo to update ">
                                    <input type="submit" name="updatetodo" value="UPDATE">
                                </form>
                            </td>
                            <td>
                                <!-- form to delete todo-->
                                <form method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
                                    <input type="text" name="todoid" value=<?php echo $id ?> hidden>
                                    <input type="submit" name="deletetodo" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            <?php
            endif;
            ?>
        </ul>
        <!-- end of display todo-->
    </div>
</main>
<?php include 'includes/footer.php' ?>