
-- 获取预订详细（转让）
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
	case b.status
		when 0 then '被甲方拒绝'
		when 1 then '待甲方确认'
		when 2 then '预约达成'
		END as statusvalue,
	b.status as status

from
	fm_book as b,
	fm_sell as rz,
	fm_fleatype as f,	
	fm_users as cu, -- creuser
	fm_users as lu,	-- leftuser
	fm_users as ru	-- rightuser

where
	b.recordz = rz.id	-- 转让记录
	and rz.creuser = cu.id -- 转让的发布人
	and rz.fleatypefk = f.id -- 旧货分类
	and b.leftuser = lu.id -- 甲方
	and b.rightuser = ru.id -- 乙方
