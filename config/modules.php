<?php

/**
 * Array with modules
 */
return array(
    'agent' => array(
        'className' => 'Modules\Agent\Module',
        'path' => __DIR__ . '/../app/modules/agent/Module.php'
    ),
    'search' => array(
        'className' => 'Modules\Search\Module',
        'path' => __DIR__ . '/../app/modules/search/Module.php'
    ),
    'admin' => array(
        'className' => 'Modules\Admin\Module',
        'path' => __DIR__ . '/../app/modules/admin/Module.php',
        'shared' => true,
    ),
    'engine' => array(
        'className' => 'Modules\Engine\Module',
        'path' => __DIR__ . '/../app/modules/engine/Module.php'
    )
);
