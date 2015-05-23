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
	and f.id = :fid
order by rand()

