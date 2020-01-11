<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/19
 * Time: 16:06
 */
namespace Home\Model;

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
        $sql="SELECT * FROM user WHERE username='$u' AND password='$p'";
        return $this->db->fetchOne($sql);
    }
    public function upload($id,$p,$ffname,$uploadname,$filesize,$fileExt)
    {
        $time=time();
        $sql = "INSERT INTO uploadfile VALUES (null ,$id,'$p','$ffname','$uploadname','$filesize','$fileExt','$time',0,null,0)";
        return $this->db->exec($sql);
    }
    public function fileList($uid,$state)
    {
        $sql = "SELECT * FROM uploadfile WHERE uid=$uid AND state=$state ORDER BY id DESC";
        $fetchAll = $this->db->fetchAll($sql);
        $rowCount = $this->db->rowCount($sql);
        $arrs = array("fetchAll"=>$fetchAll,"rowCount"=>$rowCount);
        return $arrs;
    }
    public function fetchAll($uid,$state,$startRow,$pageSize)
    {
        $sql = "SELECT * FROM uploadfile WHERE uid={$uid} AND state={$state}  ORDER BY id DESC LIMIT {$startRow},{$pageSize}";
        return $this->db->fetchAll($sql);
    }
    public function fetchOne($id)
    {
        $sql = "SELECT * FROM uploadfile WHERE id={$id}";
        return $this->db->fetchOne($sql);
    }
    public function del($id,$state)
    {
        $recoveryTime=time();
        $sql = "UPDATE uploadfile SET state={$state},recoverytime={$recoveryTime}  WHERE id={$id}";
        return $this->db->exec($sql);
    }
    public function delete($id)
    {
        $sql = "DELETE FROM uploadfile WHERE id={$id}";
        return $this->db->exec($sql);
    }
    public function shared($shared,$id)
    {
        $sql = "UPDATE uploadfile SET shared={$shared} where id={$id}";
        return   $this->db->exec($sql);
    }
    public function sharedFetchAll()
    {
        $sql = "SELECT * FROM `uploadfile`JOIN user ON uploadfile.uid = user.uid WHERE uploadfile.shared=1";
        $fetchAll = $this->db->fetchAll($sql);
        $count    = $this->db->rowCount($sql);
        return array("fetchAll"=>$fetchAll,"count"=>$count);
    }
    public function sharedList($startRow,$pageSize)
    {
        $sql = "SELECT * FROM `uploadfile` JOIN `user` ON uploadfile.uid = user.uid 
                  where uploadfile.shared=1 LIMIT {$startRow}{$pageSize}";
        return$this->db->fetchAll($sql);
    }

}