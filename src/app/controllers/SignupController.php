<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{

    public function IndexAction()
    {
        
    }

    public function registerAction()
    {
        $user = new Users();
    //    print_r($user->status);
        // 
        // if($user->status='pending'){
            // print_r($user->status) ;
            
            
            $user->assign(
                $this->request->getPost(), [ 'name', 'email' , 'password','status=pending','role=admin']
            );
            // die();
        // }else{ $user->assign(
        //         $this->request->getPost(), [ 'name', 'email' , 'password','status=pending','role']
        //     );
// }
       
        $success = $user-> save();

        $this->view->success = $success;

        if ($success) 
        {
            $message = "Register succesfully";
        } else {
            $message = "Not Register succesfully due to following reason: <br>" . implode("<br>", $user->getMessages());
        }
        $this->view->message = $message;
    }
    // public function testAction()
    // {
    //     // echo "Hello Imran!!!";

    // }
}
