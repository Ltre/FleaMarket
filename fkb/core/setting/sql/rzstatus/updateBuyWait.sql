-- 查询处于剩余交易期内、且有预约的求购记录，并将其状态改为2（禁约定可交易）
update fm_buy set status = 2
where booklimit <= :rightnow and endlimit > :rightnow and id in
(
	select recordz from fm_book where booktype='Q'
)
