<?php

require_once '../vendor/autoload.php';

$params = [
    'geo_id' => '826',
    'period' => 'today',
    'fields' => ['rubrics','position_dictionary', 'header'],
];
$request = new \App\Entity\Request('vacancies', $params);
$client = new \App\Entity\Client();



$response = $client->send($request);
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
    <?php foreach ($response->getBody() as $data):
        ?>
        <tr>
            <td><?= $data['header'] ?></td>
            <td>2</td>
        </tr>

    <?php endforeach; ?>
</table>
</body>
</html>
