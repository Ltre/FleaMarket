<?php

/**
 * 转让表
 * @author fkb
 * @date 2014-1-8
 */

class Sell extends BaseEntity {
	public $title       ;
	public $titlecode   ;
	public $name        ;
	public $fleatypefk  ;
	public $details     ;
	public $price       ;
	public $booklimit   ;
	public $endlimit    ;
	public $creuser     ;
	public $cretime     ;
	public $status      ;
}