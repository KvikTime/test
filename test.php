<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));

    // Указываем адрес, на который будет отправлено письмо
    $to = "kurzaevvitek@mail.ru"; // Замени на свой email

    // Формируем тему письма
    $subject = "Новое сообщение с сайта от $name";

    // Формируем тело письма
    $body = "Имя: $name\n";
    $body .= "Электронная почта: $email\n";
    $body .= "Номер телефона: $phone\n";

    // Обработка вложенного файла
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $file = $_FILES["file"];
        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];

        // Путь для временного сохранения файла
        $uploadDir =__DIR__ . "uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filePath = $uploadDir . basename($fileName);

        // Перемещаем файл в папку
        if (move_uploaded_file($fileTmpName, $filePath)) {
            $body .= "\nПрикреплённый файл: $fileName";
        } else {
            $body .= "\nОшибка при загрузке файла.";
        }
    }

    // Заголовки для письма
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Отправляем письмо
    if (mail($to, $subject, $body, $headers)) {
        // Перенаправляем на страницу успеха
        header("Location: ok.html");
        exit;
    } else {
        // Перенаправляем на страницу ошибки
        header("Location: error.html");
        exit;
    }
} else {
    // Если данные не были отправлены методом POST, перенаправляем на форму
    header("Location: form.html");
    exit;
}
?>
