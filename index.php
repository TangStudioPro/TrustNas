<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/24
 * Time: 14:07
 */
define("DS",DIRECTORY_SEPARATOR);//动态目录分隔符/\
define("ROOT_PATH",getcwd().DS);//获取根目录getcwd获取根目录   再加上分隔符
define("APP_PATH",ROOT_PATH."Home".DS);//HOME目录
//echo ROOT_PATH."Frame".DS."Frame.class.php";die();
//包含框架的初始化类
require_once (ROOT_PATH."Frame".DS."Frame.class.php");
//调用框架初始方法
Frame\Frame::run();