<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/31
 * Time: 9:28
 */
//声明命名空间
namespace Frame;
final class Frame
{
    public static function run()
    {
        //初始化配置信息
        self::initConfig();
        //初始化路由参数
        self::initRoute();
        //初始化常量定义
        self::initConst();
        //初始化累的自动加载
        self::initAutoLoad();
        //初始化请求分发
        self::initDispatch();

    }
    //初始化配置信息
    private static function initConfig()
    {
        //加载配置文件的数据存放GLOBALS
        $GLOBALS['config'] = require_once (APP_PATH."Conf".DS."Config.php");
//         print_r($GLOBALS);
//         die();
    }
    //初始化路由
    private static function initRoute()
    {
        session_start();
        //默认平台 Home
        $p = $GLOBALS['config']['default_platform'];
        //默认控制器如果没有则为Index
        $c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller'];
        //默认方法如果没有则为index
        $a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action'];
        //定义为常量方便调用
        define("PLAT",$p);//平台
        define("CONTROLLER",$c);//控制器
        define("ACTION",$a);//方法
    }
    //初始化目录常量
    private static function initConst()
    {
        define("VIEW_PATH",APP_PATH."View".DS.CONTROLLER.DS);//View目录
    }
    //初始化类的自动加载
    private static function initAutoLoad()
    {
        //自动加载函数
        spl_autoload_register(function ($className)
        {
            //传递过来的类名为例：Home\Controller\IndexController.class
            //实际要加载的文件为：./Home/Controller/IndexController.class.class.php
            //str_replace()将$classname字符串中的/转换为/
            // ROOT_PATH 为根目录 DS为动态分隔符index.php定义
            $filename=ROOT_PATH.str_replace("\\",DS,$className).".class.php";
            //如果文件存在则包含
//            echo $filename;
//            die();
            if (file_exists($filename)) require_once ("$filename");
        });
    }
    //初始化
    private static function initDispatch()
    {
        //前面是命名空间
        //CONTROLLER为方法名
        //“\\”是因为单斜线为转意符
        $controllerClassName = PLAT."\\"."Controller"."\\".CONTROLLER."Controller";
//        echo $controllerClassName;
//        die();
        $controllerObj = new $controllerClassName();//实例化对象

        //根据用户不同动作调用不同方法
        $action_name = ACTION ;
        $controllerObj->$action_name();


    }
}