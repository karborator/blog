<?php

namespace Modules\Engine\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Users extends Model
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    public function validation()
    {
        $this->validate(new EmailValidator(
            array(
                "field" => "email",
                "message" => "Email is not valid!"
            )
        ));

        $this->validate(new Uniqueness(
            array(
                "field" => "email",
                "message" => "Type another email!"
            )
        ));

        return true !== $this->validationHasFailed();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = sha1($password);
        return $this;
    }

}
