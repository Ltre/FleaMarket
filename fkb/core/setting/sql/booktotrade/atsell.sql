-- 获取达成预约，提醒交易的通知（转让）
-- 参数：预约id
select
	b.id as id,
	b.leftuser as leftuserid,
	b.rightuser as rightuserid,
	lu.username as leftuser,
	ru.username as rightuser,
	b.booktime as booktime,
	b.recordz as recordz,
	rz.title as title,
	rz.titlecode as titlecode,
	t.id as tid,
	t.tradetype as tradetype
from 
	fm_book as b,
	fm_users as lu,
	fm_users as ru,
	fm_sell as rz,
	fm_trade as t
where 
	b.leftuser = lu.id
	and b.rightuser = ru.id
	and b.recordz = rz.id
	and t.bookfk = b.id
 	and b.id = :id