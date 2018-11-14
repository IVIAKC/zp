<?php
require_once '../vendor/autoload.php';


use App\Interfaces\TableRow;

/** @var TableRow $position */

$manager = new \App\Manager();

$popularPosition = $manager->getPopularPosition();
$popularRubric = $manager->getPopularRubric();


?>


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Отчет</title>
</head>
<body>
<table border="1">
    <caption>Популярные должности</caption>
    <?php foreach ($popularPosition as $key => $position): ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $position->getTitle() ?></td>
            <td><?= $position->getCount() ?></td>
        </tr>

    <?php endforeach; ?>

</table>

<table border="1">
    <caption>Популярность в рубриках</caption>
    <?php
    foreach ($popularRubric as $key => $position): ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $position->getTitle() ?></td>
            <td><?= $position->getCount() ?></td>
        </tr>

    <?php endforeach; ?>

</table>
</body>
</html>
