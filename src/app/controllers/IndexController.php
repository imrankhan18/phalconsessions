<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Http\Response;


class IndexController extends Controller
{
    public function indexAction()
    {
       
                $this->view->users = Users::find();
                $time=$this->datetime;
                $this->view->time=$time;
                // $this->response->redirect('index');
                // echo $time; 

            
       
                // die();
                //return '<h1>Hello World!</h1>'; 
        
    }
    public function editAction($id)
    {

        $edit= Users::findFirstById($id);
        $request = new Request();
        $edit->name=$request->getPost('username');
        $edit->email=$request->getPost('email');
        $edit->password=$request->getPost('password');
        $edit->update();
        $this->response->redirect('index');
    }
    public function deleteAction($id)
    {   
        // die();
        $user= new Users();
        // echo $id;
        $user->id=$id;
        $result=$user->delete();
        $this->response->redirect('index');
    }
    // public function approveAction($id)
    // {

    //     $approve= Users::findFirstById($id);
    
   
    // }
    public function editblogAction($blogid)
    {
        // echo $blogid;
        // die();

        $edit= Blogs::findFirst($blogid);
        // print_r($edit);
        // die();
        $request = new Request();
        $edit->blogname=$request->getPost('blogname');
        $edit->blogtype=$request->getPost('blogtype');
        $edit->fullblog=$request->getPost('fullblog');
        $edit->update();
        $this->response->redirect('blogpage');
    }
        public function deleteblogAction($blogid)
        {
            // print_r($blogid) ;
            // die();
        $blog= new Blogs();
        $blog->blogid=$blogid;
        $result=$blog->delete();
        $this->response->redirect('blogpage');
        }
        public function logoutAction()
        {
                // $response= new Response();
                // $response->getCookies($this->cookies);
                // if ($this->cookies->has('remember-me')) {
                //     print_r($this->cookies);
                //     die();
                //     $this->cookies->get('remember-me')->delete();
                // } else {
                 
                   
                // }
                $rememberMeCookie = $this->cookies->get('remember-me');

                // Delete the cookie
                $rememberMeCookie->delete();
            
            $this->session->destroy();
            // echo $this->session->get('email');
            // die();
            // $this->cookies->get('remember-me')->delete();
            // $response= new Response();
            // $response->send();
            $this->response->redirect('login');
            
        }
}
