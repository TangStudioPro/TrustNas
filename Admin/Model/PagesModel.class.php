<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2020/1/7
 * Time: 10:41
 */

namespace Admin\Model;


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

    public  function pages()
    {
        //每页显示
        $pageSize = 15;
        //当前页
        $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
        //当前页开始行号
        $startRow = ($this->page-1)*$pageSize;
        //总数
        $records  = $this->modelObj->fetchAll()['count'];
        //总页数
        $this->pages    = ceil($records/$pageSize);

        $this->arrs     = $this->modelObj->fetchPage($startRow,$pageSize);

        return $this->arrs;
    }

    public function fenye($c='fileListPage')
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
                echo "<span class='current'>$i</span>";
            }else
            {
                echo "<a href='?a=$c&page=$i'>$i</a>";
            }
        }

    }


}