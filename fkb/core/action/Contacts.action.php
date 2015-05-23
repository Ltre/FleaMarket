<?php
class ContactsAction extends ActionUtil {
	/**
	 * @shell
	 * 纳入联系人
	 * 指令参数：乙方id
	 */
	function addAsContacts($urlInfo) {
		$leftuser = $_SESSION['user']->id;
		$rightuser = intval($urlInfo['params'][1]);
		$leftuser==$rightuser and die('2');//不能添加自己
		$cretime = OrekiUtil::getCurrentFormatTime();
		
		//查找是否已将乙方纳入联系人
		$old_cs = AiMySQL::queryEntity('contacts', array(new AiMySQLCondition('leftuser', '=', $leftuser)));
		$old_c = null; if($old_cs) foreach ($old_cs as $old_c) {
			if($old_c->rightuser == $rightuser)
				die('3');//已经是联系人了
		}
		
		$c = new Contacts();
		foreach ($c as $i=>$v){
			if($i=='id')break;
			$c->$i = $$i;
		}
		print AiMySQL::insert($c) ? 1 : 0;//成功为1，失败为0
	}
	
	/**
	 * @shell
	 * 删除一个联系人
	 * 指令参数：乙方id
	 */
	function delOneContact($urlInfo){
		$flag = false;
		$feedback = array('status'=>null);
		$leftuser = $_SESSION['user']->id;
		$rightuser = intval($urlInfo['params'][1]);
		//查询现有的联系人
		$c = null;
		$cs = AiMySQL::queryEntity(
			'contacts', 
			array(
				new AiMySQLCondition('leftuser', '=', $leftuser),
				new AiMySQLCondition('rightuser', '=', $rightuser),
		) );
		if($cs){ 
			foreach ($cs as $c) if(! AiMySQL::delete($c)){
				$feedback['status'] = 'FAILURE';//删除失败
				$flag = false;
			}
		}else{
			$feedback['status'] = 'NOTFOUND';//要删除的对象不存在
			$flag = false;
		}
		if($flag) $feedback['status'] == 'SUCCESS';//删除成功
		print json_encode($feedback);
	}
	
	/**
	 * @shell
	 * 获取联系人列表
	 * 指令参数：每页个数|数据库开始索引
	 */
	function listMyContacts( $urlInfo ){
		$leftuser = $_SESSION['user']->id;
		$p = $urlInfo['params'];
		$num = intval($p[1]);
		$start = intval($p[2]);
		$sql = AiSQL::getSqlExpr('getMyContacts');
		$cs = aimysql::queryCustomByParams($sql, array('leftuser'=>$leftuser), $num, $start);
		print json_encode($cs);
	}
}