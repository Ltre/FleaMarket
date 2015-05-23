-- 获取得到交易结果的通知（转让）
-- 参数：交易id
select
	t.id as id,
	b.leftuser as leftuserid,
	b.rightuser as rightuserid,
	lu.username as leftuser,
	ru.username as rightuser,
	b.booktime as booktime,
	b.recordz as recordz,
	rz.title as title,
	rz.titlecode as titlecode,
	b.id as bid,
	t.tradetype as tradetype,
	case t.status 
		when 0 then '等待完成'
		when 1 then '等待完成'
		when 2 then '等待完成'
		when 3 then '交易成功'
		when 4 then '等待完成'
		when 5 then '等待完成'
		when 6 then '交易失败'
		when 7 then '交易失败'
		when 8 then '交易失败'
		END as statusvalue,
	t.status as status	-- 交易确认状态
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
 	and t.id = :id