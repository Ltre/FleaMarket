<?php

/**
 * 与权限有关的使用类
 * @author Oreki
 * @since 2014-5-4
 */

class AuthorityUtil{
	/**
	 * 注册时分配初始权限
	 * @param int $uid 用户id
	 * @return boolean 分配成功与否（由SQL影响行数决定）
	 */
	static function initUserAuthority( $uid ){
		//先清空与uid有关的所有UserAuthority记录
		$del = 'delete from fm_userauthority where userfk = '.$uid;
		AiMySQL::connect()->exec($del) ? true : false;
		//查询权限表定义的权限id
		$aus = array(
			'PSL', 'MSL', 'DSL',
			'PBL', 'MBL', 'DBL',
			'FSSX',
			'FQYY', 'SCYY',
			'QRJY'
		);
		$preSql = 'select id from fm_authority where optcode in (' . trim( str_repeat('?,', count($aus)), ',' ) .')';
		$list = TableUtil::queryCustom($preSql, $aus);
		//生成权限数据
		$uas = array();
		foreach ($list as $l){
			$ua = new UserAuthority();
			$ua->init(array(
				'userfk'	=> $uid ,
				'authority' => $l->id ,
			));
			$uas[] = $ua;
		}
		return TableUtil::insertMulti_with_prepare( $uas );
	}
}