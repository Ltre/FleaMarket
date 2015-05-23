<?php

/**
 * 消息表
 * @author fkb
 * @date 2014-1-8
 */

class Message extends BaseEntity {
	public $msgtype   ;
	public $title	  ;
	public $contents  ;
	public $sender    ;
	public $receiver  ;
	public $isread    ;
	public $sendtime  ;
}