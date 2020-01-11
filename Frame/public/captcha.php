<?php
/**
 * Created by PhpStorm.
 * User: Gost
 * Date: 2019/12/11
 * Time: 11:44
 */
//产生验证码
ini_set('display_errors', 'Off');
$arr=array_merge(range(0,9),range('a','z'),range("A","Z"));//组合数组
shuffle($arr);//打乱数组
$arr2=array_rand($arr,4);//随机获取下标4个
$str='';
foreach ($arr2 as $item)
{
    $str.= $arr[$item];
}
//将验证码存到session
session_start();

$_SESSION['verify']=strtolower($str);
//创建画布
$width=70;
$height=22;
$img=imagecreatetruecolor($width,$height);//建立画布
$color=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(100,255));//设置颜色
imagefilledrectangle($img,0,0,$width,$height,$color);//绘制矩形
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");//动态目录分隔符/\


//绘制像素点
for ($i=0;$i<100;$i++)
{
    $color2=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(100,255));//设置颜色
    imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),$color2);
}

//绘制像线段
for ($i=0;$i<10;$i++)
{
    $color3=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(100,255));//设置颜色
    imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$color3);
}
//将验证码使用TTF文本填充到画布
$color4=imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(100,255));//设置颜色
$fontfile=BASE_PATH."msyhbd.ttf";
imagettftext($img,18,0,0,20,$color4,$fontfile,$str);
//显示并销毁图片
header("content-type:image/png");
imagepng($img);
imagedestroy($img);