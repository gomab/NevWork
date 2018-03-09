<?php
/**
 * Created by PhpStorm.
 * User: gomab
 * Date: 3/9/18
 * Time: 6:54 PM
 */

namespace Tests\Framework;

use App\Framework\Renderer;
use PHPUnit\Framework\TestCase;


class RendererTest extends TestCase {

    private $renderer;


    /**
     * New instance Renderer
     */
    public function setup(){
        $this->renderer = new Renderer();
    }

    /**
     * Add Render
     */
    public function testRenderTheRightPath(){
       //Add chemin pour rendre les vues
        $this->renderer->addPath('blog', __DIR__ . '/views');

        //Function pour rendrela vue demo qui se situe dans le namespace blog
        $content = $this->renderer->render('@blog/demo');

        $this->assertEquals('Salut les gens', $content);

    }

    /**
     * Default render
     */
    public function testRenderTheDefaultPath(){
        //Add chemin pour rendre les vues
        $this->renderer->addPath( __DIR__ . '/views');
        $content = $this->renderer->render('demo');
        $this->assertEquals('Salut les gens', $content);

    }
}