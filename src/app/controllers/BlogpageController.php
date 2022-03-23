<?php



use Phalcon\Mvc\Controller;

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class BlogpageController extends Controller
{
    public function indexAction()
    {
        $this->view->blogs = Blogs::find();
        $this->listAction();
        // $this->createAction();
    }
    public function addAction()
    {
        $blogs = new Blogs();
        $blogs->assign(
            $this->request->getPost(),
            [
                'pic',
                'blogname',
                'blogtype',
                'fullblog'
            ]
        );
        $blogs->save();
        $this->fetchBlogAction();
        // die();
        $this->response->redirect('blogpage');
    }
    public function fetchBlogAction()
    {
        $result = Blogs::find();
    }
    public function createAction()
    {
        $member->setMemberPic(base64_encode(file_get_contents($this->request->getUploadedFiles()[0]->getTempName())));
    }
    public function listAction()
    {
        // $this->indexAction();
        // $this->view->blogs = Blogs::find();
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator   = new PaginatorModel(
            [
                'model'  => Blogs::class,
                'limit' => 2,
                'page'  => $currentPage,
            ]
        );

        $page = $paginator->paginate();
        // print_r($page);
        // die();

        $this->view->setVar('page', $page);
    }
}
