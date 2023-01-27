<?php
require "./database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $arr = false;
    $arr["username"] = $username;
    $arr["password"] = $password;

    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stm = $connection->prepare($sql);
    $check = $stm->execute($arr);

    if ($check) {
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if (count($data) > 0) {
            $data = $data[0];
            $_SESSION["name"] = $data->username;
            header("Location: index");
            die;
        }
    } else {
        die("We can't connect to the databse, try again later!");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="flex justify-center items-center h-screen w-screen">
    <form action="" method="post">
        <div class="w-80 h-60 flex flex-col gap-2 bg-zinc-800 p-4">
            <input type="text" name="username" required placeholder="Username" class="w-full p-2 border border-black">
            <input type="password" name="password" required placeholder="Password" class="w-full p-2 border border-black">
            <input type="submit" value="Login" class="w-full p-2 bg-white mt-4">
        </div>
    </form>
</body>

</html>