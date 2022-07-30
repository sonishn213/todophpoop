<?php
if (isset($_SESSION['useremail'])) {
    header("Location: /todophp");
    die();
}
