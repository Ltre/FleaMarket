<?php
class CollectAction extends ActionUtil{	
	/**
	 * 收藏旧货信息
	 * 指令参数：操作类型(sell/buy)|旧货信息id|发布人id
	 */
	function addCollect( $u ){
		$feed = array(
			'status' => null,
			'msg' => null,
		);
		$user = $_SESSION['user'];
		$p = $u['params'];
		$opt = $p[1];
		$cltype = $opt=='sell'?'Z':'Q';
		$rz = intval($p[2]);
		$cu = intval($p[3]);//旧货发布人
		if($user->id == $cu){
			$feed['status'] = 'DONTSELF';
			$feed['msg'] = '不能收藏自己的旧货信息';
			die(json_encode($feed));
		}
		//判断是否已经收藏
		if(TableUtil::getEntityFromField('collect', array(
			new AiMySQLCondition('collecttype', '=', $cltype),
			new AiMySQLCondition('recordz', '=', $rz),
			new AiMySQLCondition('creuser', '=', $user->id),
		))) {
			$feed['status'] = 'DUPLICATE';
			$feed['msg'] = '你已经收藏过了，不要重复操作';
			die(json_encode($feed));
		}
		//判断旧货信息是否存在
		$rs = AiMySQL::queryEntity($opt, array(new AiMySQLCondition('id', '=', $rz)));
		$r=null;foreach ($rs as $r);if(!$r){
			$feed['status'] = 'NOTFOUND';
			$feed['msg'] = '无法收藏，该条旧货信息在不久前被删除或被屏蔽了，不信你刷新看看';
			die(json_encode($feed));
		}
		//插入收藏数据
		$c = new Collect();
		$c->init(array(
			'collecttype' => $cltype,
			'recordz' => $rz,
			'creuser' => $user->id,
			'cretime' => OrekiUtil::getCurrentFormatTime(),
		));
		if(TableUtil::insert_with_prepare( $c )){
			$feed['status'] = 'SUCCESS';
			$feed['msg'] = '收藏成功';
		}else{
			$feed['status'] = 'EXCEPTION';
			$feed['msg'] = '出现了异常，代码[CNTCOLLECT]';
		}
		print json_encode($feed);
	}
	
	/**
	 * @shell
	 * 删除自己的某个收藏
	 * 指令参数：收藏id
	 */
	function delMyCollect($u){
		$feed = array(
			'status' => null,
			'msg' => null,
			'deleted_id' => null,
		);
		$id = intval($u['params'][1]);
		$entity = TableUtil::getEntityFromField('collect', array(new AiMySQLCondition('id', '=', $id)));
		if(!$entity){
			$feed['status'] = 'NOTFOUND';
			$feed['msg'] = '该收藏在不久前被删除了';
			die(json_encode($feed));
		}
		if($_SESSION['user']->id != $entity->creuser){
			$feed['status'] = 'NOTYOURS';
			$feed['msg'] = '这条收藏不是你的，请勿非法操作';
			die(json_encode($feed));
		}
		$c = new Collect();
		$c->id = $id;
		if(AiMySQL::delete($c)){
			$feed['status'] = 'SUCCESS';
			$feed['msg'] = '删除成功';
			$feed['deleted_id'] = $id;
		}else{
			$feed['status'] = 'SUCCESS';
			$feed['msg'] = '删除时发生了异常，代码[CNOTDELCOLC]';
		}
		print json_encode($feed);
	}
	
}