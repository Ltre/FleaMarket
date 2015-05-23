<?php

/**
 * 规则表
 * @author Oriki
 * @date 2014-1-8
 */

class Rules extends BaseEntity {
	public $name        ;
	public $itemcode    ;
	public $rulevalue   ;
	public $rulecode    ;
	public $unitfk      ;
	public $actiontype  ;
	public $actionscope	;
}