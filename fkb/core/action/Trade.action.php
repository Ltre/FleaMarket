<?php

/**
 * 交易模块
 * @author Oreki
 * @since 2014-4-30
 */

class TradeAction extends ActionUtil {
	

	/**
	 * @shell
	 * 获取自己的交易详细
	 * （注意：不需要编写“获取他人预约明细”的功能）
	 * 指令参数：预约id|Z/Q|每页条数|开始索引
	 */
	function getTradeDetails($u){
		$feedback = array('status'=>null, 'details'=>null);	//反馈结果
		$p = $u['params'];
		$id = intval($p[1]);
		$feedback['num'] = intval($p[3]);
		$feedback['start'] = intval($p[4]);
		$tradetype = $p[2];
		$preSql = !strcasecmp($tradetype, 'Z') ? AiSQL::getSqlExpr('getTradeDetail_sell') : AiSQL::getSqlExpr('getTradeDetail_buy');
		$rs = AiMySQL::queryCustomByParams($preSql.'and t.id='.$id, array());
		$r = null; foreach ($rs as $r);
		if(!$r)
			$feedback['status'] = 'NOTFOUND';	//无此记录
		else{
			$feedback['status'] = 'SUCCESS';
			$feedback['details'] = $r;	//保存交易记录
		}
	
		$feedback['id'] = $id;//保存当前交易id，给details.php用
		$feedback['tradetype'] = $tradetype;//保存当前交易类型，给details.php用
		self::setTplArgs($feedback);//设置反馈结果供self/other视图使用
		require_once OTHER_TEMPLATE_DIR.'ace/selfrecord/tradelist/details.php';
	}
	
	
	/**
	 * @shell
	 * 确认交易
	 * 指令参数：预约id|身份（甲方left|乙方right）
	 */
	function affirmTrade($u){
		$feedback = array(
				'status' => null,
				'msg' => null,
		);
		$flag = false;//操作成功的标志
		$id = intval($u['params'][1]);
		$opt = $u['params'][2];
		$rs = AiMySQL::queryEntity('trade', array(new AiMySQLCondition('id', '=', $id)));
		$r = null; if($rs) foreach ($rs as $r);
		if($r){
			if($opt=='left'){ //甲方确认交易
				switch ($r->status){
					case 0:
					case 2:
					case 5:
						$r->status = $r->status==0?1:($r->status==2?3:6);
						if(AiMySQL::update($r)){
							$feedback['status'] = 'SUCCESS';
							$feedback['msg'] = '你已确认该交易，请点击顶部的刷新按钮查看';
							$flag = true;
						}else {
							$feedback['status'] = 'EXCEPTION1';
							$feedback['msg'] = '出现了异常，异常代码：CANNOTCHANGESTATUS，请联系管理员修复';
						}
						break;
					case 1:
					case 3:
					case 6:
						$feedback['status'] = 'TWOAFFIRM';
						$feedback['msg'] = '你已经确认了，不要重复操作';
						break;
					case 4:
					case 7:
					case 8:
						$feedback['status'] = 'TWONEGATE';
						$feedback['msg'] = '你之前否认了，可不要反悔了';
				}
			}else{ //乙方确认交易
				switch ($r->status){
					case 0:
					case 1:
					case 4:
						$r->status = $r->status==0?2:($r->status==1?3:7);
						if(AiMySQL::update($r)){
							$feedback['status'] = 'SUCCESS';
							$feedback['msg'] = '你已确认该交易，请点击顶部的刷新按钮查看';
							$flag = true;
						}else {
							$feedback['status'] = 'EXCEPTION1';
							$feedback['msg'] = '出现了异常，异常代码：CANNOTCHANGESTATUS，请联系管理员修复';
						}
						break;
					case 2:
					case 3:
					case 7:
						$feedback['status'] = 'TWOAFFIRM';
						$feedback['msg'] = '你已经确认了，不要重复操作';
						break;
					case 5:
					case 6:
					case 8:
						$feedback['status'] = 'TWONEGATE';
						$feedback['msg'] = '你之前否认了，可不要反悔了';
				}
			}
			//交易状态为终态时，推送提醒给对方
			if(in_array($r->status, array(3,6,7,8))){
				MessageUtil::sendTradeResult($r->id, $r->tradetype);
			}
			//交易成功后，自动生成一条空的评价记录
			if($r->status==3){
				$appraise = new Appraise();
				//  填充评价字段  //
				/* if(!AiMySQL::insert($appraise)){
				 $feedback['status'] = 'EXCEPTION2';
				$feedback['msg'] = '出现了异常，异常代码：CANNOTCREATEAPPRAISE，请联系管理员修复';
				} */
			}
		}else{
			$feedback['status'] = 'NOTFOUND';
			$feedback['msg'] = '该交易不存在或被删除';
		}
		print json_encode($feedback);
	}
	
	
	/**
	 * @shell
	 * 否认交易
	 * 指令参数：预约id|身份（甲方left|乙方right）
	 */
	function negateTrade($u){
		$feedback = array(
				'status' => null,
				'msg' => null,
		);
		$flag = false;//操作成功的标志
		$id = intval($u['params'][1]);
		$opt = $u['params'][2];
		$rs = AiMySQL::queryEntity('trade', array(new AiMySQLCondition('id', '=', $id)));
		$r = null; if($rs) foreach ($rs as $r);
		if($r){
			if($opt=='left'){ //甲方否认
				switch ($r->status){
					case 0:
					case 2:
					case 5:
						$r->status = $r->status==0?4:($r->status==2?7:8);
						if(AiMySQL::update($r)){
							$feedback['status'] = 'SUCCESS';
							$feedback['msg'] = '你已否认该交易，请点击顶部的刷新按钮查看';
							$flag = true;
						}else {
							$feedback['status'] = 'EXCEPTION1';
							$feedback['msg'] = '出现了异常，异常代码：CANNOTCHANGESTATUS，请联系管理员修复';
						}
						break;
					case 4:
					case 7:
					case 8:
						$feedback['status'] = 'TWONEGATE';
						$feedback['msg'] = '你已经否认了，不要重复操作';
						break;
					case 1:
					case 3:
					case 6:
						$feedback['status'] = 'TWOAFFIRM';
						$feedback['msg'] = '你之前确认了，可不要反悔了';
				}
			}else{ //乙方否认
				switch ($r->status){
					case 0:
					case 1:
					case 4:
						$r->status = $r->status==0?5:($r->status==1?6:8);
						if(AiMySQL::update($r)){
							$feedback['status'] = 'SUCCESS';
							$feedback['msg'] = '你已确认该交易，请点击顶部的刷新按钮查看';
							$flag = true;
						}else {
							$feedback['status'] = 'EXCEPTION1';
							$feedback['msg'] = '出现了异常，异常代码：CANNOTCHANGESTATUS，请联系管理员修复';
						}
						break;
					case 5:
					case 6:
					case 8:
						$feedback['status'] = 'TWONEGATE';
						$feedback['msg'] = '你已经否认了，不要重复操作';
						break;
					case 2:
					case 3:
					case 7:
						$feedback['status'] = 'TWOAFFIRM';
						$feedback['msg'] = '你之前确认了，可不要反悔了';
				}
			}
		}else{
			$feedback['status'] = 'NOTFOUND';
			$feedback['msg'] = '该交易不存在或被删除';
		}
		//交易状态为终态时，推送提醒给对方
		if(in_array($r->status, array(3,6,7,8))){
			MessageUtil::sendTradeResult($r->id, $r->tradetype);
		}
		print json_encode($feedback);
	}
	
	
	
	
}