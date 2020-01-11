<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/19
 * Time: 16:06
 */
namespace Admin\Model;

class  IndexModel
{
    //设置属性接收实例化对象
    private $db=null;
    public function __construct()
    {
        $this->db = \Frame\Libs\Db::getInstance();
    }

    public function loginSave($u,$p)
    {
        $sql="SELECT * FROM admin_user WHERE admin_name='$u' AND admin_pass='$p'";
        return $this->db->fetchOne($sql);
    }

    public function insert($username,$password,$note)
    {
        $add_dime=time();
        $sql = "INSERT INTO user VALUES (null,'$username','$password','$add_dime','$note')";
        return $this->db->exec($sql);
    }

//    public function fileList($uid,$state)
//    {
//        $sql = "SELECT * FROM uploadfile WHERE uid=$uid AND state=$state ORDER BY id DESC";
//        $fetchAll = $this->db->fetchAll($sql);
//        $rowCount = $this->db->rowCount($sql);
//        $arrs = array("fetchAll"=>$fetchAll,"rowCount"=>$rowCount);
//        return $arrs;
//    }
    public function fetchAll()
    {
        $sql = "SELECT * FROM uploadfile JOIN user ON uploadfile.uid=user.uid ";
        $fetchAll = $this->db->fetchAll($sql);
        $count    = $this->db->rowCount($sql);
        return array('fetchAll'=>$fetchAll,'count'=>$count);
    }

    public function fetchPage($startRow=0,$pageSize = 10)
    {
        $sql = "SELECT * FROM uploadfile JOIN user ON uploadfile.uid=user.uid  ORDER BY uptime DESC LIMIT {$startRow},{$pageSize}";
        return $this->db->fetchAll($sql);
    }
    public function delete($id)
    {
        $sql = "DELETE FROM uploadfile WHERE id = $id";
        return $this->db->exec($sql);
    }
    public function fetchOne($id)
    {
        $sql = "SELECT * FROM uploadfile WHERE id={$id}";
        return $this->db->fetchOne($sql);
    }
    public function userList()
    {
        $sql      = "SELECT * FROM user";
        $fetchAll = $this->db->fetchAll($sql);
        $count    = $this->db->rowCount($sql);
        return array("fetchAll"=>$fetchAll,"count"=>$count);
    }

    public function updateUser($username,$password,$note,$uid)
    {
        $sql     = "UPDATE user SET username='{$username}',password='{$password}',note='{$note}' WHERE uid=$uid";
        return $this->db->exec($sql);
    }

    public function updateData($id)
    {
        $sql = "SELECT * FROM user WHERE uid={$id}";
        return $this->db->fetchOne($sql);
    }
//    public function del($id,$state)
//    {
//        $recoveryTime=time();
//        $sql = "UPDATE uploadfile SET state={$state},recoverytime={$recoveryTime}  WHERE id={$id}";
//        return $this->db->exec($sql);
//    }
//    public function delete($id)
//    {
//        $sql = "DELETE FROM uploadfile WHERE id={$id}";
//        return $this->db->exec($sql);
//    }
//    public function shared($shared,$id)
//    {
//        $sql = "UPDATE uploadfile SET shared={$shared} where id={$id}";
//        return   $this->db->exec($sql);
//    }
//    public function sharedFetchAll()
//    {
//        $sql = "SELECT * FROM `uploadfile`JOIN user ON uploadfile.uid = user.id WHERE uploadfile.shared=1";
//        return $this->db->fetchAll($sql);
//    }

}