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
        $userdetails = $this->request->getPost();
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

        //cookies
if(isset($_POST['remember'])){
    $this->cookies->set('remember-me',
        json_encode(
            ['email' => $userdetails['email'],
            'password' => $userdetails['password'] 
        ]
    ),
        time() +3600
        
    );
    
    $response = new Response();
    $response->getCookies($this->cookies);
    //     print_r($this->cookies);
    // die();
}
else{

}

        
 
        // $this->response->redirect('index');
        // $this->cookies->get('remember-me')->getValue();
        //cookies code end
      

        $result = Users::find(['conditions' => 'email = ?1 AND password =?2 AND role = ?3', 'bind' => [1 => 'ikik@gmail.com', 2 => '123', 3 => 'admin']]);
        
        $_SESSION['admindetails'] = $this->getArray($result[0]);

        


        if ($result[0]->email == $userdetails['email'] && $result[0]->password == $userdetails['password'] && $result[0]->role == 'admin' ) {
            
            $this->response->redirect('index');
        } elseif($userdetails['email'] =='' && $userdetails['password' ]=='')
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
