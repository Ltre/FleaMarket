<?php

/**
 * 交易表
 * @author fkb
 * @date 2014-1-8
 */

class Trade extends BaseEntity {
	public $bookfk     ;
	public $tradetype  ;
	public $goods      ;
	public $lefttime   ;
	public $righttime  ;
	public $status     ;
}