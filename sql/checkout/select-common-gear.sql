-- Update the checkout quantities
replace into [_]checkout_gear_qty (c_type, c_qty)
    select ty.c_uid, sum(cg.c_qty)
    from [_]item_type as ty
        left outer join [_]checkout_gear as cg
            on ty.c_uid = cg.c_type
            and cg.c_status = {checked_out,int}
            and cg.c_deleted <> 1
    group by ty.c_uid
-- DIVIDER
replace into [_]checkout_item_qty (c_type, c_qty, c_qty_out)
    select ty.c_uid,
    sum(case when (it.c_status = {missing,int}) then 0 else it.c_qty end),
    sum(case when (it.c_status = {checked_out,int}) then it.c_qty else 0 end)
    from [_]item_type as ty
        left outer join [_]item as it
            on it.c_type = ty.c_uid
            and it.c_deleted <> 1
    group by ty.c_uid
-- DIVIDER
select
    ty.c_uid,
    ic.c_title as ic_title,
    ty.c_title as ty_title,
    ciq.c_qty - ciq.c_qty_out - cgq.c_qty as available,
    count(*) as num
from [_]item_type as ty
    inner join [_]item_category as ic on ic.c_uid = ty.c_category
    inner join [_]checkout_gear as cg on cg.c_type = ty.c_uid
    inner join [_]checkout as co on co.c_uid = cg.c_checkout
    inner join [_]checkout_gear_qty as cgq on cgq.c_type = ty.c_uid
    inner join [_]checkout_item_qty as ciq on ciq.c_type = ty.c_uid
where co.c_activity = {activity,int}
    and ic.c_deleted <> 1
    and cg.c_deleted <> 1
    and co.c_deleted <> 1
    and co.c_deleted <> 1
group by ic.c_uid, ic.c_title, ty.c_uid, ty.c_title
order by num desc
