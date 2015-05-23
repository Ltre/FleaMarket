<?php

/**
 * 个人关注表
 * @author fkb
 * @date 2014-1-8
 */

class Follow extends BaseEntity {
	public $fleatypefk    ;
	public $keywords      ;
	public $followuserfk  ;
	public $cretime       ;
	public $creuser       ;
}
