-- MySQL does not support subselects as of this version, so to count the items
-- correctly it is necessary to select the checkout_gear into another table and
-- then join against it.
replace into [_]checkout_gear_qty (c_type, c_qty)
    select ty.c_uid, sum(cg.c_qty)
    from [_]item_type as ty
        left outer join [_]checkout_gear as cg
            on ty.c_uid = cg.c_type
            and cg.c_status = {checked_out,int}
            and cg.c_deleted <> 1
    where ty.c_deleted <> 1
    group by ty.c_uid
-- DIVIDER
-- Same with the checkout_item
replace into [_]checkout_item_qty (c_type, c_qty, c_qty_out)
    select ty.c_uid,
    sum(case when (it.c_status = {missing,int}) then 0 else it.c_qty end),
    sum(case when (it.c_status = {checked_out,int}) then it.c_qty else 0 end)
    from [_]item_type as ty
        left outer join [_]item as it
            on it.c_type = ty.c_uid
            and it.c_deleted <> 1
    where ty.c_deleted <> 1
    group by ty.c_uid
-- DIVIDER
select
    ic.c_uid as ic_uid,
    ic.c_title as ic_title,
    ty.c_uid as ty_uid,
    ty.c_title as ty_title,
    ciq.c_qty as existing,
    cgq.c_qty + ciq.c_qty_out as items_out
from [_]item_type as ty
    inner join [_]item_category as ic on ty.c_category = ic.c_uid
    inner join [_]checkout_gear_qty as cgq on cgq.c_type = ty.c_uid
    inner join [_]checkout_item_qty as ciq on ciq.c_type = ty.c_uid
where ty.c_deleted <> 1
    and ic.c_deleted <> 1
order by ic.c_title, ty.c_title
