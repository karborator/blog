<?php

namespace Modules\Engine\Controllers;

use Modules\Engine\Forms\PostForm;
use Modules\Engine\Models\Post;

class AdminController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $postModel = Post::find();
        $this->view->setVar('posts', $postModel);
    }

    public function postAction()
    {
        $postModel = new Post();
        $forms = new PostForm();
        if ($this->request->isPost()) {


            $forms->bind($this->request->getPost(), $postModel);
            $postModel->setDate(date("Y-m-d h:i:s"));

            if (!$postModel->save()) {
                foreach ($postModel->getMessages() as $msg) {
                    $this->flashSession->error($msg);
                    return $this->response->redirect('admin/new-post');
                }
            }
            return $this->response->redirect('admin');
        }
        $this->view->form = $forms;
    }

    public function postEditAction($id)
    {
        $postModel = Post::findFirst($id);
        $form = new PostForm();
        if ($this->request->isPost()) {

            $form->bind($this->request->getPost(), $postModel);
            $postModel->setDate(date("Y-m-d h:i:s"));

            if (!$postModel->save()) {
                foreach ($postModel->getMessages() as $msg) {
                    $this->flashSession->error($msg);
                    return $this->response->redirect('admin/new-post');
                }
            }
            return $this->response->redirect('admin');
        }
        $this->view->form = $$form;
        $this->view->post = $postModel;
    }

    public function postDeleteAction($id)
    {
        $postModel = Post::findFirst($id);
        if (!$postModel->delete()) {
            foreach ($postModel->getMessages() as $msg) {
                $this->flashSession->error($msg);
                return $this->response->redirect('admin/new-post');
            }
        }
        return $this->response->redirect('admin');
    }
}
