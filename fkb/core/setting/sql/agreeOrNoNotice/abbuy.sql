-- 获取同意/拒绝预约的通知（求购）
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
	rz.titlecode as titlecode
from 
	fm_book as b,
	fm_users as lu,
	fm_users as ru,
	fm_buy as rz
where 
	b.leftuser = lu.id
	and b.rightuser = ru.id
	and b.recordz = rz.id
	and b.id = :id