-- 获取自己的联系人集合
select 
	c.id as id,
	c.leftuser as leftuserid,
	l.username as leftuser,
	c.rightuser as rightuserid,
	r.username as rightuser,
	c.cretime as cretime
from
	fm_contacts as c,
	fm_users as l,
	fm_users as r
where
	c.leftuser = l.id
	and c.rightuser = r.id
	and c.leftuser = :leftuser