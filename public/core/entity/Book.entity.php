<?php

/**
 * 预订表
 * @author fkb
 * @date 2014-1-8
 */

class Book extends BaseEntity {
	public $recordz    ;
	public $leftuser   ;
	public $rightuser  ;
	public $meettime   ;
	public $meetplace  ;
	public $purpose    ;
	public $booktype   ;
	public $booktime   ;
	public $status     ;
}