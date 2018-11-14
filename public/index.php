<?php


require_once '../vendor/autoload.php';

$manager = new \App\Manager();

$vacancy = $manager->getPopularPosition();
$rubric = $manager->getPopularRubric();


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
    <?php foreach ($vacancy as $key => $data):?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $data['title'] ?></td>
            <td><?= $data['count'] ?></td>
        </tr>

    <?php endforeach; ?>

</table>

<table border="1">
    <caption>Популярность в рубриках</caption>
<?php foreach ($rubric as $data):?>
    <tr>
        <td><?= /** @var \App\Entity\Rubric $data */
                $data->getId() ?></td>
        <td><?= $data->getName() ?></td>
        <td><?= $data->getCount() ?></td>
    </tr>

<?php endforeach; ?>

</table>
</body>
</html>
