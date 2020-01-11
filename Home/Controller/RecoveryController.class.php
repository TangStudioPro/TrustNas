<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/25
 * Time: 11:50
 */
namespace Home\Controller;
use Home\Model\IndexModel;
use Home\Model\pagesModel;

class RecoveryController
{
    private $modelObj = '';
    public function __construct()
    {
       $this->modelObj = new  IndexModel();
    }

    public static function timediff($begin_time, $end_time)
    {
        if ($begin_time < $end_time) {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else {
            $starttime = $end_time;
            $endtime = $begin_time;
        }

        //计算天数
        $timediff = $endtime - $starttime;
        $days = intval($timediff / 86400);
        //计算小时数
        $remain = $timediff % 86400;
        $hours = intval($remain / 3600);

        $res = array("day" => $days, "hour" => $hours);
        return $res;

    }
    //删除函数
    public function delete()
    {
        $id=$_GET['id'];
        $arr=$this->modelObj->fetchOne($id);
        if (file_exists($arr['filesrc']))
        {
            if ($this->modelObj->delete($id) && unlink($arr['filesrc']))
            {
                echo "<script>alert('文件已彻底删除');parent.location.href='?c=Recovery';</script>";
            }
        }else
        {
            $this->modelObj->delete($id);
            echo "<script>alert('当前文件不存在或已删除成功');parent.location.href='?c=Recovery';</script>";
        }
    }
    //回收站页面
    public function index()
    {
        if (!isset($_SESSION['username']))
        {
            include APP_PATH."View/LoginView.html";
            die();
        }
        $uid=$_SESSION['uid'];
        $pageObj=new pagesModel();
        $arrs=$pageObj->pages($uid,1);
//        $arrs=$this->modelObj->fileList($uid,1)['fetchAll'];
//        print_r($arrs);
//        die();
        foreach ($arrs as $arr)
        {
            if (7*24-$this::timediff(time(),$arr['recoverytime'])['hour']<=0)
            {
                unlink($arr['filesrc']);
                $this->modelObj->delete($arr['id']);
            }
        }
        include APP_PATH."View/header.html";
        include APP_PATH."View/recovery.html";
        include APP_PATH."View/footer.html";
    }
    public function return_to()
    {
       $id = $_GET['id'];
       $this->modelObj->del($id,0);
       echo "<script>alert('恢复成功');parent.location.href='?'</script>";
    }
}
?>