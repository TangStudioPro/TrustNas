<?php 
//声明命名空间
namespace Frame\Libs;

//定义抽象的基础模型类
abstract class BaseModel
{
	//受保护的PDO对象属性
	protected $pdo = null;

	//构造方法
	public function __construct()
	{
		//创建PDOWrapper类的对象
		$this->pdo = new \Frame\Vendor\PDOWrapper();
	}
	
	//公共的静态的创建不同模型类对象的方法
	public static function getInstance()
	{
		 //获取静态化方式调用的类名
		 $modelClassName = get_called_class();
		 //创建指定模型类对象，并返回
		 return new $modelClassName();
	}
}


