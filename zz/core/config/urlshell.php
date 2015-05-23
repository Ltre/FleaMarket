<?php

/**
 * 配置：与Action相关的URL指令及对应参数个数
 * 只要是“AiUrlShell”或以“AiUrlShell_”开头的类名，都被视为URL指令配置类。
 * @author Oriki
 */

class AiUrlShell {
	/**
	 * 注册URL SHELL对应的Action方法的参数个数【方法名=>参数个数】
	 * 如果URL提供的后续参数个数     符合   所注册SHELL所需的参数个数，则会调用Action中所对应的方法
	 * 注意：即使可以分Action定义方法，
	 * 		也不要定义不属于同Action却同名的方法(否则出错)。
	 * 	 URL SHELL指：Action中可以有URL参数直接调用的方法名。
	 * URL SHELL定义格式：
	 * 'Action名'	=>	array (
 	 * 		'方法名1'	=>	参数个数,
 	 * 		'方法名2'	=>	参数个数,
 	 * 				...	...,
 	 * ),
	 * 		... ...,
	 * 		... ...,
	 * 强烈建议：对于“出镜率”较高的Action方法名（例如list,show,login,validate,load），
	 * 建议加上前缀（例如userlist，userlogin，usershow，userload），
	 * 这样做可以避免因URL指令冲突而造成相应的需要的模块功能无法执行的问题。
	 */
	public static $shellArgs = array (
		/*
		 * 这里是默认的URL SHELL对应的Action方法。
		 * 默认Shell的参数个数一般设置为0，其访问的链接有两种方式：
		 * 		1、http://server.com/项目名
		 * 		2、http://server.com/项目名/?xxx=默认shell名称|后续参数【xxx可以随意填写，不影响参数提取】
		 * 		特殊情况：如果xxx省略不写，如输入 http://server.com/项目名/?=index|1|123，将被认定为http://server.com/项目名
		 * 	如果默认shell的参数个数设置为1或更多，则其访问的链接就只能采用以上的第二种了。
		 * 如需自定义，
		 * 		见：DEFAULT_URL_SHELL  @  /core/lib/env__.php
		 */
		'Index'	=>	array(
				'index'	=>	0,	//入口
		),
		'Help'	=>	array(
				'shelltest'	=>	0,	//测试模块指令
				'help' => 0,
		),
		//2014-02-24新增管理模块指令
		'Guanli'=>	array(
				'admin'	=>	2,
		),
		//2014-02-25测试页面
		'Login'=>  array(
			    'login' =>  0,
			    'loginCheck' =>2,
			    'user_logout'=>0,
		),
		'Test' => array(
				'test' => 0,
		),
		'Details' => array(
				'personal'=>0,
				'detail'=>0,
				'formwork' =>1,
				'usertable'=>1,
		),
		'Userinfo' => array(
				'chaxun' =>1,
				'updatausers'=>13,
				'userdelete' =>2,
		),
		'Authorityinfo' => array(
				'searchAuthority' =>1,
				'upAuthority' =>11,
				'authoritytable' =>1,
		),
		'Assignment' =>array(
				'listSelfSell'=>2,
				'listSelfBuy' =>2,
		),
		'Fopt' =>array(
				'delFleaInfo' =>2,
				'getFleaDetails' =>5,
		),
		'Punishstyle' => array(
				'updatapss' => 3,
		),
		'Volation' => array(
				'upvolation' => 2,
				'upfleatype' =>2,
		),
				
	);
	
}