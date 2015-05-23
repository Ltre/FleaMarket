<?php

/**
 * 设置关注旧货信息、用户、分类的模块
 * @author Oreki
 * @since 2014-5-2
 */

class FollowAction extends ActionUtil {
	
	/**
	 * @shell
	 * 关注某用户
	 * 指令参数：被关注用户的id
	 */
	function addUserFollow( $u ) {
		$feed = array(
			'status' => null,
			'msg' => null,
		);
		$id = intval($u['params'][1]);
		$me = $_SESSION['user']->id;
		if($id==$me) {
			$feed['status'] = 'DONTSELF';
			$feed['msg'] = '不能关注自己';
			die(json_encode($feed));
		}
		$rs = AiMySQL::queryEntity('follow', array(
			new AiMySQLCondition('followuserfk', '=', $id),
			new AiMySQLCondition('creuser', '=', $me),
		));
		$r = null; if($rs) foreach ($rs as $r);
		if($r){
			$feed['status'] = 'DUPLICATE';
			$feed['msg'] = '你已经关注过了，不要重复关注';
			die(json_encode($feed));
		}
		$f = new Follow();
		$f->init(array(
			'followuserfk' => $id,
			'creuser' => $me,
			'cretime' => OrekiUtil::getCurrentFormatTime(),
		));
		//if(TableUtil::insert($f, array('cretime'))){  //用这种插入方法也可以
		if(TableUtil::insert_with_prepare($f)){
			$feed['status'] = 'SUCCESS';
			$feed['msg'] = '关注成功！';
		}else{
			$feed['status'] = 'EXCEPTION';
			$feed['msg'] = '出现了异常，代码[CNOTFLUSR]，请联系管理员修复';
		}
		print json_encode($feed);
	}
	
}