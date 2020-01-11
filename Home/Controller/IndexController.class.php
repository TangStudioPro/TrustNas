<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/19
 * Time: 16:05
 */
//创建模型对象
namespace Home\Controller;
use Home\Model\IndexModel;
use Home\Model\pagesModel;


//创建最终类
class  IndexController
{
    private $modelObj;
    public function __construct()
    {
        $this->modelObj = new IndexModel();
    }

    //index
    public function index()
    {
        if (!isset($_SESSION['username']))
        {
            $_SESSION['token'] = uniqid();
            include APP_PATH."View".DS."LoginView.html";
            die();
        }
        $state = 0;

        $uid=$_SESSION['uid'];
        $pageObj=new pagesModel();
        $arrs=$pageObj->pages($uid,$state);
        //包含首页视图文件
        include "./Home/View/header.html";
        include "./Home/View/filelist.html";
        include "./Home/View/UploadView.html";
        include "./Home/View/footer.html";
    }

    //分页

    //登录逻辑
    public function login()
    {
        if (isset($_POST['token']) && $_POST['token']==$_SESSION['token'])
        {
            $username=$_POST['username'];
            $userpass=md5($_POST['password']);
            $verify=strtolower($_POST['verify']);
            if ($verify!=$_SESSION['verify'])
            {
                echo "<script>alert('验证码错误');parent.location.href='./index.php';</script>";
                header("refresh:1;url=?");
            }else
            {
                if ($arr=$this->modelObj->loginSave($username,$userpass))
                {
                    $_SESSION['uid']=$arr['uid'];
                    $_SESSION['username']=$username;
                    header("location:?");
                }else
                {
                    echo "<script>alert('账号或秘密错误');parent.location.href='./index.php';</script>";
                    header("refresh:1;url=?");
                }
            }
        }else
        {
            echo "<script>alert('非法提交')</script>";
            header("refresh:1;url=?ac=log");
            die();
        }
    }
    //
    function getSize($size)
    {

        $kb = 1024;
        $mb = 1024 * $kb;
        $gb = 1024 * $mb;

        if ($size < $kb) {
            return $size . " B";
        } else if ($size < $mb) {
            return round($size / $kb, 2) . " KB";
        } else if ($size < $gb) {
            return round($size / $mb, 2) . " MB";
        }
    }



