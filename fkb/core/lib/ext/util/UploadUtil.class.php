<?php
/**
 * 文件上传相关的实用类
 * @author Oreki
 *
 */
class UploadUtil {
	
	/**
	 * 保存旧货信息的封面
	 * @param BaseEntity $flea 旧货信息实体
	 * @param string $tmpimgpath 图片上传时的临时路径名 
	 * @return boolean 复制成功或失败
	 */
	public static function savefleaimg($flea, $tmpimgpath){
		$table = strtolower(get_class($flea));
		$id = TableUtil::getValueFromField($table, 'id', array(new AiMySQLCondition('titlecode', '=', $flea->titlecode)));
		$status = copy($tmpimgpath, "../public/res/img/{$table}info/$id.jpg");
		if($status)
			unlink($tmpimgpath);
		return $status;
	}
	
	/**
	 * 保存头像
	 * @param BaseEntity $flea 用户实体
	 * @param string $tmpimgpath 图片上传时的临时路径名
	 * @return boolean 复制成功或失败
	 */
	public static function saveheadimg($user, $tmpimgpath){
		$table = strtolower(get_class($user));
		$id = TableUtil::getValueFromField($table, 'id', array(new AiMySQLCondition('username', '=', $user->username)));
		$status = copy($tmpimgpath, "../public/res/img/userinfo/$id.jpg");
		if($status)
			unlink($tmpimgpath);
		return $status;
	}
	
	
}