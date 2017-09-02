<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController {
    private $userService;

    public function __construct($serializer, $userService) {
        parent::__construct($serializer);
        $this->userService = $userService;
    }

    /**
     * This function accepts request object which consists of
     * firstName, lastName, email and passwordHash. It passes
     * these infos to user service and returns newly inserted user.
     * @param  Request $request request object
     * @return JSON             User object
     */
    public function newUser(Request $request) {
        $data = array(
            'firstName' => $request->request->get('firstName'),
            'lastName' => $request->request->get('lastName'),
            'email' => $request->request->get('email'),
            'passwordHash' => $request->request->get('passwordHash')
        );
        return parent::convertToJSON($this->userService->newUser($data));
    }
}
