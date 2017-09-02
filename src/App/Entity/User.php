<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_user")
 */
class User {
    /**
     * @ORM\Column(name="id_user", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="first_name", type="string", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(name="password_hash", type="string", length=100)
     */
    private $passwordHash;

    public function __construct($firstName, $lastName, $email, $passwordHash) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
        return $this;
    }
}
