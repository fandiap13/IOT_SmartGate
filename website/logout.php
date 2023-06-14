<?php

include("config.php");

unset($_SESSION['is_login']);

header("location:" . base_url('login.php'));
