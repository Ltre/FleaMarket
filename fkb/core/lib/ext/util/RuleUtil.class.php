<?php
class RuleUtil {
	/**
	 * @util
	 * 根据规则编码获取规则值
	 * @param string $itemcode 规则编码
	 * @return Rules $rule 单个规则实体
	 */
	static function getRuleValue($itemcode){
		$c[] = new AiMySQLCondition('itemcode', '=', $itemcode);
		$rules = AiMySQL::queryEntity('rules', $c);
		$rule = null;
		if(false != $rules){
			foreach ($rules as $rule);
		}
		return $rule;
	}
	/**
	 * @invoked UserAction::user_register()
	 * 取规则：个人信用初始值
	 * @return int $rulevalue 规则值
	 */
	static function getRuleInitialCredit(){
		//itemcode=INITIAL_CREDIT，信用的编码
		$rule = self::getRuleValue('INITIAL_CREDIT');
		return $rule ? $rule->rulevalue : 100;
	}
	/**
	 * @invoked UserAction::user_register()
	 * 取规则：个人积分初始值
	 * @return int $rulevalue 规则值
	 */
	static function getRuleInitialScore(){
		//itemcode=INITIAL_SCORE，积分的编码
		$rule = self::getRuleValue('INITIAL_SCORE');
		return $rule ? $rule->rulevalue : 0;
	}
	/**
	 * @invoked UserAction::user_register()
	 * 取规则：个人道具空间上限的初始值
	 * @return int $rulevalue 规则值
	 */
	static function getRuleInitialToolspace(){
		//itemcode=INITIAL_TOOLSPACE，道具空间上限的编码
		$rule = self::getRuleValue('INITIAL_TOOLSPACE');
		return $rule ? $rule->rulevalue : 100;
	}
	
	/**
	 * 根据一对字段及字段值获取某条系统规则
	 * @params string $itemcode
	 * @return 查到结果，返回一个规则对象；查无结果，返回null
	 */
	static function getRuleByField( $field, $value ){
		$c[] = new AiMySQLCondition($field, '=', $value);
		$rs = AiMySQL::queryEntity('rules', $c);
		$r = null;
		if(false != $rs){
			foreach ($rs as $r);
		}
		return $r;
	}
	
}