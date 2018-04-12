<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../Content/login.css">
    <link rel="stylesheet" href="../Content/bootstrap.min.css">
</head>
<body>
<?php

include_once("../Controllers/loginController.php");

$data = $_POST;
$errors = array();

if (isset($data['btn_login'])) {

    if (trim($data['email']) == '') {
        $errors['email'] = "Введите email";
    }
    if (trim($data['password']) == '') {
        $errors['password'] = "Введите пароль";
    }

    if(empty($errors)) {
        $user = LoginController::LogIn($data);

        if($user == null){
            $errors['invalid_data'] = "Неправильный email или пароль";
        }
        else{
            $_SESSION["currentUser"] = $user;
            header('Refresh: 0; URL=main.php');
        }
    }
}
?>

<div class="content">
    <div class="main">
        <div class="caption">
            <H1>Добро пожаловать в <br> File Sharing Comfort!</H1>
        </div>
        <div class="text1">
            <h1>Вход</h1>
            <small style=" color:red" id="email_error"><?= $errors['invalid_data'] ?? '' ?></small>
        </div>
        <div class="myform">
            <form class="px-4 py-3" action="login.php" method="post">
                <div class="form-group">
                    <label for="exampleDropdownFormEmail1">Адресс эл. почты</label>
                    <br>
                    <input type="email" name="email" class="form-control" id="exampleDropdownFormEmail1"
                           placeholder="email@example.com" value="<?=$data['email'] ?? '' ?>">
                    <small style=" color:red" id="email_error"><?= $errors['email'] ?? '' ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormPassword1">Пароль</label>
                    <br>
                    <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1"
                           placeholder="Password" value="<?=$data['password'] ?? '' ?>">
                    <small style=" color:red" id="email_error"><?= $errors['password']  ?? '' ?></small>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                    <label class="form-check-label" for="dropdownCheck">
                        Запомнить пароль
                    </label>
                </div>
                <button type="submit" name="btn_login" class="btn btn-primary">Вход</button>
            </form>
            <div class="dropdown-divider"></div>
            <a class="help dropdown-item" href="#">Создать аккаунт</a>
            <a class="dropdown-item help" href="#">Забыли пароль?</a>
        </div>
    </div>
</div>
</body>
</html>