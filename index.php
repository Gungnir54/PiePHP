<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
</head>
<body>
    <?php
        define('BASE_URI', str_replace('\\', '/', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
        require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));
        $app = new Core\Core();
        $app->dynamicRun();
    ?>
</body>
</html>