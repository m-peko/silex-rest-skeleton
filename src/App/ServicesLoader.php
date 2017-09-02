<?php

namespace App;

use Silex\Application;

class ServicesLoader {
    private $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function bindServicesIntoContainer() {
        $this->app['user.service'] = function() {
            return new \Service\UserService($this->app['orm.em']);
        };
    }
}
