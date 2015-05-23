-- 随机显示四个查看最多的转让记录
select * from 
(
	select
		ar.id as id,
		ar.recordz as recordz,
		cu.username as username, -- 发布人
		rz.id as rzid,		-- 旧货信息id
		rz.title as title, -- 旧货标题
		rz.titlecode as titlecode, -- 旧货标题编码
		rz.details as details,  -- 旧货信息详情
		f.name as fleatypename, -- 旧货分类名称
		rz.name as rzname,	-- 物品名
		rz.cretime as cretime, -- 旧货发布时间
		ar.recordztype as recordztype,
		ar.accessuserfk as accessuserfk,
		au.username as accessuser, -- 访问人
		ar.accesstime as accesstime,
		count(recordz) as rznum   -- 访问数
	from 
		fm_accessrecord as ar,
		fm_users as au,
		fm_sell as rz,
		fm_users as cu,
		fm_fleatype as f
	where
		ar.accessuserfk = au.id
		and ar.recordz = rz.id
		and rz.creuser = cu.id
		and rz.fleatypefk = f.id
		and ar.recordztype = 'Z'  -- 条件：记录类型
	group by ar.recordz
) as table1
order by rznum asc