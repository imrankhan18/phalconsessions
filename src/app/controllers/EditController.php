<?php

use Phalcon\Mvc\Controller;

class EditController extends Controller
{
    public function editAction($id)
    {
        $this->view->userid=$id;
    }
}
