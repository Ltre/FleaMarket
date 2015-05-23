<?php

/**
 * 违规处理表
 * @author fkb
 * @date 2014-1-8
 */

class FoulPunish extends BaseEntity {
	public $name            ;
	public $fopucode        ;
	public $userfk          ;
	public $punishstylefk   ;
	public $dealuserfk      ;
	public $reason          ;
	public $starttime       ;
	public $endtime			;
}