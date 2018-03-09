<?php

    namespace Framework\Router;

    /**
     * Matched Route
     *
     * Class Route
     * @package Framework\Router
     */

class Route
{

    /**
         * @var string
         */
    private $name;

    /**
         * @var callable
         */
    private $callback;

    /**
         * @var array
         */
    private $parameters;

    public function __construct(string $name, callable $callback, array $parameters)
    {

        $this->name = $name;
        $this->callback = $callback;
        $this->parameters = $parameters;
    }


    /**
         * Recupere le nom de la route
         *
         * @return string
         */
    public function getName():string
    {
        return $this->name;
    }

    /**
         * recupere le callback
         * @return callable
         */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
         * Retrieve the URL parameters
         * @return array
         */
    public function getParams(): array
    {
        return $this->parameters;
    }
}
