<?php



use Phalcon\Mvc\Controller;

class EditblogController extends Controller
{
    public function editblogAction($blogid)
    {
        $this->view->blogid=$blogid;
    }
}