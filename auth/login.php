<?php
session_start();
$titleofpage = "login";
include '../Configure/database.php'; //database configuration
include '../includes/header.php'; //header
include '../controllers/auth/loginController.php'; //for login functions
require '../includes/sessions.php'; //to check session
require '../helpers/validation/validation.php';

$loginObj = new Login($conn);
if (isset($_POST['login'])) {
    $data["email"] = ["type" => 'email', 'data' => $_POST['email']];
    $data["password"] = ["type" => 'password', 'data' => $_POST['password']];

    $newData = validateBatch(["email" => $data['email']]);

    if ($newData['errorfound']) {
        echo '<script>alert("found error")</script>';
    } else {

        $response = $loginObj->checkWithDb(["email" => $newData['data']['email']['data'], 'password' => $data["password"]['data']]);
        if ($response['exists']) {
            //extract user from response
            $userData = $response['data'][0];
            //set session to make user logedin
            $_SESSION['useremail'] =   $userData['email'];
            header("Location: /todophp");
            die();
        } else {
            echo "<script>alert('failed')</script>";
        }
    }
}
?>
<main class="container-fluid  ">
    <div class="w-25   mx-auto bg-light shadow-lg p-5">
        <div>
            <h1 class="text-center text-uppercase">login</h1>
            <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
                <input class="form-control mt-3" name="email" type="email" placeholder="Enter your email" />
                <input class="form-control  mt-3" name="password" type="password" placeholder="Enter your Password" />
                <input class="btn btn-primary mt-3 w-100" name="login" type="submit" value="Login" />
            </form>
        </div>
    </div>

</main>
<?php
include '../includes/footer.php';
?>