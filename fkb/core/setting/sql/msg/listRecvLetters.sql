-- 显示自己收到的私信列表
-- 参数：接收人，是否已读

select 
	m.id as id,
	m.title as title,
	m.sender as erid,  -- senderid 发送人id
	u.username as er,  -- sender 发送人
	m.sendtime as sendtime
from 
	fm_message as m,
	fm_users as u
where
	m.msgtype = 2
	and m.receiver = :me
	and m.isread = :isread
	and m.sender = u.id
order by m.sendtime desc