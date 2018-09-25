<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="../../public/css/style.css" rel='stylesheet' type='text/css'>

    <title>Document</title>
</head>
<body>
    <?php
        if (file_exists($template_path)) {
            include $template_path;
        } else {
            throw new \Exception("$template_path not found");
        }
    ?>
    <script src="../../public/js/app.js"></script>
</body>
</html>