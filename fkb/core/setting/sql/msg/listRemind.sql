-- 显示自己收到的提醒列表
-- 参数：接收人，是否已读

select 
	m.id as id,
	m.msgtype as msgtype,
	case m.msgtype
		when 4 then '预约'
		when 5 then '交易'
		when 7 then '关注'
		when 8 then '收藏'
		end as msgtypevalue,
	m.title as title,
	m.receiver as receiver,
	m.isread as isread,
	m.sendtime as sendtime
from 
	fm_message as m
where
	m.msgtype in (4,5,7,8) -- 预定、交易、关注、收藏
	and m.receiver = :me
	and m.isread = :isread
order by m.sendtime desc