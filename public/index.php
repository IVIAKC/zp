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
<div style="margin-right: 50px; float: left">
    <table border="1">
        <caption>Популярные должности</caption>
        <?php foreach ($popularPosition as $position): ?>
            <tr>
                <td><?= $position->getTitle() ?></td>
                <td><?= $position->getCount() ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>
<div style="float: left">
    <table border="1">
        <caption>Популярность рубрик</caption>
        <?php foreach ($popularRubric as $position): ?>
            <tr>
                <td><?= $position->getTitle() ?></td>
                <td><?= $position->getCount() ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>
</body>
</html>
