<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/core/autoloader.php');


use Db\Basic;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $result = new Basic();
    $arResult = $result->getList(table: 'users', params: [
        'result' => ['LOGIN'],
        'filter' => [1]
        'limit' => [
            'rows'=> 2,
            'offset' =>2,
        ]
    ])
    ?>

    <pre><?print_r(value: $arResult)?></pre>
</body>
</html>