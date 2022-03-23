<?php


use Phalcon\Mvc\Controller;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $session = new Manager();
        $files = new Stream(
            [
                'savePath' => '/tmp',
            ]
        );

        $session
            ->setAdapter($files)
            ->start();

        $session->get('email');
        $session->get('password');
        // die();

        $this->view->users = Users::find();
    }
    // public function adminProfieAction()
    // {

    //     $_SESSION['admindetails']=$this->getArray();
    //     print_r($_SESSION['admindetails']);
    //     // die();

    // }

    public function getArray($result)
    {
        return array(
            'id' => $result->id,
            'name' => $result->name,
            'email' => $result->email,
            'password' => $result->password,
            'status' => $result->status

        );
    }
    public function logoutAction()
    {
        $session = new Manager();
        $files = new Stream(
            [
                'savePath' => '/tmp',
            ]
        );
        $session
            ->setAdapter($files)
            ->start();

        // ....

        $session->destroy();
        $this->response->redirect('login');
        // echo $session->get('email');
        // die();
    }
}
