<?php

namespace Modules\Engine\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;

class SignUpForm extends Form
{
    public function initialize()
    {
        $this->add(new Text("email"));

        $this->add(new Text("password"));
    }
}