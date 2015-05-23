-- 预约转让记录

select 
	b.id as id,
	s.title as title,
	leftuser.name as leftuser,
	rightuser.name as rightuser,
	b.meettime as meettime,
	b.meetplace as meetplace,
	b.purpose as purpost,
	b.booktime as booktime,
	b.status as status
from 
	fm_book as b,
	fm_sell as s,
	fm_users as leftuser,
	fm_users as rightuser
where
	b.recordz=s.id
	and b.leftuser = leftuser.id
	and b.rightuser = rightuser.id