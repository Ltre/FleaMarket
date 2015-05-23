<?php
/**
 * 附加的过滤器映射规则，简称为“附加过滤规则（AFR）”
 * 这里的规则不会对XxxxAction对应的XxxxFilter造成任何影响。
 * [AFR]的叠加效果：
 * 	指令级的规则会对模块级的规则进一步细致的更改。
 */


class AiAdditionalFilterMapRule {
	
	
	/*
	 * 没有在本类中设置映射的模块或指令【需要 | 不需要】全局过滤器
	 * true为需要，false为不需要
	 * 该值设定后，还有另外一种效果，即：
	 * 	当为true时，如果某指令（如index）既需要又不需要全局过滤器，则视为需要全局过滤器
	 * 	当为false时，如果某指令（如index）既需要又不需要全局过滤器，则视为 不 需要全局过滤器
	 */
	public static $elsePrior = true;
	
	
	/*
	 * 【不需要】全局过滤器的URL指令
	 */
	public static $shellNoGlobal = array(
			'user_register',
			'user_login',
			'user_logout',
			'user_find',
			'getFleaDetails',	//获取旧货信息的详情（在ace视图中显示,不需要登录）
			'sendPersonalLetter', //发送私信（本应由全局过滤器来控制，但由于特殊需求，现转交给MessageAction自己控制）
			'addFleaBook',	//发起预约（转交给BookAction控制）
	);
	
	
	/*
	 * 【需要】全局过滤器的URL指令
	 */
	public static $shellNeedGlobal = array(
		//'browseFleaDetail',	//获取旧货信息的详情（在Matrix视图中显示，需登录）[现废弃此规则]
	);
	
	
	/*
	 * 【不需要】全局过滤器的Action模块
	 *  该规则实际上是指令过滤规则的集合，
	 *  即：这些Action内的所有指令都不需要全局过滤器。
	 */
	public static $actionNoGlobal = array(
			'Index',
			'Help',
			'Test',
			'Browse',
	);
	
	
	/*
	 * 【需要】全局过滤器的Action模块
	 * Action名称大小写均可，
	 * 必须以大写开头，后续小写，否则视为无效
	 * 该规则实际上是指令过滤规则的集合，
	 * 即：这些Action内的所有指令都不需要全局过滤器。
	 */
	public static $actionNeedGlobal = array(
			'Fleaopt',	//旧货操作
			'SelfRecord',//个人记录显示
			'Book', //有关预订的操作
			'Contacts', //有关联系人的操作
	);
	
	
}
