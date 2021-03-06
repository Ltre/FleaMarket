-- 获取最近发布的求购
select *, 
	u.username as username,
	rz.name as rzname,
	rz.id as rzid,
	f.name as fleatypename
from 
	fm_buy as rz,
	fm_fleatype as f,
	fm_users as u
where
	rz.fleatypefk = f.id
	and rz.creuser = u.id
order by rz.cretime desc
