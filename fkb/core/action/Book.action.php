<?php

/**
 * 预约模块
 * @author Ltre
 * @since 2014-4-13
 */

class BookAction extends ActionUtil {
	/**
	 * @shell
	 * 在Matrix视图的旧货明细中执行预约功能，执行成功后发送通知给对方
	 * 指令参数：见面时间|见面地点|预定目的|信息类型(sell/buy)|转让求购id|甲方|乙方（|预定类型Z/Q）
	 */
	function addFleaBook( $u ){
		$feedback = array(
			'status' => null,
		);
		if(!isset($_SESSION['user'])){
			$feedback['status'] = 'NOTLOGIN';
			$feedback['msg'] = '没登录就想预约，你兄弟知道吗？';
			print json_encode($feedback);
			return;
		}
		$p = $u['params'];
		//自己跟自己预约？だめだ
		if($p[6]==$p[7]) {
			$feedback['status'] = 'DONTSELF';
			print json_encode($feedback);
			return;
		}
		$bk = new Book();
		$bk->meettime = date('Y-m-d H:i:s', strtotime($p[1]));
		$meetplace = str_replace('"', '\"', str_replace('\\', "/", $p[2]));
		$bk->meetplace = $meetplace;
		$bk->purpose = intval($p[3]);
		$opt = $p[4];
		$flag = !strcasecmp($p[4], 'sell')?true:false;
		$bk->recordz = intval($p[5]);
		$bk->leftuser = intval($p[6]);
		$bk->rightuser = intval($p[7]);
		$bk->booktype = $flag ? 'Z' : 'Q';
		$bk->status = 1;//默认为1，同意时改为2，拒绝时改为0
		//单方约定时，以当前操作时间为约定时间；当双方约定时，从该操作的时刻为约定时间，重新记录到数据库。
		$bk->booktime = OrekiUtil::getCurrentFormatTime();
		//查询是否预约过了
		$rs = AiMySQL::queryEntity('book',array(
			new AiMySQLCondition('recordz', '=', $bk->recordz),
			new AiMySQLCondition('leftuser', '=', $bk->leftuser),
			new AiMySQLCondition('rightuser', '=', $bk->rightuser),
			new AiMySQLCondition('booktype', '=', $bk->booktype),
		));
		$r = null; if($rs) foreach ($rs as $r);
		if($r) $feedback['status'] = 'DUPLICATE';//已经预约过了
		else{
			$inserted = AiMySQL::insert($bk);
			$feedback['status'] = $inserted ? 'SUCCESS' : 'FAILURE';//预约成功/失败
			if($inserted){
				//预约成功时，用消息通知对方
				$msg = new Message();
				
				$sql = $flag ? AiSQL::getSqlExpr('getBookSellNotice') : AiSQL::getSqlExpr('getBookBuyNotice');
				$notices = AiMySQL::queryCustomByParams($sql, array(
					'me' => $_SESSION['user']->id,
					'leftuser' => $bk->leftuser,
					'recordz' => $bk->recordz,
				));
				$notice = null; if($notices)foreach ($notices as $notice);
				if($notice){
					$url = '?x=getBookDetails|'.$notice['id'].'|'.$bk->booktype.'|10|0';//获取预定明细的链接
					$msg->title = '预约提醒： # <font color=black>'.$notice['title'].'</font>{物品名：'.$notice['name'].'}'.' # 被'.$notice['username'].' 预约';
					$msg->contents = "你发布的【<a href='?x=browseFleaDetail|$opt|".$notice['titlecode']."' target='_blank' >".$notice['title']
						."</a>】被【<a href='?x=displayProfile|".$notice['uid']."' target='_blank' >".$notice['username']."</a>】预订"
						.'<button url='.$url.'>点击查看详细</button>';
// 						.'<br>点击<button onclick="'
// 						.'$.post("'.$url.'",function(data){'
// 						.'$(".page-content").replaceWith(data);'
// 						.'});'
// 						.'"># 此处  #</button>查看详细';
					$msg->isread = false;
					$msg->msgtype = 4;
					$msg->receiver = $bk->leftuser;
					$msg->sender = 1;//SYSTEM用户
					$msg->sendtime = OrekiUtil::getCurrentFormatTime();
					$feedback['msg']=AiMySQL::insert($msg);
				} 
			}
		}
		print json_encode($feedback);
	}
	
	/**
	 * @shell
	 * 获取自己的预约详细
	 * （注意：不需要编写“获取他人预约明细”的功能）
	 * 指令参数：预约id|Z/Q|每页条数|开始索引
	 */
	function getBookDetails($u){
		$feedback = array('status'=>null, 'details'=>null);	//反馈结果
		$p = $u['params'];
		$id = intval($p[1]);
		$feedback['num'] = intval($p[3]);
		$feedback['start'] = intval($p[4]);
		//$booktype = TableUtil::getValueFromField('book', 'booktype', array(new AiMySQLCondition('id', '=', $id)));
		$booktype = $p[2];
		$preSql = !strcasecmp($booktype, 'Z') ? AiSQL::getSqlExpr('getBookDetail_sell') : AiSQL::getSqlExpr('getBookDetail_buy');
		//$rs = AiMySQL::queryCustomByParams($preSql, array('rightuser'=>$_SESSION['user']->id));
		$rs = AiMySQL::queryCustomByParams($preSql.'and b.id='.$id, array());
		$r = null; foreach ($rs as $r);
		if(!$r)
			$feedback['status'] = 'NOTFOUND';	//无此记录
		else{
			$feedback['status'] = 'SUCCESS';
			$feedback['details'] = $r;	//保存旧货类型对象
		}
		
		$feedback['id'] = $id;//保存当前预约id，给details.php用
		$feedback['booktype'] = $booktype;//保存当前预约类型，给details.php用
		self::setTplArgs($feedback);//设置反馈结果供self/other视图使用
		require_once OTHER_TEMPLATE_DIR.'ace/selfrecord/booklist/details.php';
	}
	
