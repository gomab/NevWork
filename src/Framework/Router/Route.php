<?php

    namespace Framework\Router;

    /**
     * Matched Route
     *
     * Class Route
     * @package Framework\Router
     */

    class Route{

        /**
         * Recupere le nom de la route
         *
         * @return string
         */
        public function getName():string
        {

        }

        /**
         * recupere le callback
         * @return callable
         */
        public function getCallback(): callable {

        }

        /**
         * Retrieve the URL parameters
         * @return array
         */
        public function getParameters(): array {

        }
    }