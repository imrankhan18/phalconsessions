<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Http\Response\Cookies;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;


class ResponseController extends Controller
{
    // public function indexAction()
    // {

    // }
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
        
        $session->set('userId', 12345);
        $session->userId = 12345;
        die();
        // 
        // $response = new Response();
        // $contents = file_get_contents('../app/storage/files/invoice.pdf');
        // echo $contents;
        // die(); 
        // $response->setContent($contents)->setContentType('application/pdf')->setHeader('Content-Disposition', "attachment; filename='download.pdf'")->send();  

    }
}
