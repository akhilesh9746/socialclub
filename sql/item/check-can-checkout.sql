select count(*)
from [_]item as it
    left outer join [_]checkout_item as co
        on co.c_item = it.c_uid
        and co.c_checkout = {checkout,int}
        and co.c_deleted <> 1
where it.c_uid = {item,int}
    and it.c_status = {checked_in,int}
    and co.c_uid is null
    and it.c_deleted <> 1
