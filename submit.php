<?php
function connectionToDataBase($servername, $username, $password, $dbname)
{
    /*Function of connection to our database*/
    $connection = new Mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {//check our connection
        die("Connection failed: " . $connection->connect_error);
    } else {
        return $connection;
    }
}

if (isset($_POST['registration'])) {
    /*Get our user data*/
    $userName = $_POST['Username'];
    $userEmail = $_POST['Useremail'];
    $userPassword = md5($_POST['Userpassword']);
    $userFirstName = $_POST['UserFirstName'];
    $userLastName = $_POST['UserLastName'];
    $userAge = $_POST['UserAge'];
    $userGender = ($_POST['male']) ? $_POST['male'] : $_POST['femail'];


    $connection = connectionToDataBase('localhost', 'root', '', 'user_data');//connection to database

    // insert data
    $sql = "INSERT INTO `users` (`user-name`,`user-email`,`user-password`,`user-firstname`,`user-lastname`,`user-age`,`user-gender`)
    VALUES ('$userName','$userEmail','$userPassword','$userFirstName','$userLastName','$userAge','$userGender')";
    $resultVar = $connection->query($sql);
}

if ($_POST['userControlName']) {

    $connection = connectionToDataBase('localhost', 'root', '', 'user_data');//connection to database
    $sql = "SELECT `user-name`,`user-password` FROM `users` WHERE 1";//"SELECT  `user-name` FROM `user_registration_data`";
    $resultLet = $connection->query($sql);

    $checkUserInf = [//array with data which enter user
        'user-name' => $_POST['userControlName'],
        'user-password' => md5($_POST['userControlPassword']),
    ];


    if ($resultLet->num_rows > 0) {
        while ($row = $resultLet->fetch_assoc()) {

            $userData = [//array with data from database
                'user-name' => $row["user-name"],
                'user-password' => $row["user-password"],
            ];
            if ($userData == $checkUserInf) {//if user data and data from database are the same
                $find = true;
            }
        }
    } else {
        echo "0 results";
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<?php
if ($_POST['userControlName']) {
    if ($find) {
        echo 'You are in our database';
    } else {
        echo 'We don\'t have you in our database';
    }
}
?>


<?php
if ($resultVar) {
    ?>
    <h1><?php echo 'You was successful add to our database!' ?></h1>
    <?php
}
?>


<script src="assets/js/libs.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>