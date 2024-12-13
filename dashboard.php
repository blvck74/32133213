<?php
// Подключаем конфигурацию и базу данных
include 'config.php';
session_start();

if (!isset($_SESSION)) {
    session_start();
}

// Проверка, если пользователь не авторизован, перенаправляем на страницу логина
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0">
    <meta name="description" content="A conversational AI system that listens, learns, and challenges">
    <meta property="og:title" content="ChatGPT">
    <meta property="og:image" content="assets/img/ChatGPT.jpg">
    <meta property="og:description" content="A conversational AI system that listens, learns, and challenges">
    <meta property="og:url" content="https://yourdomain.com">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/img/site.webmanifest">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@latest/build/styles/base16/dracula.min.css">
    <title>Dashboard - FixIt</title>
</head>

<body data-urlprefix="/">
    <div class="main-container">
        <div class="box sidebar">
            <div class="top">
                <button class="button" onclick="new_conversation()">
                    <i class="fa-regular fa-plus"></i>
                    <span>New Conversation</span>
                </button>
                <div class="spinner"></div>
            </div>
            <div class="sidebar-footer">
                <button class="button" onclick="delete_conversations()">
                    <i class="fa-regular fa-trash"></i>
                    <span>Clear Conversations</span>
                </button>
                <div class="settings-container">
                    <div class="checkbox field">
                        <span>Dark Mode</span>
                        <input type="checkbox" id="theme-toggler">
                        <label for="theme-toggler"></label>
                    </div>
                    <div class="field">
                        <span>Language</span>
                        <select class="dropdown" id="language" onchange="changeLanguage(this.value)"></select>
                    </div>
                </div>
                <a class="info" href="" target="_blank">
                    <i class="fa-brands fa-github"></i>
                    <span class="conversation-title"> Version: 0.1.0 </span>
                </a>
            </div>
        </div>
        <div class="conversation">
            <div class="stop-generating stop-generating-hidden">
                <button class="button" id="cancelButton">
                    <span>Stop Generating</span>
                </button>
            </div>
            <div class="box" id="messages"></div>
            <div class="user-input">
                <div class="box input-box">
                    <textarea id="message-input" placeholder="Ask a question" cols="30" rows="10" style="white-space: pre-wrap"></textarea>
                    <div id="send-button">
                        <i class="fa-regular fa-paper-plane-top"></i>
                    </div>
                </div>
            </div>
            <div>
                <div class="options-container">
                    <div class="buttons">
                        <div class="field">
                            <select class="dropdown" name="model" id="model">
                                    <option value="gpt-3.5-turbo">GPT-3.5</option>
                                    <option value="gpt-4o-mini" selected>GPT-4o-mini</option>
                                    <option value="gpt-4o" selected>GPT-4o</option>
                            </select>
                        </div>
                    </div>
                    <div class="field checkbox">
                        <input type="checkbox" id="switch">
                        <label for="switch"></label>
                        <span>Web Access</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-button">
        <i class="fa-solid fa-bars"></i>
    </div>

    <!-- scripts -->
    <script>
        window.conversation_id = "<?php echo $_SESSION['user_id']; ?>";
    </script>
    <script src="assets/js/icons.js"></script>
    <script src="assets/js/chat.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/markdown-it@latest/dist/markdown-it.min.js"></script>
    <script src="assets/js/highlight.min.js"></script>
    <script src="assets/js/highlightjs-copy.min.js"></script>
    <script src="assets/js/theme-toggler.js"></script>
    <script src="assets/js/sidebar-toggler.js"></script>
    <script src="assets/js/change-language.js"></script>
</body>
</html>
