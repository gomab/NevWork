<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 3/9/18
 * Time: 7:59 PM
 */
?>

<?= $renderer->render('header', ['title' => $slug]) ?>
<h1>Bienvenue sur l'article <?= $slug ?></h1>


<?= $renderer->render('footer') ?>

