<?php

namespace App;

use Silex\Application;

class RoutesLoader {
    private $app;

    public function __construct(Application $app) {
        $this->app = $app;
        $this->instantiateControllers();
    }

    private function instantiateControllers() {
        $this->app['user.controller'] = function() {
            return new \Controller\UserController($this->app['serializer'],
                                                  $this->app['user.service']);
        };
    }

    public function bindRoutesToControllers() {
        $factory = $this->app['controllers_factory'];

        /* User */
        $factory->post('/user/new', "user.controller:newUser");

        $this->app->mount('/', $factory);
    }
}
