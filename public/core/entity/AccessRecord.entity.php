<?php

/**
 * 访问记录表
 * @author fkb
 * @date 2014-1-8
 */

class AccessRecord extends BaseEntity {
	public $fleatypefk     ;
	public $recordztype    ;
	public $recordz        ;
	public $tobeuserfk     ;
	public $accesstime     ;
	public $accessuserfk   ;
}