<?php

namespace Controller;

class BaseController {
    protected $serializer;

    public function __construct($serializer) {
        $this->serializer = $serializer;
    }

    public function convertToJSON($data) {
        return $this->serializer->serialize($data, 'json');
    }
}
