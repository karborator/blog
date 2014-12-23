<?php

/**
 * Description of Security
 * This plugin check user is it set auth session.
 * @author Nikolay Yotsov
 */

namespace Modules\Engine\Plugins;

use Phalcon\Mvc\User\Plugin;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl;
use Modules\Engine\Models\Users;

class Security extends Plugin
{

    //Protect in case you are IN without Auth session
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        if ($dispatcher->getControllerName() != 'index' && empty($this->session->get('auth'))) {
            $this->session->destroy();
            return $this->response->redirect('index');
        }
    }

}
