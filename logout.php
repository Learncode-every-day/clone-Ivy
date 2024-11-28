<?php

session_start();
if (isset($_SESSION['myAccount'])) {
    unset($_SESSION['myAccount']);
    unset($_SESSION['first-visit']);
}
header('location: http://localhost/clone-Ivy/');
