-- 获取预订记录（求购）

select 
	b.id		as	id,
	
	b.recordz	as	recordz,
	s.title		as	title,
	
	b.leftuser	as		leftuserid,
	leftuser.username	as	leftuser,
	
	b.rightuser	as	rightuserid,
	rightuser.username	as	rightuser,
	
	b.meettime	as meettime,
	b.meetplace	as meetplace,
	b.purpose	as purpose,
	if(b.booktype='Z','转让','求购') as booktype,
	b.booktime	as	booktime,
	b.status	as	status
from 
	fm_book		as	b,
	fm_buy		as	s,
	fm_users	as	leftuser,
	fm_users	as	rightuser
where
	b.recordz = s.id
	and b.leftuser = leftuser.id
	and b.rightuser = rightuser.id
	and b.booktype = 'Q'
	and (
		b.leftuser = :leftuser
		or b.rightuser = :rightuser
	)