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
    }
    public function upload()
    {
        $name = $_SESSION['username'];
        $uid  = $_SESSION['uid'];//登录用户id
        // print_r($_FILES);die();
        if(count((array)$_FILES['file']['name'])>5)
        {
        	 echo "<script>alert('请选择小于5个文件');parent.location.href='./index.php';</script>";
        	 die();
        }
        for ($i = 0; $i < count((array)$_FILES['file']['name']); $i++) 
        {
        	 //if($_FILES["file"]["error"][$i] >= 0)
        	 //{
        	 //	continue;
		     //}
		        $tmpfile=$_FILES["file"]["tmp_name"][$i];//临时文件
		        
		        $filetype=explode('/',$_FILES["file"]["type"][$i])[0];//image格式
		        //echo $filetype."<br>";
		        $fname=$_FILES["file"]["name"][$i];//完整文件名
		        $fileExt=@array_pop(explode(".",$fname));//后缀
		        $filename=@array_shift(explode(".",$fname));//除后缀文件名
		        // echo $fname."<br>".$fileExt."<br>".$ffname."<br>";
		
		        //设置上传文件目
		        $dstfile="upload".DS.$name.DS.$filetype.DS;
		        //获取文件大小
		        $filesize=$_FILES['file']['size'][$i];
		    	if(is_dir($dstfile)){//是否存在这个目录没有则创建并给权限
		
		        }else{
		            $res=mkdir($dstfile,0777,true);
		        }
				$uploadName=uniqid().'.'.$fileExt;//重新构建完整名称
              //根据需求 关掉对文件的大小的格式限制
              //if(in_array(strtolower($fileExt),$filearr)&&$filesize<=200*1024*1024){//判断格式和大小
                    $p=ROOT_PATH.$dstfile.$uploadName;//的完整路径及完整文件名
                    if(move_uploaded_file($tmpfile,$p))
                    {
                        // $fileExt=@array_pop(explode(".",$fname));//后缀
                        // $filename=@array_shift(explode(".",$fname));//除后缀文件名
                        $src=".".DS.$dstfile.$uploadName;
                        $this->modelObj->upload($uid,$src,$filename,$uploadName,$filesize,$fileExt);
                        echo "<script>alert('上传成功');parent.location.href='./index.php';</script>";
                    }else
                    {
                        echo "<script>alert('上传失败，请选择文件');parent.location.href='./index.php';</script>";
                    }

        }
        
       
        
    }
    //删除
    public function delete()
    {
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
        $fileSrc    =  $_GET['filesrc'];
        $filename =  $_GET['filename'];
        $filetype   =  $_GET['filetype'];
        $filename=iconv("utf-8","gb2312",$_GET['filename']);
        $filetype=iconv("utf-8","gb2312",$_GET['filetype']);
        
        
         if(!file_exists($fileSrc)){
        	echo "<script>alert('文件路径：$fileSrc 不存在');parent.location.href='./index.php';</script>";
            die();
        }
       
        header("content-type:application/octet-stream");

        header( "Content-Disposition: attachment;filename=\"$filename.$filetype\"" );//下载文件名

        $handle=fopen(ROOT_PATH.$fileSrc,"rb");
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
    //
    public function  show()
    {
    	// $path=substr(strrchr($_GET['path'],'.'),1);
    	// echo($path);die();
    	//         $fileSize = file_put_contents($fileDir.$fileName,$remoteFile);
     //   if(!$fileSize){
     //       echo 'HTTP/1.1 404 NOT FOUND';exit;
     //       //Header('HTTP/1.1 404 NOT FOUND');
     //   }
        
     //   if(!file_exists($fileDir.$fileName)){
     //       echo 'HTTP/1.1 404 NOT FOUND';exit;
     //       //Header('HTTP/1.1 404 NOT FOUND');
     //   }
        //以只读和二进制模式打开文件   
        $file = fopen ( $_GET['path'], "rb" ); 
        //告诉浏览器这是一个pdf格式的文件    
        Header ( "Content-type: application/pdf" );
        //读取文件内容并直接输出到浏览器    
        echo fread ( $file, filesize ( $fileDir . $fileName ) );    
        fclose ( $file );    
        exit ();
    }

}

