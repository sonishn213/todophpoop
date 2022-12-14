<?php

//urls for navigation bar
$urls = [
    [
        "text" => "Home",
        "link" => "/todophp",
    ],
    [
        "text" => "Login",
        "link" => "/todophp/auth/login.php",
    ]
    //add new entry to insert new navabar link
];

if (isset($_SESSION['useremail'])) {

    $urls = [
        [
            "text" => "Home",
            "link" => "/todophp",
        ],
        [
            "text" => "Logout",
            "link" => "/todophp/auth/logout.php",
        ]
        //add new entry to insert new navabar link
    ];
}
//current url
$CURRENT_PATH = $_SERVER['REQUEST_URI'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <title><?php echo $titleofpage ?></title>

</head>


<body>
    <nav class="navbar  navbar-expand-lg  navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><strong> TODO APP</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- links-->
                    <?php foreach ($urls as $links) : ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo ((trim($links['link'], "/") === trim($CURRENT_PATH, "/")) ? 'active' : ""); ?>" href='<?php echo $links['link']; ?>'>
                                <?php echo $links['text']; ?>
                            </a>
                        </li>

                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </nav>