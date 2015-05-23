<?php

/**
 * 系统后台运行的服务
 * @author Oreki
 * @since 2014-4-25
 */

class BackgroundServices {
	/**
	 * 自动更新转让和求购的状态
	 */
	static function updateFleaInfoStatus(){
		$time = OrekiUtil::getCurrentFormatTime();
		$conn = AiMySQL::connect();
		//改为禁预约可交易/无约超时
		$conn->prepare(AiSQL::getSqlExpr('rzstatus/updateSellNone'))->execute(array('rightnow'=>$time));
		$conn->prepare(AiSQL::getSqlExpr('rzstatus/updateSellWait'))->execute(array('rightnow'=>$time));
		$conn->prepare(AiSQL::getSqlExpr('rzstatus/updateBuyNone'))->execute(array('rightnow'=>$time));
		$conn->prepare(AiSQL::getSqlExpr('rzstatus/updateBuyWait'))->execute(array('rightnow'=>$time));
		foreach (array('sell','buy') as $opt){
			//修改转让、求购的完成/结束状态
			$conn->exec("update fm_$opt set status = 5 where endlimit <= '$time' and status = 1");
		}
	}
	
	
}