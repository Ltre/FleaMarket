-- 货源最多的分类
select
	f.name as fleatype,
	rz.fleatypefk as fleatypefk,
	count(rz.id) as num
from 
	fm_sell as rz,
	fm_fleatype as f
where
	rz.fleatypefk = f.id
group by rz.fleatypefk
order by num desc
limit 1