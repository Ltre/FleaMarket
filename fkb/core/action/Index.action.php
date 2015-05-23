<?php
class IndexAction extends ActionUtil {
	public function index($urlInfo){
		//ActionUtil::action('Help')->help($urlInfo);取消转到help页
		//require_once OTHER_TEMPLATE_DIR.'matrix/matrix.php';
		//$fleatypes = AiMySQL::queryEntity('fleatype', null, AiMySQLCombination::COMB_AND, null, null, 14);//取出14个分类
		$stmt = AiMySQL::connect()->query('select id, name from fm_fleatype limit 14');
		$fleatypes = array();
		while (@$result = $stmt->fetch(PDO::FETCH_OBJ)){
			$fleatypes[] = $result;
		}
		$ta = array(
			'fleatypes' => $fleatypes,	
		);
		$this->tile1($ta, true);
		$this->tile2($ta, true);
		$this->tile3($ta, true);
		$this->tile9($ta, true);
		$this->tile12($ta, true);
		$this->tile13($ta,true);
		$this->tile14($ta, true);
		self::tpl( $ta );
	}
	
	public function index2($urlInfo){
		$stmt = AiMySQL::connect()->query('select id, name from fm_fleatype limit 14');
		$fleatypes = array();
		while (@$result = $stmt->fetch(PDO::FETCH_OBJ)){
			$fleatypes[] = $result;
		}
		$ta = array(
				'fleatypes' => $fleatypes,
		);
		$this->tile1($ta, false);
		$this->tile2($ta, false);
		$this->tile3($ta, false);
		$this->tile9($ta, false);
		$this->tile12($ta, false);
		$this->tile13($ta,false);
		$this->tile14($ta, false);
		self::tpl( $ta );
	}
	
	/**
	 * 磁贴1：最后一个转让
	 * 信息：标题、内容、物品名等等
	 */
	private function tile1( &$ta, $isSell ){
		$table = $isSell ? 'sell' : 'buy';
		$sql = "select *,u.username as username,rz.name as rzname, rz.id as rzid, f.name as fleatypename from fm_$table as rz , fm_fleatype as f, fm_users as u where rz.fleatypefk=f.id and rz.creuser=u.id and rz.id=( select max(id) from fm_$table )";
		$rs = AiMySQL::queryCustom($sql);
		$r = null; if($rs) foreach ($rs as $r);
		$ta['tile1'] = array(
			'status' => 'SUCCESS',
			'result' => $r, //取值例如$r['title']
			'optType'=> $table,
			'href' => '?x=browseFleaDetail|'.$table.'|'.$r['titlecode'], //详情链接
		);
	}
	
	/**
	 * 磁贴2：随机抽取一个分类，并在该分类中随机抽取几条转让/求购记录
	 */
	private function tile2(&$ta, $isSell){
		//随机获取1个分类
		$rs = TableUtil::queryCustom('select id, name from fm_fleatype order by rand() limit 1');
		$r = null; if($rs) foreach ($rs as $r);
		//从该分类中抽取几条记录
		$opt = $isSell?'sell':'buy';
		$sql = AiSQL::getSqlExpr("tiles/tile2_${opt}");
		$rzs = array();//查到的旧货信息集合
		$titles = array();//对应的标题集合
		$hrefs = array();//对应的详情链接集合
		$creusers = array();//对应的发布人集合
		$detals = array();//对应的详情集合
		if($r){
			$rzs = AiMySQL::queryCustomByParams($sql.' limit 5', array('fid'=>$r->id));
			foreach ($rzs as $rz){
				$titles[] = $rz['title'].'［'.($isSell?'转让':'求购').'］';
				$detals[] = $rz['details'];
				$hrefs[] = '?x=browseFleaDetail|'.$opt.'|'.$rz['titlecode'];
				$creusers[] = $rz['username'];
			}
		}
		//将记录数据载入到模板参数
		$ta['tile2'] = array(
			'optType'=> $opt,
			'nums' => count($rzs), //查询到的记录条数（用于循环）
			'msg' => $rzs?'['.$r->name.']分类推荐':'该分类下暂无任何记录。',
			'titles' => $titles,
			'details' => $detals,
			'hrefs' => $hrefs,
			'creusers' => $creusers,
			'fleatype'=> $r?$r->name:'暂无任何分类',
		);
	}
	
	/**
	 * 磁贴3,4,5,7,8：随机的一个分类对应的一个随机旧货信息
	 */
	private function tile3(&$ta, $isSell){
		//随机获取5个分类
		$rs = TableUtil::queryCustom('select id from fm_fleatype order by rand()');
		$len = count($rs);
		$max = 0;
		$params = array(); //参数：旧货分类
		for($i = 0;$i < 5;$i++){
			if($i<$len){
				$max = $i;
			}
			$params[] = $rs[$max]->id; //'f'.($i+1)
		}
		//为这5个分类各取一条记录
		$opt = $isSell?'sell':'buy';
		$sql = AiSQL::getSqlExpr("tiles/tile3_${opt}").' limit 1';
		foreach (array(3,4,5,7,8) as $index=>$value){
			$rs = AiMySQL::queryCustomByParams($sql, array('fid'=>$params[$index]));
			$r = null; if($rs) foreach ($rs as $r);
			if(!$r){
				$ta['tile'.$value] = null;
				continue;
			}
			$ta['tile'.$value] = array(
					'result' => $r, //$r可能为null，列取值例如$r['title']
					'optType'=> $opt,
					'href' => '?x=browseFleaDetail|'.$opt.'|'.$r['titlecode'], //详情链接
			);
		}
	}
	
