select
    it.c_status,
    ci.c_uid
from [_]item as it
    left outer join [_]checkout_item as ci on ci.c_item = it.c_uid
        and (ci.c_status & {checked_out,int} = {checked_out,int})
where it.c_uid = {item,int}
    and it.c_deleted = 0
