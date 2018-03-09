<?= $renderer->render('header') ?>
    <h1>Bienvenue sur le blog</h1>
    <h2>Liste des articles</h2>
    <ul>
        <li><a href="<?= $router->generateUri('blog.show', ['slug' => 'zaeaze0-7aze']); ?>">Article1</a></li>
        <li>Article2</li>
        <li>Article3</li>
        <li>Article4</li>
        <li>Article5</li>
    </ul>

<?= $renderer->render('footer') ?>
