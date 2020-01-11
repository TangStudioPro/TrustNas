<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/16
 * Time: 17:02
 */
namespace Frame\Libs;
//单列数据库
//是的外部不可new对象节省内存
class Db
{
    //私有静态对象
    private static $obj = null;

    //私有数据库配置信息
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $charset;
    private $link;

    //私有的构造方法，阻止类外new对象
    private function __construct()
    {
        $this->db_host = $GLOBALS['config']['db_host'];
        $this->db_user = $GLOBALS['config']['db_user'];
        $this->db_pass = $GLOBALS['config']['db_pass'];
        $this->db_name = $GLOBALS['config']['db_name'];
        $this->charset = $GLOBALS['config']['charset'];
        $this->connectDb(); //连接MySQL服务器
        $this->selectDb();  //选择数据库
        $this->setCharset();//设置字符集
    }

    //关闭克隆对象
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    //公共的静态方法创建单一对象********************************
    public static function getInstance()
    {
        //判断当前对象是否存在
        if (!self::$obj instanceof self)
        {
            self::$obj = new self();
        }
        return self::$obj;
    }

    //链接服务器方法
    private function connectDb()
    {
        if (!$this->link = @mysqli_connect($this->db_host,$this->db_user,$this->db_pass))
        {
            echo "连接MySQL失败";
            die();
        }
    }

    //链接数据库方法
    private function selectDb()
    {
        if (!mysqli_select_db($this->link,$this->db_name))
        {
            echo "链接数据库失败";
            die();
        }
    }

    //设置字符集
    private function setCharset()
    {
        mysqli_set_charset($this->link,$this->charset);
    }

    //公共的执行SQL语句的方法：insert、update、delete、set、drop等
    //执行成功返回true，执行失败返回false
    public function exec($sql){
        //例如：update students set salary=salary+50 where id=5
        //将SQL语句变成小写
        $sql = strtolower($sql);
        //判断是不是select语句
        if (substr($sql,0,6)=='select')
        {
            echo "不可以执行SELECT语句";
            die();
        }

        //返回执行结果（布尔值）
        return mysqli_query($this->link,$sql);
    }

    //私有的执行SQL语句的方法：select
    //执行成功返回结果集对象，执行失败返回false
    private function query($sql)
    {
        //例如：select * from students
        //将SQL语句变成小写
        $sql = strtolower($sql);
        //判断是不是select语句
        if (substr($sql,0,6)!='select')
        {
            echo "不可以执行非SELECT语句";
            die();
        }
        return mysqli_query($this->link,$sql);
    }

    //公共的获取单行数据方法
    public function fetchOne($sql,$type=3)
    {
        //执行SQL语句，并返回结果及对象
        $result = $this->query($sql);

        //定义返回数组类型的常量
        $types=[
            1 => MYSQLI_NUM,
            2 => MYSQLI_BOTH,
            3 => MYSQLI_ASSOC
        ];
        //返回一组数据
        return mysqli_fetch_array($result,$types[$type]);
    }

    //公共的获取多行数据方法
    public function fetchAll($sql,$type=3)
    {
        //执行SQL语句，并返回结果及对象
        $result = $this->query($sql);

        //定义返回数组类型的常量
        $types=[
            1 => MYSQLI_NUM,
            2 => MYSQLI_BOTH,
            3 => MYSQLI_ASSOC
        ];
        //返回一组数据
        return mysqli_fetch_all($result,$types[$type]);
    }

    //获取记录数
    public function rowCount($sql)
    {
        $result=$this->query($sql);

        return mysqli_num_rows($result);
    }

    //释放
    public function __destruct()
    {
        mysqli_close($this->link);
    }



}
