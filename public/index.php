<?php

use App\Provider\VacancyProvider;

require_once '../vendor/autoload.php';

$manager = new \App\Manager();
//$vacancys = new VacancyProvider(null);

//$vacancy = $vacancys->getVacancy();
$vacancy = $manager->getVacancy();
$rubric = $manager->getRubric($vacancy);

//$rubrics = new \App\Provider\RubricProvider(null);

//$rubric = $rubrics->getRubric();

?>


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Таблица размеров обуви</title>
</head>
<body>
<!--<table border="1">-->
<!--    <caption>Таблица размеров обуви</caption>-->
<!--    --><?php //foreach ($vacancy as $data):?>
<!--        <tr>-->
<!--            <td>--><?//= /** @var \App\Entity\Vacancy $data */
//                $data->getDictionary() ?><!--</td>-->
<!--            <td>--><?//= /** @var \App\Entity\Vacancy $data */
//                $data->getTitle() ?><!--</td>-->
<!--        </tr>-->
<!---->
<!--    --><?php //endforeach; ?>
<!---->
<!--</table>-->

<table border="1">
    <caption>Таблица размеров обуви</caption>
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
