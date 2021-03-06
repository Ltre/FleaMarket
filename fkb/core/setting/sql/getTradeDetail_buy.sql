
-- 获取交易详细（求购）
-- 可用于生成列表

select 
	b.id as id,
	b.recordz as recordz,
	rz.titlecode as titlecode, -- 标题编码
	rz.title as title,	-- 标题
	rz.fleatypefk as fleatypefk,	-- 旧货类型id
	rz.details as details,	-- 旧货信息明细
	f.name as fleatype,	-- 旧货类型名称
	rz.creuser as creuserfk,	-- 发布人id
	cu.username as creuser,	-- 发布人用户名
	b.leftuser as leftuserfk,	-- 甲方id
	lu.username as leftuser,	-- 甲方
	b.rightuser as rightuserfk,	-- 乙方id
	ru.username as rightuser,	-- 乙方
	b.meettime as meettime,	
	b.meetplace as meetplace,
	case b.purpose 
		when 1 then "交易" 
		when 2 then "看货"
		when 3 then "两者皆可"
		when 4 then "暂未确定"
		END as purposevalue,	-- 目的的显示值
	b.purpose as purpose,	-- 预约目的
	case b.booktype
		when 'Z' then '转让'
		when 'Q' then '求购'
		END as booktypevalue,
	b.booktype as booktype,
	b.booktime as booktime,
	case t.tradetype
		when 'Z' then '转让'
		when 'Q' then '求购'
		END as tradetypevalue,
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
	fm_buy as rz,
	fm_fleatype as f,	
	fm_users as cu, -- creuser
	fm_users as lu,	-- leftuser
	fm_users as ru,	-- rightuser
	fm_trade as t

where
	b.recordz = rz.id	-- 求购记录
	and rz.creuser = cu.id -- 求购的发布人
	and rz.fleatypefk = f.id -- 旧货分类
	and b.leftuser = lu.id -- 甲方
	and b.rightuser = ru.id -- 乙方
	and t.bookfk = b.id
