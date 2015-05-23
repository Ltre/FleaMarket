-- 获取自己的收藏列表
-- 参数：收藏人id

select 
	c.id as id,
	c.collecttype as collecttype,
	c.recordz as recordz,
	rz.title as title,
	rz.titlecode as titlecode,
	rz.name as rzname,
	rz.fleatypefk as fleatypefk,
	fl.name as fleatype,
	rz.price as price,
	rz.creuser as rzcreuserid,
	rzu.username as rzcreuser,	-- 转让信息发布人
	rz.status as rzstatus,
	c.cretime as cretime,	-- 收藏时间
	c.creuser as creuserid,
	u.username as creuser		-- 收藏人
from
	fm_collect as c,
	fm_sell as rz,
	fm_fleatype as fl,
	fm_users as rzu,	-- 转让信息发布人
	fm_users as u	-- 收藏人

where
	c.recordz = rz.id
	and rz.fleatypefk = fl.id
	and rz.creuser = rzu.id
	and c.creuser = u.id
	and c.creuser != rz.creuser  -- 不显示自己收藏自己的内容
	and c.creuser = :creuser -- 收藏人
	
union

(

select 
	c.id as id,
	c.collecttype as collecttype,
	c.recordz as recordz,
	rz.title as title,
	rz.titlecode as titlecode,
	rz.name as rzname,
	rz.fleatypefk as fleatypefk,
	fl.name as fleatype,
	rz.price as price,
	rz.creuser as rzcreuserid,
	rzu.username as rzcreuser,	-- 求购信息发布人
	rz.status as rzstatus,
	c.cretime as cretime,	-- 收藏时间
	c.creuser as creuserid,
	u.username as creuser		-- 收藏人
from
	fm_collect as c,
	fm_buy as rz,
	fm_fleatype as fl,
	fm_users as rzu,	-- 求购信息发布人
	fm_users as u	-- 收藏人

where
	c.recordz = rz.id
	and rz.fleatypefk = fl.id
	and rz.creuser = rzu.id
	and c.creuser = u.id
	and c.creuser != rz.creuser  -- 不显示自己收藏自己的内容
	and c.creuser = :creuser -- 收藏人
)