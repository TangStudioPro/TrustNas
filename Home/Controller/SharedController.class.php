<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2020/1/7
 * Time: 16:03
 */

namespace Home\Controller;

use Home\Model\IndexModel;
use Home\Model\pagesModel;

class SharedController
{
    private $modelObj = '';
    public function __construct()
    {
        $this->modelObj = new  IndexModel();
    }
    public function isUser()
    {
        if (!isset($_SESSION['username']))
        {
            $_SESSION['token'] = uniqid();
            include APP_PATH."View".DS."LoginView.html";
            die();
        }
    }
    public function index()
    {
        $this->isUser();
        $pageObj = new pagesModel();
        $arrs=$pageObj->sharedList();
        include "./Home/View/header.html";
        include "./Home/View/sharedFileList.html";
        include "./Home/View/footer.html";
    }
    public function download()
    {

        $fileSrc    =  $_GET['filesrc'];
        $uploadName =  $_GET['uploadname'];

        header("content-type:application/octet-stream");

        header("content-Disposition:attachment;filename={$uploadName}");
        $handle=fopen($fileSrc,"rb");
        while ($str=fread($handle,1024))
        {
            echo $str;
        }
    }
}