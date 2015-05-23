<?php
class MessageUtil {
	
	/**
	 * 预约被同意/拒绝时，推送提醒给乙方
	 * @param int $id 预约id
	 * @param string $booktype 类型Z/Q
	 * @param int $opt 同意1/拒绝0
	 */
	static function sendAgreeOrNot( $id, $booktype, $opt ){
		$msg = new Message();
		$sql = $booktype=='Z' ? AiSQL::getSqlExpr('agreeOrNoNotice/absell') : AiSQL::getSqlExpr('agreeOrNoNotice/abbuy');
		$notices = AiMySQL::queryCustomByParams($sql, array(
				'id' => $id,
		));
		$notice = null; if($notices)foreach ($notices as $notice);
		if($notice){
			$url = '?x=getBookDetails|'.$id.'|'.$booktype.'|10|0';//获取预定明细的链接
			$opt = $opt?'同意':'拒绝';
			$msg->title = $notice['leftuser'].$opt.'了你在 # <font color=black>'.$notice['title'].'</font>'.' # 发起的预约';
			$msg->contents = '你于['.$notice['booktime'].']时刻，在【'.$notice['title'].'】发起的预约已被'.$notice['leftuser'].$opt.'。<br>'
				.'<button url='.$url.'>点击查看详细</button>';
			$msg->isread = false;
			$msg->msgtype = 4;
			$msg->receiver = $notice['rightuserid'];
			$msg->sender = 1;//SYSTEM用户
			$msg->sendtime = OrekiUtil::getCurrentFormatTime();
// 			print 'insert into fm_message(title,contents,isread,msgtype,receiver,sender,sendtime)'
// 				.'values("'.$msg->title.'","'.$msg->contents.'",false,'.$msg->msgtype.','.$msg->receiver.','.$msg->sender.',"'.$msg->sendtime.'")';
			AiMySQL::connect()->exec('insert into fm_message(title,contents,isread,msgtype,receiver,sender,sendtime)'
				.'values("'.$msg->title.'","'.$msg->contents.'",false,'.$msg->msgtype.','.$msg->receiver.','.$msg->sender.',"'.$msg->sendtime.'")');
		}
	}
	
	/**
	 * 预约达成时，发送交易确认提醒
	 * @param unknown $bookid
	 * @param unknown $booktype
	 */
	static function sendTradeRemind($bookid, $booktype){
		$msg = new Message();
		$sql = $booktype=='Z' ? AiSQL::getSqlExpr('booktotrade/atsell') : AiSQL::getSqlExpr('booktotrade/atbuy');
		$notices = AiMySQL::queryCustomByParams($sql, array(
				'id' => $bookid,
		));
		$notice = null; if($notices)foreach ($notices as $notice);
		if($notice){
			$islft = $_SESSION['user']->id == $notice['leftuserid'];//判断自己是不是甲方
			$url = '?x=getTradeDetails|'.$notice['tid'].'|'.$booktype.'|10|0';//获取交易明细的链接
			$msg->title = ' # <font color=black>'.$notice['title'].'</font>'.' # 你'.$notice['leftuser'].'和的预约已经达成，请尽快完成交易';
			$opt = $booktype=='Z'?'求购':'转让';
			$msg->contents = '你在【'.$notice['title'].'】的'.$opt.'中，和'.$notice['leftuser'].'的预约已达成。<br>'
					.'<br><button url='.$url.'>现在去确认交易吗？</button>';
			$msg->isread = false;
			$msg->msgtype = 5;
			$msg->receiver = $notice['rightuserid'];
			$msg->sender = 1;//SYSTEM用户
			$msg->sendtime = OrekiUtil::getCurrentFormatTime();
			AiMySQL::connect()->exec('insert into fm_message(title,contents,isread,msgtype,receiver,sender,sendtime)'
					.'values("'.$msg->title.'","'.$msg->contents.'",false,'.$msg->msgtype.','.$msg->receiver.','.$msg->sender.',"'.$msg->sendtime.'")');
			
			$msg->title = ' # <font color=black>'.$notice['title'].'</font>'.' # 你'.$notice['rightuser'].'和的预约已经达成，请尽快完成交易';
			$msg->contents = '你在【'.$notice['title'].'】的'.$opt.'中，和'.$notice['rightuser'].'的预约已达成。<br>'
				.'<br><button url='.$url.'>现在去确认交易吗？</button>';
			$msg->receiver = $notice['leftuserid'];
			AiMySQL::connect()->exec('insert into fm_message(title,contents,isread,msgtype,receiver,sender,sendtime)'
					.'values("'.$msg->title.'","'.$msg->contents.'",false,'.$msg->msgtype.','.$msg->receiver.','.$msg->sender.',"'.$msg->sendtime.'")');
		}
	}
	
	/**
	 * 推送交易结果给双方（成功、失败）
	 * @param int $id 预约id
	 * @param string $booktype 类型Z/Q
	 * @param int $opt 同意1/拒绝0
	 * @param int $receiver 接收人id
	 */
	static function sendTradeResult($id, $tradetype){
			$msg = new Message();
		$sql = $tradetype=='Z' ? AiSQL::getSqlExpr('traders/trsell') : AiSQL::getSqlExpr('traders/trbuy');
		$notices = AiMySQL::queryCustomByParams($sql, array(
				'id' => $id,
		));
		$notice = null; if($notices)foreach ($notices as $notice);
		if($notice){
			$url = '?x=getTradeDetails|'.$notice['id'].'|'.$tradetype.'|10|0';//获取交易明细的链接
			$msg->title = ' # <font color=black>'.$notice['title'].'</font>'.' # 你和'.$notice['leftuser'].'的'.$notice['statusvalue'];
			$msg->contents = '你和'.$notice['leftuser'].'在【'.$notice['title'].'】中进行的'.$notice['statusvalue'].'<br>'
					.'<br><button url='.$url.'>点击查看详细内容</button>';
			$msg->isread = false;
			$msg->msgtype = 5;
			$msg->receiver = $notice['rightuserid'];
			$msg->sender = 1;//SYSTEM用户
			$msg->sendtime = OrekiUtil::getCurrentFormatTime();
			AiMySQL::connect()->exec('insert into fm_message(title,contents,isread,msgtype,receiver,sender,sendtime)'
					.'values("'.$msg->title.'","'.$msg->contents.'",false,'.$msg->msgtype.','.$msg->receiver.','.$msg->sender.',"'.$msg->sendtime.'")');
			
			$msg->title = ' # <font color=black>'.$notice['title'].'</font>'.' # 你和'.$notice['rightuser'].'的'.$notice['statusvalue'];
			$msg->contents = '你和'.$notice['rightuser'].'在【'.$notice['title'].'】中进行的'.$notice['statusvalue'].'<br>'
				.'<br><button url='.$url.'>点击查看详细内容</button>';
			$msg->receiver = $notice['leftuserid'];
			AiMySQL::connect()->exec('insert into fm_message(title,contents,isread,msgtype,receiver,sender,sendtime)'
					.'values("'.$msg->title.'","'.$msg->contents.'",false,'.$msg->msgtype.','.$msg->receiver.','.$msg->sender.',"'.$msg->sendtime.'")');
		}
	}
}