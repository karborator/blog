<?php

namespace Modules\Engine\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;


class PostForm extends Form
{
    public function initialize()
    {
        $this->add(new Text("title"));

        $this->add(new Text("description"));

        $this->add(new Select("type", array(
            '1' => 'High',
            '2' => 'Middle',
            '3' => 'Ready'
        )));
    }
}