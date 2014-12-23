<?php

return array(
    "database" => array(
        "adapter" => "Mysql",
        "host" => "blog.dev",
        "username" => "root",
        "password" => "aaa",
        "dbname" => "blog",
        "options" => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        )
    ),
    "engine" => array(
        "Modules\Engine\Controllers" => "../app/modules/engine/controllers/",
        "Modules\Engine\Models" => "../app/modules/engine/models/",
        "Modules\Engine\Models\Validators" => "../app/modules/engine/models/validators",
        "Modules\Engine\Forms" => "../app/modules/engine/forms",
        "Modules\Engine\Models\Enom" => "../app/modules/engine/models/Enom",
        "Modules\Engine\Plugins" => "../app/modules/engine/plugins",
        "Modules\Engine\Views" => "../app/modules/engine/views/"
    )
);
