<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2020/1/8
 * Time: 10:12
 */
namespace Admin\Controller;

use Admin\Model\IndexModel;
use Admin\Model\pagesModel;

class IndexController
{
    private $modelObj;
    public function __construct()
    {
        $this->modelObj = new IndexModel();

    }

    public function isUser()
    {
        if (!isset($_SESSION['admin_name']))
        {
            $_SESSION['token'] = uniqid();
            include APP_PATH."View".DS."LoginView.html";
            die();
        }
    }

    public function index()
    {
        $this->isUser();
       include APP_PATH."View".DS."header.html";
       include APP_PATH."View".DS."index.html";
       include APP_PATH."View".DS."footer.html";
    }
//    public function insert()
//    {
//        $this->modelObj->insert($pass);
//    }


    public function login()
    {
        if (isset($_POST['token']) && $_POST['token']==$_SESSION['token'])
        {
            $admin_name=$_POST['username'];
            $admin_pass=md5($_POST['password']);
            $verify=strtolower($_POST['verify']);
            if ($verify!=$_SESSION['verify'])
            {
                echo "<script>alert('验证码错误');parent.location.href='?';</script>";
                header("refresh:1;url=?");
            }else
            {
                if ($arr=$this->modelObj->loginSave($admin_name,$admin_pass))
                {
                    $_SESSION['id']=$arr['id'];
                    $_SESSION['admin_name']=$admin_name;
                    header("location:?");
                }else
                {
                    echo "<script>alert('账号或秘密错误');parent.location.href='?';</script>";
                    header("refresh:1;url=?");
                }
            }
        }else
        {
            echo "<script>alert('非法提交')</script>";
            header("refresh:10;url=?");
            die();
        }
    }

    public function out()
    {
        $_SESSION = array();
        session_destroy();
        header("location:?");
        //include "../LoginView.html";
    }

    //
    public function addUserPage()
    {
        $this->isUser();
        include APP_PATH."View".DS."header.html";
        include APP_PATH."View".DS."addUser.html";
        include APP_PATH."View".DS."footer.html";
    }

    public function addUser()
    {
       $admin_name  = $_POST['name'];
       $admin_pass  = $_POST['password'];
       $admin_pass1 = $_POST['password1'];
       $note        = $_POST['note'];
       if ($admin_pass != $admin_pass1){
           echo "<script>alert('两次密码不一致');parent.location.href='?a=addUserPage'</script>";
           die();
       }
       $admin_pass = md5($admin_pass );
       if ($this->modelObj->insert($admin_name,$admin_pass,$note))
       {
           echo "<script>alert('添加成功');parent.location.href='?a=addUserPage'</script>";
       }else
       {
           echo "<script>alert('姓名已存在请更换姓名');parent.location.href='?a=addUserPage'</script>";
       };
    }

    public function fileListPage()
    {
        $this->isUser();
        $pageObj=new pagesModel();
        $arrs=$pageObj->pages();

        include APP_PATH."View".DS."header.html";
        include APP_PATH."View".DS."fileList.html";
        include APP_PATH."View".DS."footer.html";
    }

    public function delete()
    {
        $id=$_GET['id'];
        $src=$this->modelObj->fetchOne($id)['filesrc'];
       if ($this->modelObj->delete($id) && unlink($src))
       {
           echo "<script>alert('删除成功');parent.location.href='?a=fileListPage'</script>";
       }
    }

    public function userListPage()
    {
        $arrs     = $this->modelObj->userList()['fetchAll'];
        include APP_PATH."View".DS."header.html";
        include APP_PATH."View".DS."userList.html";
        include APP_PATH."View".DS."footer.html";

    }
    public function updateUserPage()
    {
        $uid  =  $_GET['uid'];
        $arrs = $this->modelObj->updateData($uid);
        $_SESSION['token'] = uniqid();

        include APP_PATH."View".DS."header.html";
        include APP_PATH."View".DS."updateUser.html";
        include APP_PATH."View".DS."footer.html";

    }
    public function updateUser()
    {
        $admin_name  = $_POST['name'];
        $admin_pass  = $_POST['password'];
        $admin_pass1 = $_POST['password1'];
        $note        = $_POST['note'];
        $uid        = $_POST['uid'];
        if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
        {
            if ($admin_pass != $admin_pass1){
                echo "<script>alert('两次密码不一致');parent.location.href='?a=userListPage'</script>";
                die();
            }
            $admin_pass = md5($admin_pass );
            if ($this->modelObj->updateUser($admin_name,$admin_pass,$note,$uid))
            {
                echo "<script>alert('修改成功');parent.location.href='?a=userListPage'</script>";
            }else
            {
                echo "<script>alert('姓名已存在请更换姓名');parent.location.href='?a=userListPage'</script>";
            };
        }

    }



}