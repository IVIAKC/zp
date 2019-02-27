<?php
require_once '../vendor/autoload.php';

$reporter = new \App\Reporter();

$rowsPopularPosition = $reporter->getRowsPopularPosition();
$rowsPopularRubric = $reporter->getRowsPopularRubric();
?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Отчет</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
    <div class="container_table">
        <table>
            <caption>Популярные должности</caption>
            <?php foreach ($rowsPopularPosition as $position): ?>
                <tr>
                    <td><?= $position->getTitle() ?></td>
                    <td><?= $position->getCount() ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
    <div class="container_table">
        <table>
            <caption>Популярность рубрик</caption>
            <?php foreach ($rowsPopularRubric as $rubric): ?>
                <tr>
                    <td><?= $rubric->getTitle() ?></td>
                    <td><?= $rubric->getCount() ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>
