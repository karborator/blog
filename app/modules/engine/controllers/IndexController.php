<?php

namespace Modules\Engine\Controllers;

use Modules\Engine\Forms\SignInForm;
use Modules\Engine\Forms\SignUpForm;
use Modules\Engine\Models\Users;
use Modules\Engine\Models\Post;

class IndexController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $postModel = Post::find("issue = 0");
        $this->view->setVar('posts', $postModel);
    }

    public function aboutAction()
    {

    }

    public function contactAction()
    {

    }

    public function authenticateAction()
    {
        if ($this->session->get('auth')) {
            return $this->response->redirect("admin");
        }

        //Authenticate the user
        if ($this->request->isPost()) {

            $resultset = $this->modelsManager->createBuilder()
                ->from('Modules\Engine\Models\Users')
                ->where('email = "' . $this->request->getPost("email") . '"')
                ->andWhere('password = "' . sha1($this->request->getPost("password")) . '"')
                ->getQuery()
                ->execute()->count();

            if ($resultset == 1) {

                $this->session->set("auth", true);

                return $this->response->redirect("admin");
            } else {
                $this->flashSession->error("Wrong credentials, try again!");
                return $this->response->redirect("authenticate");
            }
        }
    }

    public function signOutAction()
    {
        if ($this->session->get("auth")) {
            $this->session->destroy();
            return $this->response->redirect('index');
        }
        $this->flashSession->error('Something wrongs happening');
        return $this->response->redirect('index');
    }

    public function signUpAction()
    {
        if ($this->request->isPost()) {

            $usersModel = new Users();
            $form = new SignUpForm();
            $form->bind($this->request->getPost(), $usersModel);

            if (!$usersModel->save()) {
                foreach ($usersModel->getMessages() as $msg) {
                    $this->flashSession->error($msg);
                }
                return $this->response->redirect('sign-up');
            }
            $this->flashSession->error('Successfully add your e-mail to receive news !');
            return $this->response->redirect('sign-up');
        }
    }
}
