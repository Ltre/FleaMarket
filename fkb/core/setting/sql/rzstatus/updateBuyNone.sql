-- 查询处于剩余交易期内、且没有任何预约的求购记录，并将其状态改为3（无人预约已超时）
update fm_buy set status = 3
where booklimit <= :rightnow and endlimit > :rightnow and id not in
(
	select recordz from fm_book where booktype='Q'
)
