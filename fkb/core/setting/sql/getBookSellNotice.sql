-- 获取预订转让品的通知
select 
	b.id as id,	-- 预定表id
	rz.title as title, 
	rz.name as name, -- 物品名
	rz.titlecode as titlecode, 
	u.username as username,	-- 乙方
	u.id as uid 	-- 乙方
from 
	fm_book as b, 
	fm_sell as rz, 
	fm_users as u 
where 
	b.rightuser=u.id 
	and b.recordz=rz.id 
	and rz.id = :recordz
	and b.rightuser=:me 
	and b.leftuser=:leftuser