<?php
session_start();
session_destroy();
header("Location: /todophp");
die();
