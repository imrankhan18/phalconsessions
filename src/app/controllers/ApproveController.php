<?php 

use Phalcon\Mvc\Controller;

class ApproveController extends Controller
{
public function indexAction()
{
      
    $this->view->users = Users::find();
}
public function approveAction()
{
    $result=$this->request->getPost();
    // print_r($result);
    if (isset($_POST['authenticate'])) {
        $action=$_POST['authenticate'];
        // echo "<h1>".$_POST['authenticate']."</h1>";
        $userid=substr($action, 4);
        // print( $userid);
        $action=substr($action, 0, 3);
        // print( $action);
        switch($action)
        {
            case 'app':
            
                $this-> changeStatus($userid, "approve");
                break;
            
            case 'dis':
            
                $this-> changeStatus($userid, "disappove");
                break;
            
        }
      
        $this->response->redirect('dashboard');
    }

}
function changeStatus ($userid, $status)
{
        $res=Users::findFirst($userid);
        $res->status=$status;
        $res->update();
        // $this->view('dashboard');
        // print_r($res);
        
}
}
?>