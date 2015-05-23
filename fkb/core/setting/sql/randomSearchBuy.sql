-- 随便看看——求购
select 
	s.id as id,
	s.titlecode as titlecode,
	s.title as title,
	s.name as name,
	u.username as creuser,
	s.creuser as creuserfk,
	s.cretime as cretime,
	t.name as fleatype,
	s.fleatypefk as fleatypefk
from 
	fm_buy as s,
	fm_users as u,
	fm_fleatype as t
where
	u.id = s.creuser
	and t.id = s.fleatypefk
