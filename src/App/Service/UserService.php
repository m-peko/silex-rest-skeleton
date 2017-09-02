<?php

namespace Service;

use Entity;

class UserService {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * This function inserts new user in database and returns it back.
     * @param  assoc. array $data firstName, lastName, email and passwordHash
     * @return User               User object
     */
    public function newUser($data) {
        $user = new Entity\User();
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setEmail($data['email']);
        $user->setPasswordHash($data['passwordHash']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
