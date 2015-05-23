<?php
/**
 * 与数据表有关的实用类
 * @author Oriki
 * @since 2014-3-28
 */

class  Tableutil {
	
	/**
	 * 新增删除，通过id删除
	 * @param  在指定的tabel中 删除的实体
	 * @return boolean 插入成功则返回true
	 */
	public static function delete_id($table,$id){
		$conn = self::connect();
		$conn -> beginTransaction();
		$affect = $conn -> exec("delete from ".self::$table_prefix."$table where id = " . $id . ";");
		$conn -> commit();
		//echo $affect ? '删除成功' : '没有删除';
		return $affect ? true : false;
	}
	
	/**
	 * AiMySQL::update()的改良方法，采用SQL预处理，用于更新一条数据
	 * @param BaseEntity $entity
	 */
	static function update_with_prepare(BaseEntity $entity){
		$conn = AiMySQL::connect();
		$conn->beginTransaction();
		$table = strtolower( get_class($entity) );//从实体中取表名
		$expr = null;
		$preprms = array();//SQL预处理参数数组
		foreach ( get_object_vars($entity) as $name => $value ){
			if(null===$value) continue;//如果该字段没被赋初始值
			$expr .= $name.' = :'.$name.',';
			$preprms[$name] = $value;
		}
		$expr = trim($expr, ',');
		$presql = "update ".AiDBConfiguration::$table_prefix."$table set $expr where id = ".$entity->id;
		$stmt = $conn->prepare($presql);
		$affect = $stmt->execute($preprms);
		$conn->commit();
		return $affect;//BOOL
	}
	
	/**
	 * 根据条件筛选记录，并在结果集中取第一条记录中某个字段的值
	 * @invoked 多处调用
	 * @param string $table 去除前缀的表名
	 * @param string $dest 目标字段名（必须与实体类中的成员命名完全对应）
	 * @param array(AiMySQLCondition) $conditions 筛选条件的集合
	 * @return mixed 返回目标字段的值，失败时返回false。	<br>
	 * 		如果所取字段是boolean类型，则该方法无法判别是否成功获取到数值。
	 */
	static function getValueFromField($table, $dest, $conditions){
		$rs = AiMySQL::queryEntity($table, $conditions);
		$r = null;
		if($rs) foreach ($rs as $r);
		return $r ? $r->$dest : false;
	}
	//
	static function queryCustom($preSql, array $params = array(), $num=0, $start=0, $fetchtype=PDO::FETCH_OBJ){
		$List = array();
		$conn = AiMySQL::connect();
		if(0>$num) $num=0;
		if(0>$start) $start=0;
		$flag = false;
		if($num){
			$preSql .= " limit $start,$num";
		}else{
			$flag = true;
		}
		$stmt = $conn->prepare($preSql);
		$stmt->execute($params);
		$i = 0;
		while( @$result = $stmt -> fetch($fetchtype)){
			if($flag){
				if($i >= $start){
					$List[] = $result;
				}
			}else{
				$List[] = $result;
			}
			$i ++;
		}
		return $List;
	}
}
?>