	/**
	 * 磁贴9,10,11,15：随机显示两个查看最多和两个查看最少的转让|求购记录
	 */
	private function tile9(&$ta, $isSell){
		$opt = $isSell ? 'sell' : 'buy';
		$sql = AiSQL::getSqlExpr("tiles/tile9_${opt}").' limit 2';
		$rs = TableUtil::queryCustom($sql);
		$sqlmin = AiSQL::getSqlExpr("tiles/tile9min_${opt}").' limit 2';
		$rsmin = TableUtil::queryCustom($sqlmin);
		$lenmax = count($rs);
		$lenmin = count($rsmin);
		$len = $lenmax + $lenmin;
		$rs = array_merge($rs, $rsmin);//合并结果
		foreach (array(9,10,11,15) as $index=>$value){
			$r = $index<$len ? $rs[$index] : null;
			$ta['tile'.$value] = array(
				'result' => $r,
				'rzimg' => FleaoptUtil::getFleaImgUrl($r ? $r->rzid : 0, $opt), //旧货信息封面
				'cat' => $r ? '［'.($index<$lenmax?'高人气':'浏览最少').'］'.$r->rzname : '此空位招收广告中',	//左下角显示的文字
				'href' => $r ? '?x=browseFleaDetail|'.$opt.'|'.$r->titlecode : 'javascript:;',
				'title' => $r ? $r->title : '广告商招募中',
				'creuser' => $r ? $r->username : 'SYSTEM', //发布人的用户名
				'details' => $r ? $r->details : '华软旧货市场2014已上线，欢迎各位盆友入驻！！华软旧货市场2014已上线，欢迎各位盆友入驻！！',
			);
		}
	}
	
	/**
	 * 磁贴12：显示最近发布的列表（8条）
	 */
	private function tile12(&$ta, $isSell){
		//随机获取1个分类
		$rs = TableUtil::queryCustom('select id, name from fm_fleatype order by rand() limit 1');
		$r = null; if($rs) foreach ($rs as $r);
		
		//从该分类中抽取几条记录
		$opt = $isSell?'sell':'buy';
		$sql = AiSQL::getSqlExpr("tiles/tile12_${opt}");
		$rzs = array();//查到的旧货信息集合
		$titles = array();//对应的标题集合
		$hrefs = array();//对应的详情链接集合
		$creusers = array();//对应的发布人集合
		$detals = array();//对应的详情集合
		if($r){
			$rzs = AiMySQL::queryCustom($sql.' limit 8');
			foreach ($rzs as $rz){
				$titles[] = $rz['title'].'［'.($isSell?'转让':'求购').'］';
				$hrefs[] = '?x=browseFleaDetail|'.$opt.'|'.$rz['titlecode'];
				$creusers[] = $rz['username'];
			}
		}
		//将记录数据载入到模板参数
		$ta['tile12'] = array(
				'optType'=> $opt,
				'nums' => count($rzs), //查询到的记录条数（用于循环）
				'titles' => $titles,
				'hrefs' => $hrefs,
				'creusers' => $creusers,
		);
	}
	
	/**
	 * 磁贴13：显示货源最多|需求最多的分类，并给出所有分类的链接
	 */
	private function tile13(&$ta, $isSell){
		$opt = $isSell?'sell':'buy';
		//查询货源|需求最多的分类
		$sql = AiSQL::getSqlExpr("tiles/tile13_${opt}");
		$rs = TableUtil::queryCustom($sql);
		$r = null; if($rs) foreach ($rs as $r);
		//查询所有分类
		$fts = TableUtil::queryCustom('select * from fm_fleatype');
		$fleatypes = array();
		$hrefs = array();
		if($fts) foreach ($fts as $ft){
			$fleatypes[] = $ft->name;
			$hrefs[] = "fleatypeSearch|$opt|{$ft->id}|10|0";
		}
		$ta['tile13'] = array(
			'shell' => $r ? "fleatypeSearch|$opt|{$r->fleatypefk}|10|0" : '',
			'fleatype' => $r ? $r->fleatype : '广告位招租中..',
			'fleatypes' => $fleatypes, //所有的分类名称
			'hrefs' => $hrefs, //所有分类的链接
			'num' => count($fts), //所有分类的数量
		);
	}
	
	/**
	 * 磁贴14,16：显示最近发布的两条转让/求购
	 */
	private function tile14(&$ta, $isSell){
		$table = $isSell ? 'sell' : 'buy';
		$sql = "select *,u.username as username,rz.name as rzname, rz.id as rzid, f.name as fleatypename from fm_$table as rz , fm_fleatype as f, fm_users as u where rz.fleatypefk=f.id and rz.creuser=u.id order by cretime desc limit 2";
		$rs = AiMySQL::queryCustom($sql);
		$r = null; if($rs) foreach ($rs as $r);
		foreach (array(14,16)as$index=>$value){
			$r = count($rs)>$index?$rs[$index]:null;
			$ta['tile'.$value] = array(
				'status' => 'SUCCESS',
				'result' => $r, //取值例如$r['title']
				'optType'=> $table,
				'href' => '?x=browseFleaDetail|'.$table.'|'.$r['titlecode'], //详情链接
				'rzimg' => FleaoptUtil::getFleaImgUrl($r ? $r['rzid'] : 0, $table),//旧货信息封面
				'cat' => $r ? '［最近发布］'.$r['rzname'] : '此空位招收广告中',//左下角显示的文字
				'title' => $r ? $r['title'] : '广告商招募中',
				'creuser' => $r ? $r['username'] : 'SYSTEM',//发布人的用户名
				'details' => $r ? $r['details'] : '华软旧货市场2014已上线，欢迎各位盆友入驻！！华软旧货市场2014已上线，欢迎各位盆友入驻！！',
			);
		}
	}
	
	
}