<?php

/**
 * 用户表
 * @author fkb
 * @date 2014-1-8
 */

class Users extends BaseEntity {
	public $rolefk      ;
	public $username    ;
	public $password    ;
	public $groupfk     ;
	public $name        ;
	public $gender      ;
	public $sid         ;
	public $email       ;
	public $summary     ;
	public $credit      ;
	public $score       ;
	public $toolspace   ;
}