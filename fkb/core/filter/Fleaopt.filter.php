<?php

/**
 * 旧货操作的过滤器
 * @author Oriki
 * @since 2014-3-25
 */

class FleaoptFilter {
	/**
	 * 查看单条旧货信息的详情
	 * 如果是以查看自己记录为视角，则需要登录
	 * 如果是以查看他人记录为视角，则不需要登录
	 */
	public function getFleaDetails(){
		$view = $_SESSION['urlInfo']['params'][3];
		if(!strcasecmp('self', $view)){
			if(! isset($_SESSION['user'])){
				require_once OTHER_TEMPLATE_DIR . 'ace/login.php';
				exit;//记住要终止脚本
			}
		}
	}
	
	/**
	 * 判断是否有发布/编辑旧货信息的权限
	 */
	public function pageToCreateFleaInfo(){
		$id = $_SESSION['user']->id;
		$t = $_SESSION['urlInfo']['params'][1];
		$titlecode = $_SESSION['urlInfo']['params'][2];
		$optcode = 'PSL';//权限代码
		switch ($t){
			case 'newsell':break;
			case 'newbuy':$optcode='PBL';break;
			case 'editsell':$optcode='MSL';break;
			case 'editbuy':$optcode='MBL';break;
		}
		$sql = "select * from fm_userauthority as ua, fm_authority as a where ua.authority = a.id and userfk = $id and a.optcode = '$optcode'";
		if( 0 == count( TableUtil::queryCustom($sql) ) ){ 
			
			if (get_magic_quotes_gpc())
				$t = stripslashes($t);
			$operation = ('newsell'==$t||'newbuy'==$t ?'发布':'编辑').(false!==strpos($t, 'sell')?'转让':'求购').'信息';
			$tplArgs = array(
					//class=page_content指定的正文区域内容（自定义内容）
					'page_content'	=>	'ace/dontAccessIt.php',
					//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
					'ace_js'	=>	'ace/fleaopt/pageToCreateFleaInfo/jstag.php',
					//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
					'ace_css'	=>	'ace/fleaopt/pageToCreateFleaInfo/csstag.php',
					//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
					'ace_inline'=>	'ace/fleaopt/pageToCreateFleaInfo/injs.php',
					//自定义的外挂js
					'javascript'=>	'res/js/pageToCreateFleaInfo.js',
					'action'	=>	'旧货信息操作',	//所在的模块
					'operation'	=>	$operation,	//所在的功能
					//具体模板的专用参数，结构自己定义
					'args'		=>	array(
						'msg' => '你没有权限'.$operation.'，或被管理员禁止.<br>要恢复使用，请联系管理员。',
					),
			);
			FleaoptAction::setTplArgs( $tplArgs );
			require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
			exit;
			
		}
	}
	
	
	/**
	 * 判断是否有权限删除旧货信息
	 */
	public function delFleaInfo(){
		$feedback = array(
				'status' => null,
				'msg' => null,
		);
		$p = $_SESSION['urlInfo']['params'];
		$opt = $p[1];
		$tc = $p[2];
		$userfk = $_SESSION['user']->id;
		$isSell = !strcasecmp('sell', $opt);
		$optcode = $isSell ? 'DSL' : 'DBL';
		$sql = "select * from fm_userauthority as ua, fm_authority as a where ua.authority = a.id and userfk = $userfk and a.optcode = '$optcode'";
		if( 0 == count( TableUtil::queryCustom($sql) ) ){
			$feedback['status'] = 'NOAUTHORITY';
			$feedback['msg'] = '你没有权限删除'.($isSell?'转让':'求购').'信息，或被管理员禁止。要恢复使用，请联系有关部门';
			print(json_encode($feedback));
			exit;
		}
	}
	
	
	
}