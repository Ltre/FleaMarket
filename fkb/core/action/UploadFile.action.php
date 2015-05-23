<?php

/**
 * 文件上传模块
 * @author Oreki
 * @since 2014-5-8
 */

class UploadFileAction extends ActionUtil{
	
	/**
	 * 上传旧货封面图片
	 * 指令参数：操作类型（sellinfo|buyinfo）
	 */
	public function upimg($u){
		$opt = $u['params'][1];
		$ta = array(
			'upimgdir' => "../public/res/img/$opt/",//上传保存的目录
			'opt' => $opt,
		);
		self::tpl($ta);
	}
	
	/**
	 * 上传头像
	 * 指令参数：用户id
	 */
	public function upavatar($u){
		self::tpl(array(
			'id' => $u['params'][1],
			'upimgdir' => "../public/res/img/userinfo/",//上传保存的目录
		));
	}
	
}