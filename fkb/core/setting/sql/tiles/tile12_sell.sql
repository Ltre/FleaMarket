-- 获取最近发布的转让
select *, 
	u.username as username,
	rz.name as rzname,
	rz.id as rzid,
	f.name as fleatypename
from 
	fm_sell as rz,
	fm_fleatype as f,
	fm_users as u
where
	rz.fleatypefk = f.id
	and rz.creuser = u.id
order by rz.cretime desc
