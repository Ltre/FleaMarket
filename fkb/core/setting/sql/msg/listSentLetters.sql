-- 获取已发送私信的列表
-- 参数：发送人
select 
	m.id as id,
	m.title as title,
	m.receiver as erid, -- receiverid 接收人id
	u.username as er, -- receiver 接收人
	m.sendtime as sendtime
from 
	fm_message as m,
	fm_users as u
where
	m.msgtype = 2
	and m.sender = :me
	and m.receiver = u.id
order by m.sendtime desc 