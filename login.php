<?php
// Подключаем конфигурацию и базу данных
include 'config.php';

// Начинаем сессию
session_start();

// Проверка, если пользователь авторизован, перенаправляем на dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

// Обработка формы входа
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Получаем данные пользователя из базы
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Проверяем, есть ли пользователь с таким email и совпадает ли пароль
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Сохраняем идентификатор пользователя в сессии
        header('Location: dashboard.php'); // Перенаправляем на главную страницу
        exit;
    } else {
        $error_message = "Неверный email или пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Войти - FixIt</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="public/assets/favicon.ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div id="vanta-background" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>

    <!-- Форма входа -->
    <main>
        <section class="form-section">
            <div class="container">
                <h1 class="text-center text-white">Войти</h1>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form style="text-align:center" action="login.php" method="POST">
                    <div style="text-align:center" class="form-group">
                        <label for="email" class="text-white">Электронная почта</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div style="text-align:center" class="form-group">
                        <label for="password" class="text-white">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-login">Войти</button>

                </form>

                <p class="text-white text-center mt-3">Нет аккаунта? <a href="register.php" class="text-white">Зарегистрироваться</a> <a class="text-white" href="index.php">Главная</a></p>
            </div>
        </section>
    </main>

    <!-- Подвал -->
    <footer>
        <div class="container text-center text-white py-3">
            <p>&copy; 2024 FixIt. Все права защищены.</p>
        </div>
    </footer>

    <script src="assets/js/three.r134.min.js"></script>
    <script src="assets/js/vanta.net.min.js"></script>
    <script>
        VANTA.NET({
            el: "#vanta-background",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            points: 12.00,
            maxDistance: 28.00
        });
    </script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
