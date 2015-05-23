-- 列出我的联系人
-- 参数：甲方id
select
	u.id as id,
	u.username as username
from
	fm_contacts as c,
	fm_users as u
where
	c.rightuser = u.id
	and c.leftuser = :me;