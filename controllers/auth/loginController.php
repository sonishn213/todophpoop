<?php


class Login
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function checkWithDb($data)
    {
        try {
            $email = $data['email'];
            $password = $data['password'];
            echo '<script>console.log(' . json_encode($data) . ')</script>';

            $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password` = '$password'";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $response = [
                        "message" => "User exists",
                        "data" => mysqli_fetch_all($result, MYSQLI_ASSOC),
                        "exists" => true,
                    ];
                    return $response;
                } else {
                    throw new Exception("User not found");
                }
            } else {
                throw new Exception("Could not check");
            }
        } catch (Exception $error) {
            return $response = [
                "message" => $error,
                "data" => [],
                "exists" => false,
            ];
        }
    }
}
