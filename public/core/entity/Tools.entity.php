<?php

/**
 * 道具表
 * @author fkb
 * @date 2014-1-8
 */

class Tools extends BaseEntity {
	public $name            ;
	public $toolcode        ;
	public $details         ;
	public $rulefk          ;
	public $authorityfk     ;
	public $weight          ;
	public $price           ;
	public $uselimit        ;
	public $uselimitunitfk  ;
	public $userate         ;
	public $userateunitfk   ;
	public $initialstock    ;
	public $stock           ;
	public $stocklimit      ;
	public $refreshcycle    ;
	public $refreshunitfk	;
}