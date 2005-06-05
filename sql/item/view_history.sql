select *
from [_]checkout_item
where c_item = {item,int}
    and c_deleted <> 1
