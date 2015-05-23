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
				'index2'=>	0,	//首页翻第二页
		),
		'Help'	=>	array(
				'shelltest'	=>	0,	//测试模块指令
				'help' => 0,
		),
		'Test'	=>	array(
				'mysql'		=>	0,
				'aiFormLogin'	=>	2,	//测试AI专用表单登录
				'testUA' => 1, //测试AuthorityUtil.class.php
		),
		'Browse'=>	array(
				'randomSearch'	=>	3,	//随便看看（旧货信息）
				'fleatypeSearch'=>	4,	//按旧货分类搜素（旧货信息）
				'searchFleaAsKeyword'=>4, //按关键字搜索
				'searchFleaAsCreuser'=>2, //按发布人搜索
				'listAnotherFleaInfo' => 1,	//查看他人发布的旧货信息列表
				'browseFleaDetail' => 2, //获取旧货信息明细（在matrix视图中使用，不需要登录）
		),
		'User'	=>	array(
				'user_register'	=>	7,	//用户注册
				'user_login'	=>	2,	//用户登录
				'user_logout'	=>	0,	//用户退出
				'user_find'		=>	1,	//密码找回
				'updateProfile'	=>	6,	//修改个人信息(使用前三个参数)
				'updatePassword' => 6,	//修改个人密码（使用后三个参数）
		),
		'Fleaopt'=>	array(
				'pageToCreateFleaInfo'	=>	2,	//进入旧货信息新发布页或编辑页
				'publishNewFleaInfo'	=>	6,	//发布新的旧货信息或编辑已有的
				'delFleaInfo'	=>	2,	//删除旧货信息
				'getFleaDetails'=>	5,	//获取旧货信息的详情（在ace视图中显示,不需要登录）
				'pageToListSelfRecords'		=>	3,	//【即将废弃】列出自己的旧货记录（转让、求购、访问记录）
		),
		'SelfRecord'=>array(	//用户个人记录显示及操作
				'listSelfSell' => 2,
				'listSelfBuy' => 2,
				'listSelfBook' => 2,
				'listSelfTrade' => 2,
				'listSelfAppraise' => 2,
				'listSelfAccessRecord' => 2,
				'listSelfLetter' => 3,
				'listSelfRemind' => 3,
		),
		'Profile'	=>array(
				'displayProfile'	=>	1,	//加载个人信息页
		),
		'Contacts'	=>array(
				'addAsContacts'	=>	1,	//纳入联系人
				'delOneContact'	=>	1,	//删除一个联系人
				'listMyContacts'=>	2,	//获取联系人列表
		),
		'Message' => array(
				'sendPersonalLetter' => 4,	//发送私信
				'getLetterDetail'	=>	1,	//查看自己的单条私信明细
				'getRemindDetail'	=>	1,	//查看自己的单条提醒明细
		),
		'Book' => array(
			'addFleaBook' => 7 , //在Matrix视图的旧货明细中执行预约功能
			'getBookDetails' => 4, //获取自己的预约明细，并在ace视图中显示（注：只需要显示自己的即可）。
			'delBookInfo' => 1, //删除自己的预订信息
			'agreeBook' => 1, //甲方同意预约
			'disagreeBook' => 1, //甲方拒绝预约 
		),
		'Trade' => array(
			'getTradeDetails' => 4, //获取自己的交易明细，并在ACE视图显示
			'affirmTrade' => 2,	//确认交易
			'negateTrade' => 2,	//否认交易
		),
		'Collect' => array(
			'addCollect' => 3, //收藏旧货信息
			'delMyCollect' => 1, //删除自己的一条收藏
		),
		'Follow' => array(
			'addUserFollow' => 1, //关注某用户
		),
		'UploadFile' => array(
			'upimg' => 1, //上传图片
			'upavatar' => 1, //上传头像
		)
	);
	
}