<?php

require_once '../vendor/autoload.php';

$params = [
    'geo_id' => '826',
    'period' => 'today',
    'limit' => 1,
    'fields' => ['rubrics','position_dictionary'],
];
$request = new \App\Entity\Request('services_limits', $params);
$client = new \App\Entity\Client();


$client->send($request);
?>


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Таблица размеров обуви</title>
</head>
<body>
<table border="1">
    <caption>Таблица размеров обуви</caption>
    <!--    --><?php //foreach (?>


    <tr>
        <td>1</td>
        <td>2</td>
    </tr>

    <!--        --><?php //  endforeach;   ?>
</table>
</body>
</html>
