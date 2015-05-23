<?php
/**
 * 与消息有关的控制器
 * 例如：私信、公告、预约/交易/评价/关注/收藏提醒
 * @author Oriki
 * @since 2014-3-29
 */

class MessageAction extends ActionUtil {
	
	/**
	 * @shell
	 * 发送私信
	 * 指令参数：发送人id|内容|接收人id|标题
	 * 可选POST参数：
	 * 		内容(contents)（当其为空串时，以指令参数的为准）
	 * 		带链标题：linkhref
	 */
	function sendPersonalLetter($urlInfo){
		$p = $urlInfo['params'];
		$sender = intval($p[1]);
		if(!isset($_SESSION['user']))
			die('请登录后再发送私信');
		$user = $_SESSION['user'];
		if($p[1]!=$user->id)
			die('你使用他人名义发送私信，属非法操作→_→');
		if($p[3]==$user->id)
			die('不要自言自语→_→');
		$linkhref = @$_POST['linkhref'];//#带链接的标题#
		$content = $p[2]=='THIS_IS_AI_CONTENTS_IN_SENDING_LETTER'?$_POST['contents']:$p[2];
		$content = str_replace('"', '\"', str_replace('\\', "/", $content));//防止SQL初级注入
		$content = OrekiUtil::editorContentFilterToDB($content);//阻止恶意脚本
		$content = $linkhref . $content;//最终私信内容
		$title = $p[4]=='THIS_IS_AI_TITLE_IN_SENDING_LETTER'?$_POST['title']:$p[4];
		$title = str_replace('"', '\"', str_replace('\\', "/", $title));//防止SQL初级注入
		$title = OrekiUtil::editorContentFilterToDB($title);//阻止恶意脚本
		$recv = intval($p[3]);
		$m = new Message();
		$m->msgtype = 2;
		$m->title = $title;
		$m->contents = $content;
		$m->isread = false;
		$m->receiver = $recv;
		$m->sender = $sender;
		$m->sendtime = OrekiUtil::getCurrentFormatTime();
		print AiMySQL::insert($m) ? '发送成功' : '发送失败' ;
	}
	
	/**
	 * @shell
	 * 获取自己的单条私信明细
	 * 指令参数：私信id
	 */
	function getLetterDetail( $u ){
		$feed = array(
			'status' => null,
			'msg'	=>	null,
			'letter' => null,
		);
		$flag = false;
		$user = $_SESSION['user'];
		$id = intval($u['params'][1]);
		$rs = AiMySQL::queryCustomByParams(AiSQL::getSqlExpr('msg/getMsgDtl'), array('id'=>$id));
		$r = null; if($rs) foreach ($rs as $r);
		if(!$r){
			$feed['status'] = 'NOTFOUND';
			$feed['msg'] = '该条私信不存在';
		}else{
			if($r['msgtype']!=2){
				$feed['status'] = 'NOTLETTER';
				$feed['msg'] = '你请求的不是私信内容，请勿非法操作！';
			}else if($r['senderid']!=$user->id && $r['receiverid']!=$user->id){
				$feed['status'] = 'NOTYOURS';
				$feed['msg'] = '请求的私信不是你的，请勿非法操作！';
			}else{
				$feed['status'] = 'SUCCESS';
				$feed['msg'] = '获取成功';
				$feed['letter'] = $r;//数组形式，详见SQL
				$flag = true;//决定将该条消息记为已读
			}
		}
		print json_encode($feed);
		//将私信改为已读（前提是成功读取，且接收人是自己）
		if($flag && $r['receiverid']==$user->id)
			AiMySQL::connect()->exec('update fm_message set isread=true where id='.$id);
	}
	
	/**
	 * @shell
	 * 获取自己的单条提醒明细
	 * 指令参数：消息id
	 */
	function getRemindDetail( $u ){
		$feed = array(
				'status' => null,
				'msg'	=>	null,
				'letter' => null,
		);
		$flag = false;
		$user = $_SESSION['user'];
		$id = intval($u['params'][1]);
		$rs = AiMySQL::queryCustomByParams(AiSQL::getSqlExpr('msg/getMsgDtl'), array('id'=>$id));
		$r = null; if($rs) foreach ($rs as $r);
		if(!$r){
			$feed['status'] = 'NOTFOUND';
			$feed['msg'] = '该条提醒不存在';
		}else{
			if(! in_array($r['msgtype'], array(4,5,7,8))){
				$feed['status'] = 'NOTLETTER';
				$feed['msg'] = '你请求的不是操作提醒内容，请勿非法操作！';
			}else if($r['receiverid']!=$user->id){
				$feed['status'] = 'NOTYOURS';
				$feed['msg'] = '这条操作提醒不是你的，请勿非法操作！';
			}else{
				$feed['status'] = 'SUCCESS';
				$feed['msg'] = '获取成功';
				$feed['letter'] = $r;//数组形式，详见SQL
				$flag = true;//决定将该条消息记为已读
			}
		}
		print json_encode($feed);
		//将私信改为已读（前提是成功读取，且接收人是自己）
		if($flag && $r['receiverid']==$user->id)
			AiMySQL::connect()->exec('update fm_message set isread=true where id='.$id);
	}
	
	
}












