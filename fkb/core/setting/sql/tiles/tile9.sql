-- 随机显示四个查看最多的转让/求购记录
select * from 
(
	select
		ar.id as id,
		ar.recordz as recordz,
		ar.recordztype as recordztype,
		ar.accessuserfk as accessuserfk,
		au.username as accessuser, -- 访问人
		ar.accesstime as accesstime,
		count(recordz) as rznum   -- 访问数
	from 
		fm_accessrecord as ar,
		fm_users as au
	where
		ar.accessuserfk = au.id
		and ar.recordztype = 'Z'  -- 条件：记录类型
	group by ar.recordz
) as table1
order by rznum desc