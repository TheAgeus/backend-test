<?php
session_start();
/*
if ( !empty($_SESSION['token']) ) {
    echo $_SESSION['token'];
    echo $_SESSION['rol'];
} else {
    echo "No deberías estar aquí";
}
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['rol']; ?></title>
</head>
<body>
</body>
</html>