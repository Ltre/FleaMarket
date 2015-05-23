-- 获取某条消息的详细
-- 参数：id
select 
	m.id as id,
	m.msgtype as msgtype,
	m.title as title,
	m.contents as contents,
	m.sender as senderid,
	us.username as sender,
	m.receiver as receiverid,
	ur.username as receiver,
	m.isread as isread,
	m.sendtime as sendtime
from
	fm_message as m,
	fm_users as us,
	fm_users as ur
where
	m.sender = us.id
	and m.receiver = ur.id
  and m.id = :id