<?php
class FoptAction extends ActionUtil{
	
	/**
	 * @shell
	 * 删除旧货信息
	 * 指令参数：类型(sell/buy)|标题编码
	 */
	public function delFleaInfo($urlInfo){
		$feedback = array(
				'status' => null,
				'msg' => null,
				'deleted' => null,
		);
		$p = $urlInfo['params'];
		$opt = $p[1];
		$tc = $p[2];
		$isSell = !strcasecmp('sell', $opt);
		//$tmp = $isSell ? new Sell() : new Buy();
		$r = null;
		$rs = AiMySQL::queryEntity($opt, array(new AiMySQLCondition('titlecode', '=', $tc)));
		if($rs)
			foreach ($rs as $r);
		if(!$r){
			$feedback['status'] = 'NOTFOUND';
			$feedback['msg'] = '该条'.($isSell?'转让':'求购').'记录不存在';
		}else{
			//$tmp->id = $r->id;
			//查询有预定记录的旧货信息的id
			$ids = AiMySQL::queryCustom('select id from fm_'.$opt.' where id in ( select recordz from fm_book where booktype="'.($isSell?'Z':'Q').'" ) and id='.$r->id);
			$id = null;if($ids)foreach ($ids as $id);
			if($id){
				$feedback['status'] = 'ISBOOKED';
				$feedback['msg'] = '该旧货信息已被预订，不允许删除';
			}else{
				if(AiMySQL::delete($r)){
					$feedback['status'] = 'SUCCESS';
					$feedback['msg'] = '删除成功';
					$feedback['deleted'] = $tc;//被删除的旧货信息的标题编码
				}else{
					$feedback['status'] = 'FAILURE';
					$feedback['msg'] = '删除时发生了异常，请联系管理员';
				}
			}
		}
		print(json_encode($feedback));
	}
	
	/**
	 * @shell
	 * @filter
	 * 获取单条旧货信息的详情
	 * 指令参数：信息类型（sell/buy）|标题编码|视图类型（self/other）|每页结果集个数|遍历开始索引
	 * 		视图类型：以查看自己的记录为视角还是以查看他人记录为视角
	 */
	public function getFleaDetails($urlInfo){
		$feedback = array('status'=>null, 'details'=>null);	//反馈结果
		$p = $urlInfo['params'];
		$opt = $p[1];
		$tc = $p[2];
		$view = $p[3];
		$num = $p[4];
		$start = $p[5];
		$r = null;
		$rs = AiMySQL::queryEntity($opt, array(new AiMySQLCondition('titlecode', '=', $tc)));
		if($rs) foreach ($rs as $r);
		if(!$r)
			$feedback['status'] = 'NOTFOUND';	//无此记录
		else{
			$feedback['status'] = 'SUSCCESS';
			$types = AiMySQL::queryEntity('fleatype', array(new AiMySQLCondition('id', '=', intval($r->fleatypefk))));
			$t=null; if($types) foreach ($types as $t);
			if(!$t)
				$feedback['status'] = 'FLEATYPEEXPT';	//旧货信息存在，但其旧货类型数据异常
			else
				$r->fleatypefk = $t->name;	//将旧货类型外键id替换为其类型名称（用于显示）
			$creusers = AiMySQL::queryEntity('users', array(new AiMySQLCondition('id', '=', intval($r->creuser))));
			$creuser = null; if($creusers) foreach ($creusers as $creuser);
			if(!$creuser)
				$feedback['status'] = 'CREUSEREXPT';	//旧货信息存在，但其发布人数据异常
			else {
				$r->creuser = $creuser->username;	//将旧货信息发布人外键id替换为其用户名称
			}
			switch ($r->status){
				case 1: $r->status='现在还可预约';break;
				case 2: $r->status='已停止预约，等待结束';break;
				case 3: $r->status='无人预约，超时结束';break;
				case 4: $r->status=!strcasecmp($opt, 'sell')?'物主关闭':'买主关闭';break;
				case 5: $r->status=!strcasecmp($opt, 'sell')?'转让完成':'求购完成';break;
				case 6: $r->status='系统结束，但有未完成的交易';
			}
			$feedback['details'] = $r;	//保存旧货类型对象
		}
		$feedback['num'] = $num;
		$feedback['start'] = $start;
		self::setTplArgs($feedback);//设置反馈结果供self/other视图使用
		if(!strcasecmp('self', $view)){
			if(!strcasecmp('sell', $opt))
				require_once OTHER_TEMPLATE_DIR.'zzACE/Assignment/sell/details.php';
			else
				require_once OTHER_TEMPLATE_DIR.'zzACE/Assignment/buy/details.php';
		}else{
			echo "查看其他人的旧货记录";
		}
		// 		print(json_encode($feedback));
	}
	
}