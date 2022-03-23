<?php

use Phalcon\Mvc\Controller;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Http\Response;

class LoginController extends Controller
{
    public function indexAction()
    {
        
    }
    public function registerAction()
    {
        $res=$this->request->getPost();
        $session = new Manager();
        $files = new Stream(
            [
                'savePath' => '/tmp',
            ]
        );
        $session->setAdapter($files)->start();
        $session->set('email', $res['email']);
        $session->set('password', $res['password']);
      

        $result = Users::find(['conditions' => 'email = ?1 AND password =?2 AND role = ?3', 'bind' => [1 => 'ikik@gmail.com', 2 => '123', 3 => 'admin']]);
        $resul123 = $this->request->getPost();
        $_SESSION['admindetails'] = $this->getArray($result[0]);
        //cookies

    //     $this->cookies->set('remember-me',
    //     json_encode(
    //         ['email' => $resul123['email'],
    //         'password' => $resul123['password'] 
    //     ]
    // ),
    //     time() +3600
    // );
    // print_r($this->cookies->get('remember-me')->getValue());
    // die();
    //cookies code end


        if ($result[0]->email == $resul123['email'] && $result[0]->password == $resul123['password'] && $result[0]->role == 'admin') {
            
            $this->response->redirect('index');
        } elseif($resul123['email'] =='' && $resul123['password' ]=='')
        {
            $response = new Response("Sorry, the page doesn't exist", 404, 'Not Found');
            echo "<h2>Please Fill Login Details</h2>";
            die();
            $response->send();
        }
        else {
            $response = new Response("Sorry, the page doesn't exist", 404, 'Not Found');
            $response->send();
        }
        
        
        



    }
    public function getArray($result)
    {
        return array(
            'id' => $result->id,
            'name' => $result->name,
            'email' => $result->email,
            'password' => $result->password,
            // 'status' => $result->status

        );
    }
}
