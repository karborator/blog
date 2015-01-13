<?php

namespace Modules\Engine\Controllers;

use Modules\Engine\Forms\IssueForm;
use Modules\Engine\Models\Post;

class HelpDeskController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $postModel = Post::find();
        $counter = $postModel->count();
        $data = array();

        for ($i = 0; $i < $counter; $i++) {
            if ($postModel[$i]->getType() == 2) {
                $data['warning'][] = $postModel[$i]->toArray();
            } elseif ($postModel[$i]->getType() == 1) {
                $data['danger'][] = $postModel[$i]->toArray();
            } elseif ($postModel[$i]->getType() == 3) {
                $data['success'][] = $postModel[$i]->toArray();
            }
        }

        $this->view->setVar('data', $data);
    }

    public function issueAction()
    {
        $postModel = new Post();
        $forms = new IssueForm();

        if ($this->request->isPost()) {


            $forms->bind($this->request->getPost(), $postModel);
            $postModel->setDate(date("Y-m-d h:i:s"));
            $postModel->setIssue(1);

            if (!$postModel->save()) {
                foreach ($postModel->getMessages() as $msg) {
                    $this->flashSession->error($msg);
                    return $this->response->redirect('admin/new-issue');
                }
            }
            return $this->response->redirect('admin/help-desk');
        }
        $this->view->form = $forms;
    }

    public function issueEditAction($id)
    {
        $postModel = Post::findFirst($id);
        $form = new IssueForm();

        if ($this->request->isPost()) {

            $form->bind($this->request->getPost(), $postModel);
            $postModel->setDate(date("Y-m-d h:i:s"));
            $postModel->setIssue(1);

            if (!$postModel->save()) {
                foreach ($postModel->getMessages() as $msg) {
                    $this->flashSession->error($msg);
                    return $this->response->redirect('admin/new-issue');
                }
            }
            return $this->response->redirect('admin/help-desk');
        }
        $this->view->form = $form;
        $this->view->post = $postModel;
    }


    public function issueDeleteAction($id)
    {
        $postModel = Post::findFirst($id);

        if (!$postModel->delete()) {
            foreach ($postModel->getMessages() as $msg) {
                $this->flashSession->error($msg);
                return $this->response->redirect('admin/new-issue');
            }
        }
        return $this->response->redirect('admin/help-desk');
    }

    public function issueDoneAction($id)
    {
        $postModel = Post::findFirst($id);
        if ($postModel->getIssue() == 1) {
            $postModel->setType(3);
            if (!$postModel->save()) {
                foreach ($postModel->getMessages() as $msg) {
                    $this->flashSession->error($msg);
                    return $this->response->redirect('admin/new-issue');
                }
            }
        }
        return $this->response->redirect('admin/help-desk');
    }
}