	/**
	 * @shell
	 * 删除预约：仅在被拒绝、等待确认时可用
	 * 指令参数：预订id
	 */
	function delBookInfo($u){
		$feedback = array();
		$flag = false;//操作是否成功
		$p = $u['params'];
		$id = intval($p[1]);
		$r = null;
		$rs = AiMySQL::queryEntity('book', array(new AiMySQLCondition('id', '=', $id)));
		if($rs)
			foreach ($rs as $r);
		if(!$r)
			$feedback['status'] = 'NOTFOUND';
		else{
			if(2==$r->status){
				$feedback['status'] = 'DONTDEL';//禁止删除，因为已经达成预约了
			}else{
				if(AiMySQL::delete($r)){
					$flag = true;
					$feedback['status'] = 'SUCCESS';
					$feedback['deleted'] = $id;//被删除的预订信息的id
				}else{
					$feedback['status'] = 'EXCEPTION';//删除过程中出现了异常
				}
			}
		}
		print(json_encode($feedback));
	}
	
	/**
	 * @shell
	 * 甲方同意预约
	 * 指令参数：预约id
	 */
	function agreeBook($u){
		$feedback = array(
			'status' => null,
			'msg' => null,
		);
		$flag = false;//操作成功的标志
		$id = intval($u['params'][1]);
		$rs = AiMySQL::queryEntity('book', array(new AiMySQLCondition('id', '=', $id)));
		$r = null; if($rs) foreach ($rs as $r);
		if($r){
			if(2==$r->status){
				$feedback['status'] = 'TWOAGREE';
				$feedback['msg'] = '你已经同意了，不要重复操作';
			}else if(0==$r->status){
				$feedback['status'] = 'TWODISAGREE';
				$feedback['msg'] = '你之前拒绝了，可不要反悔了';
			}else{
				$r->status = 2;
				if(AiMySQL::update($r)){
					$feedback['status'] = 'SUCCESS';
					$feedback['msg']='你已接受该预约';
					$flag = true;
				}else{
					$feedback['status']='EXCEPTION1';
					$feedback['msg'] = "出现了异常,异常代码：CANNOTCHANGESTATUS，请联系管理员修复";
				}
			}
		}else{
			$feedback['status'] = 'NOTFOUND';
			$feedback['msg'] = '该预约不存在或被删除';
		}
		//预约成功后，自动生成一条空的交易记录
		if($flag){
			$trade = new Trade();
			$trade->bookfk = $id;
			$trade->tradetype = $r->booktype;
			$trade->goods = '暂未指定交易实物';
			$trade->lefttime = OrekiUtil::getCurrentFormatTime();
			$trade->righttime = OrekiUtil::getCurrentFormatTime();
			$trade->status = 0;//双方都未确认
			if(!AiMySQL::insert($trade)){
				$feedback['status'] = 'EXCEPTION2';
				$feedback['msg'] = '出现了异常，异常代码：CANNOTCREATETRADE，请联系管理员修复';
			}else{ 
				//顺便推送同意预约的提醒
				MessageUtil::sendAgreeOrNot($id, $r->booktype, 1);
				//预约达成时，发送交易确认提醒
				MessageUtil::sendTradeRemind($id, $r->booktype);
			}
		}
		print json_encode($feedback);
	}
	
	/**
	 * @shell
	 * 甲方拒绝预约
	 * 指令参数：预约id
	 */
	function disagreeBook($u){
		$feedback = array(
				'status' => null,
				'msg' => null,
		);
		$id = intval($u['params'][1]);
		$rs = AiMySQL::queryEntity('book', array(new AiMySQLCondition('id', '=', $id)));
		$r = null; if($rs) foreach ($rs as $r);
		if($r){
			if(2==$r->status){
				$feedback['status'] = 'TWOAGREE';
				$feedback['msg'] = '你之前同意了，可不要反悔了';
			}else if(0==$r->status){
				$feedback['status'] = 'TWODISAGREE';
				$feedback['msg'] = '你已经拒绝了，不要重复操作';
			}else{
				$r->status = 0;
				if(AiMySQL::update($r)){
					$feedback['status'] = 'SUCCESS';
					$feedback['msg']='你已拒绝该预约';
					
					//顺便推送预约被拒绝的提醒
					MessageUtil::sendAgreeOrNot($id, $r->booktype, 0);
					
				}else{
					$feedback['status']='EXCEPTION1';
					$feedback['msg'] = "出现了异常,异常代码：CANNOTCHANGESTATUS，请联系管理员修复";
				}
			}
		}else{
			$feedback['status'] = 'NOTFOUND';
			$feedback['msg'] = '该预约不存在或被删除';
		}
		print json_encode($feedback);
	}
	
	
	
}

?>