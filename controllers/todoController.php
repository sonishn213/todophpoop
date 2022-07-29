<?php
class Todo
{

    private $conn;
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    //get all todos from database
    public function getAllTodo()
    {
        try {
            $sql = 'SELECT * FROM `todos`';
            $result = mysqli_query($this->conn, $sql);
            $todos = [];
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $todos = mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
                return  $todos;
            } else {
                throw new Exception("Could not fetch data");
            }
        } catch (Exception $error) {
            echo "Error: " . $error->getMessage();
        }
    }

    //insert todo 
    public function addTodo($data)
    {
        try {
            trim($data);
            if (strlen($data) > 0) {
                $sql = "INSERT INTO `todos` (`todo`) values ('$data')";
                //run command
                $added = mysqli_query($this->conn,  $sql);
                //check if inserted
                if ($added) {
                    echo "Todo added";
                } else {
                    throw new Exception("Todo not added");
                }
            } else {
                throw new Exception("Please enter todo to add");
            }
        } catch (Exception $error) {
            echo "Error: " . $error->getMessage();
        }
    }

    //delete data
    public function deleteTodo($id)
    {
        try {
            //check if id is recieved
            if (isset($id)) {
                $sql = "DELETE FROM `todos` WHERE `id`= '$id'";
                $deleted = mysqli_query($this->conn, $sql);
                //check if deleted
                if ($deleted) {
                    echo "todo deleted";
                } else {
                    throw new Exception("Todo can't be deleted");
                }
            } else {
                throw new Exception("id not mentioned");
            }
        } catch (Exception $error) {
            echo 'Error: ' . $error->getMessage();
        }
    }

    //update data
    public function updateTodo($id, $data)
    {
        try {
            $data = trim($data);
            if (strlen($data) > 0) {
                $sql = "UPDATE `todos` SET `todo`='$data' WHERE `id`='$id'";
                $updated = mysqli_query($this->conn, $sql);
                if ($updated) {
                    echo "updated";
                } else {
                    throw new Exception("Todo not updated");
                }
            } else {
                throw new Exception("Please enter new text to update");
            }
        } catch (Exception $error) {
            echo "Not updated " . $error->getMessage();
        }
    }
}
