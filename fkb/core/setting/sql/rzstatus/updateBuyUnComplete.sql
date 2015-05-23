-- @弃用
-- 查询在剩余交易期耗尽后，尚未完成所有交易的求购记录，并将这些记录的状态更改为6（系统结束）
-- 参数：
-- 		rightnow	当前时间

update fm_buy set status=6 where id in

(
	select table1.rzid from

	(
		select 
			rz.id as rzid, count(b.id) as bcount 
		from 
			fm_buy as rz, fm_book as b
		where 
			b.recordz = rz.id and rz.endlimit <= :rightnow
		group by rz.id
	) as table1,

	(
		select 
			rz.id as rzid , count(t.id) as tcount from fm_buy as rz, fm_book as b, fm_trade as t
		where 
			t.bookfk = b.id and b.recordz = rz.id and b.booktype='Q' and t.tradetype='Q' and rz.endlimit <= :rightnow
		group by rz.id
	) as table2

	where
		count(table2.rzid) = 0 
		or
		(
			table1.bcount != table2.tcount
			and table1.rzid=table2.rzid
		)
		
)


-- -------------------原语句 ---------------------------------------
--	update fm_sell set status=5 where id in
--	
--	(
--		select table1.rzid from
--	
--		(
--			select 
--				rz.id as rzid, count(b.id) as bcount 
--			from 
--				fm_sell as rz, fm_book as b
--			where 
--				b.recordz = rz.id and rz.endlimit <= '2014-8-25'
--			group by rz.id
--		) as table1,
--	
--		(
--			select 
--				rz.id as rzid , count(t.id) as tcount from fm_sell as rz, fm_book as b, fm_trade as t
--			where 
--				t.bookfk = b.id and b.recordz = rz.id and b.booktype='Z' and t.tradetype='Z' and t.status in (3,6,7,8) and rz.endlimit <= '2014-8-25'
--			group by rz.id
--		) as table2
--	
--		where 
--			table1.bcount = table2.tcount
--			and table1.rzid=table2.rzid
--			
--	)
