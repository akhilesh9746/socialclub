-- You may need to refresh the _qty tables depending
-- on whether you need the 'available' column
select
    cat.c_uid as cat_uid,
    cat.c_title as cat_title,
    it.c_uid,
    it.c_title,
    ciq.c_qty - ciq.c_qty_out - cgq.c_qty as available
from [_]item_type as it
    inner join [_]item_category as cat on cat.c_uid = it.c_category
    left outer join [_]checkout_gear_qty as cgq on cgq.c_type = it.c_uid
    left outer join [_]checkout_item_qty as ciq on ciq.c_type = it.c_uid
where ({cat,int} is null or it.c_category = {cat,int})
    and it.c_deleted <> 1
    and cat.c_deleted <> 1
order by cat_title, it.c_title
