select count(distinct ci.c_uid) + count(distinct cg.c_uid) as count
from [_]checkout as co
    left outer join [_]checkout_item as ci
        on ci.c_checkout = co.c_uid
        and ci.c_status = {checked_out,int}
        and ci.c_deleted <> 1
    left outer join [_]checkout_gear as cg
        on cg.c_checkout = co.c_uid
        and cg.c_status = {checked_out,int}
        and cg.c_deleted <> 1
where co.c_uid = {checkout,int}
    and co.c_deleted <> 1
group by co.c_uid
