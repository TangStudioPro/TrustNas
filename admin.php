<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2020/1/8
 * Time: 10:09
 */
define("DS",DIRECTORY_SEPARATOR);//动态目录分隔符/\
define("ROOT_PATH",getcwd().DS);//获取根目录getcwd获取根目录   再加上分隔符
define("APP_PATH",ROOT_PATH."Admin".DS);//HOME目录
//echo ROOT_PATH."Frame".DS."Frame.class.php";die();
//包含框架的初始化类
require_once (ROOT_PATH."Frame".DS."Frame.class.php");
//调用框架初始方法
Frame\Frame::run();