    //退出登录
    public function out()
    {

        $_SESSION = array();
        session_destroy();
        header("location:?");
        //include "../LoginView.html";
    }
    public function upload()
    {
        $name=$_SESSION['username'];
        //print_r($_FILES);
        //获取文件类型
        $tmpfile=$_FILES["file"]["tmp_name"];//临时文件
        $filetype=explode('/',$_FILES["file"]["type"])[0];//image格式
        //echo $filetype."<br>";
        $fname=iconv("utf-8","gbk",$_FILES["file"]["name"]);//完整文件名
        $fileExt=@array_pop(explode(".",$fname));//后缀
        $ffname=@array_shift(explode(".",$fname));//除后缀文件名
        //echo $fname."<br>".$fileExt."<br>".$ffname;

        //设置服务器上存储文件名
        //$filename=time().mt_rand().".".$fileExt;
        //设置上传文件目录
        if($filetype=="image"){
            $dstfile="./".$name."upload/img/";
        }else if($filetype=="text"||$filetype=="application"){
            $dstfile="./".$name."upload/file/";
        }else{
            $dstfile="./".$name."upload/music/";
        }
        //判断规定类型
//        $filearr=array("jpg","jpeg","png","xls","gif","rar","txt","docx","zip","mp3");
        //获取文件大小
        $filesize=$_FILES['file']['size'];

        $uid=$_SESSION['uid'];//登录用户id
        $p='';//如果上传文件名存在   新的完整路径及完整文件名
        if(is_dir($dstfile)){//是否存在这个目录没有则创建并给权限

        }else{
            $res=mkdir($dstfile,0777,true);
        }
        if (strlen($fname)<20)
        {
            //根据需求 关掉对文件的大小的格式限制
//            if(in_array(strtolower($fileExt),$filearr)&&$filesize<=200*1024*1024){//判断格式和大小
                if(file_exists($dstfile.$fname)){//判断上传的文件是否重名
                    $uploadName=$ffname.uniqid().'.'.$fileExt;//重新构建完整名称
                    $p=$dstfile.$uploadName;//如果上传文件名存在   新的完整路径及完整文件名
                    if(move_uploaded_file($tmpfile,$p))
                    {
                        //如果文件为中文
                        $fname=iconv("gbk","utf-8",$fname);//完整文件
                        $fileExt=@array_pop(explode(".",$fname));//后缀
                        $ffname=@array_shift(explode(".",$fname));//除后缀文件名
                        $uploadName=iconv("gbk","utf-8",$uploadName);//完整文件名
                        $p=iconv("gbk","utf-8",$p);
                        $this->modelObj->upload($uid,$p,$ffname,$uploadName,$filesize,$fileExt);
                        echo "<script>alert('上传2成功');parent.location.href='./index.php';</script>";
                    }else
                    {
                        echo "<script>alert('上传失败.');</script>";
                    }

                }else{
                    if(move_uploaded_file($tmpfile,$dstfile.$fname)){
                        $fname=iconv("gbk","utf-8",$fname);//完整文件
                        $fileExt=@array_pop(explode(".",$fname));//后缀
                        $ffname=@array_shift(explode(".",$fname));//除后缀文件名

                        $this->modelObj->upload($uid,$dstfile.$fname,$ffname,$fname,$filesize,$fileExt);
                        echo "<script>alert('上传成功');parent.location.href='./index.php';</script>";
                    }else
                    {
                        echo "<script>alert('上传失败....');parent.location.href='./index.php';</script>";
                    }
                }
//            }else{
//                echo "<script>alert('文件后缀不允许--建议压缩文件（或者文件大小超过200M）')
//    ;parent.location.href='./index.php';</script>";
//            }

        }else
        {
            echo "<script>alert('文件名长度过长/建议修改文件名称')
    ;parent.location.href='./index.php';</script>";
        }
    }
    //删除
    public function delete()
    {
//        echo "功能尚不完善，正在赶工中...";
//        header("refresh:3;url=index.php");
        $id=$_GET['id'];
        $arr=$this->modelObj->fetchOne($id);
        if (file_exists($arr['filesrc']))
        {
            if ($this->modelObj->del($id,1) )
            {
                echo "<script>alert('已移入回收站成功/7天后将彻底删除');parent.location.href='./index.php';</script>";
            }
        }else
        {
            $this->modelObj->del($id,1);
            echo "<script>alert('当前文件不存在或已删除成功');parent.location.href='./index.php';</script>";
        }
    }
    //下载
    public function download()
    {

        $filesrc=$_GET['filesrc'];
        $uploadname=$_GET['uploadname'];
        $id=$_GET['id'];


        if (!file_exists($filesrc))
        {
            $this->modelObj->delete($id);
            echo "<script>alert('当前文件不存在或已删除');parent.location.href='./index.php';</script>";
            die();
        }

        header("content-type:application/octet-stream");

        header("content-Disposition:attachment;filename={$uploadname}");//下载文件名

        $handle=fopen($filesrc,"rb");
        while ($str=fread($handle,1024))
        {
            echo $str;
        }
    }

    //共享
    public function shared()
    {
        $id=$_GET['id'];
        $page=$_GET['page'];
        if ($this->modelObj->shared(1,$id,$page))
        {
            echo "<script>alert('共享成功');parent.location.href='?page=$page'</script>";
        }
    }
    //取消共享
    public function cancel()
    {
        $id=$_GET['id'];
        $page=$_GET['page'];
        if ($this->modelObj->shared(0,$id))
        {
            echo "<script>alert('取消共享');parent.location.href='?page=$page'</script>";
        }
    }

}

