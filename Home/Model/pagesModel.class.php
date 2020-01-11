<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2020/1/7
 * Time: 10:41
 */

namespace Home\Model;


class pagesModel
{
    private  $modelObj;
    private  $page;
    private  $pages;
    private  $arrs;

    public function __construct()
    {
        $this->modelObj = new IndexModel();
    }

    public  function pages($uid,$state)
    {
        //每页显示
        $pageSize = 10;
        //当前页
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
        //当前页开始行号
        $startRow = ($this->page-1)*$pageSize;
        //总数
        $records  = $this->modelObj->fileList($uid,$state)['rowCount'];
        //总页数
        $this->pages    = ceil($records/$pageSize);

        $this->arrs     = $this->modelObj->fetchAll($uid,$state,$startRow,$pageSize);

        return $this->arrs;
    }

    public  function sharedList()
    {
        //每页显示
        $pageSize = 10;
        //当前页
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
        //当前页开始行号
        $startRow = ($this->page-1)*$pageSize;
        //总数
        $records  = $this->modelObj->sharedFetchAll()['count'];
        //总页数
        $this->pages    = ceil($records/$pageSize);

        $this->arrs     = $this->modelObj->sharedList($startRow,$pageSize);

        return $this->arrs;
    }


    public function fenye($a='index')
    {
        //循环起点和终点
        //如果当前页<=6时
        $start = $this->page-2;
        $end   = $this->page+2;

        if ($this->page>$this->pages-2)
        {
            $start=$this->pages-4;
            $end=$this->pages;
        }

        if ($this->page<3)
        {
            $start=1;
            $end=5;
        }
        if ($this->pages<5)
        {
            $start=1;
            $end=$this->pages;
        }
        //循环输出所有页码
        for($i=$start;$i<=$end;$i++)
        {
            //当前页不加链接
            if($this->page==$i)
            {
                echo "<li class='page-item-my active' ><span class='page-link page-link-my' >$i</span></li>";
            }else
            {
                echo "<li class='page-item-my'  ><a  class='page-link page-link-my' href='?page=$i'>$i</a></li>";
            }
        }

    }
    public function shared($shared,$id)
    {
        $page=isset($_GET['page']) ? $_GET['page'] : 1;
        if ($shared==1)
        {
            echo "
        <a  class='dropdown-item-ty' href='?a=cancel&id=$id&page=$page'><i class='czs-close-l' style='margin-right: 5px;'></i>取消共享</a></td>";
        }else
        {
            echo "
        <a  class='dropdown-item-ty' href='?a=shared&id=$id&page=$page'><i class='czs-share' style='margin-right: 5px;'></i>共享</a></td>";
        }
    }

    public function isShared($shared,$id)
    {
        $page=isset($_GET['page']) ? $_GET['page'] : 1;
        if ($shared==1)
        {
            echo "<i class='czs-eye-l isShared' ></i>";
        }else
        {
        }
    }

}