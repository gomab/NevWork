<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 3/9/18
 * Time: 6:53 PM
 */

namespace App\Framework;

class Renderer
{
    //Tableau qui contient des chemins
    private $paths = [];

    //Default Namespace
    const DEFAULT_NAMESPACE = '__MAIN';

    /**
     * Variable globalement accessible pour toutes les vues
     * @var array
     */
    private $globals = [];

    /**
     * Cette function ajoute des chemins pour charger des vues
     * @param string $namespace
     * @param null|string $path
     * Path can be null
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }

    /**
     * Permet de rendre une vue
     * Le chemin peut etre précisé avec des namespaces rajoutés via addPath()
     * $this->render('view');
     *  $this->render('@blog/view');
     * @param string $view
     * Nonm de la vue à rendre
     *
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        if ($this->hasNamespace($view)) {
            $path = $this->replacenamespace($view) . '.php';
        } else {
            //Recuperation du chemin qui correspond au namespace par defaut en rajoutant le nom de la vue
            $path = $this->paths[self::DEFAULT_NAMESPACE] .DIRECTORY_SEPARATOR . $view . '.php';
        }


        //Mettre en memoire les infos en sortie
        ob_start();

        //Injecter renderer dans la vue
        $renderer = $this;

        extract($this->globals);

        //Extraire les params
        extract($params);
        require($path);

        //Recupérer le contenu
        return ob_get_clean();
    }

    /**
     * Rajoute des variables globales à toutes les vues
     * @param string $key
     * @param mixed $value
     */
    public function addGlobal(string $key, $value): void
    {
        $this->globals[$key] = $value;
    }

    /**
     * Verifie si le namspace exist
     *
     * @param string $view
     * @return bool
     *
     */
    private function hasNamespace(string $view): bool
    {
        return $view[0] === '@';
    }

    /**
     * Namespace correspondant à une chaine de caractere
     * @param string $view
     * @return string
     */
    private function getNamespace(string $view):string
    {
        return substr($view, 1, strpos($view, '/') -1);
    }

    private function replacenamespace(string $view): string
    {
        $namespace = $this->getNamespace($view);
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }
}
