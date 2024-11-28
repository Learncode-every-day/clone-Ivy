<!-- <script>
    alert(sessionStorage.getItem('user_role'));
</script> -->

<?php
session_start();
if ($_SESSION['user_role'] == 'admin') {
    if (!isset($_SESSION['first_visit'])) {
        echo '<script>alert("Chào mừng " + ' . json_encode($_SESSION['user_full_name']) . ' + " đến với trang quản lý!")</script>';
        $_SESSION['first_visit'] = true;
    }
} else {
    echo '<script>
    const confirm1 = confirm("Quyền hạn của bạn không đủ xin vui lòng không ấn lần 2 !?");
    if(confirm1) {
        window.location.href="http://localhost/clone-Ivy/index.php";
    }
    </script>';
    $_SESSION['first-visit'] = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ivy-Project | Admin</title>
    <link rel="stylesheet" href="./assets/css/styles.css" />
    <link rel="stylesheet" href="./assets/css/category-list.css">
    <link rel="stylesheet" href="./assets/css/product-list.css">
    <scri src="./ckeditor/ckeditor.js"></scri>
    <script src="./ckfinder/ckfinder.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="../assets/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../assets/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../assets/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../assets/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../assets/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../assets/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <header>
        <h1>Admin</h1>
    </header>