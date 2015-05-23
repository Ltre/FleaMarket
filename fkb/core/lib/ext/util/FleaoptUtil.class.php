<?php
/**
 * 与旧货信息操作有关的实用类
 * @author Oriki
 * @since 2014-3-18
 */
class FleaoptUtil {
	/**
	 * 计算预定期的结束时间
	 * @param datestring $cretime 发布时间
	 * @return datestring $booklimit 预订结束时间YYYY-mm-dd HH:ii:ss
	 */
	static function calcBookLimit( $cretime ){
		//获取预定期时长
		$limit = 7;//时长默认值
		$r = RuleUtil::getRuleByField('itemcode', 'YDQSC');
		if($r) $limit = $r->rulevalue;
		$limitunit = 'DAY';//时长默认计量单位
		$u = null;
		$us = AiMySQL::queryEntity('unit', array(0=>new AiMySQLCondition('id', '=', $r->unitfk)));
		if($us) foreach ($us as $u);
		if($u) $limitunit = $u->unitcode;
		switch ($limitunit) {
			case 'HOUR':
				$cretime = getdate(strtotime($cretime)+$limit*3600);
				break;
			case 'MINIUTE':
				$cretime = getdate(strtotime($cretime)+$limit*60);
				break;
			case 'DAY': ;
			default:
				$cretime = getdate(strtotime($cretime)+$limit*3600*24);
		}
		return $cretime['year'].'-'.$cretime['mon'].'-'.$cretime['mday'].' '.$cretime['hours'].':'.$cretime['minutes'].':'.$cretime['seconds'];
	}
	/**
	 * 计算剩余交易期的结束时间
	 * @param datestring $booktime 预订结束时间
	 * @return datestring $endlimit 预订结束时间YYYY-mm-dd HH:ii:ss
	 */
	static function calcEndLimit( $booktime ){
		//获取剩余交易期时长
		$limit = 7;//时长默认值
		$r = RuleUtil::getRuleByField('itemcode', 'SYJYQSC');
		if($r) $limit = $r->rulevalue;
		$limitunit = 'DAY';//时长默认计量单位
		$u = null;
		$us = AiMySQL::queryEntity('unit', array(0=>new AiMySQLCondition('id', '=', $r->unitfk)));
		foreach ($us as $u);
		if($u) $limitunit = $u->unitcode;
		switch ($limitunit) {
			case 'HOUR':
				$booktime = getdate(strtotime($booktime)+$limit*3600);
				break;
			case 'MINIUTE':
				$booktime = getdate(strtotime($booktime)+$limit*60);
				break;
			case 'DAY': ;
			default:
				$booktime = getdate(strtotime($booktime)+$limit*3600*24);
		}
		return $booktime['year'].'-'.$booktime['mon'].'-'.$booktime['mday'].' '.$booktime['hours'].':'.$booktime['minutes'].':'.$booktime['seconds'];
	}
	
	
	/**
	 * 获取旧货封面链接	<br>
	 * @invoked 旧货详细页面调用
	 * @param string $opt 转让或求购，值：sell|buy
	 * @param int $id 旧货信息id
	 * @return string 图片所在位置，如../public res/img/sellinfo/1.jpg
	 */
	static function getFleaImgUrl($id, $opt){
		$prefix = '../public/res/img/'.$opt.'info/';
		$null = '';
		if(21<=$id%31 && $id%31<=30)
			//如果没有封面图，且余数是21到30，则暂时给无图片的分配内置图片null.jpg，出现这种图片的几率为三分之一
			$null = $prefix . $opt.'null.jpg';
		else
			//如果没有封面图，则暂时给无图片的分配内置图片（20张中的一张），出现这种图片的几率为三分之二，当做有封面（骗人的！！）
			$null = $prefix . ($id%20+1) . '.jpg';
		$flag = false;
		$img = '';
		foreach (array('jpg','jpeg','png','gif') as $ext){
			$img = $prefix . $id . '.' . $ext;
			$flag = file_exists($img);
			if($flag) break;
		}
		return $flag ? $img : $null;
		//return $flag ? $img : ($prefix . ($id%20+1) . '.jpg'); //如果没有封面图，则暂时给无图片的分配内置图片（20张中的一张）
	}
	
}