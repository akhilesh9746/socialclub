select ci.*, st.c_title as st_title
from [_]checkout_item as ci
    inner join [_]status as st on ci.c_status = st.c_uid
where ci.c_item = {item,int}
    and ci.c_deleted <> 1
