select
    co.c_uid,
    co.c_created_date,
    me.c_first_name,
    me.c_last_name,
    off.c_full_name as officer_name,
    st.c_title as st_title
from [_]checkout as co
    inner join [_]member as me on me.c_uid = co.c_member
    inner join [_]member as off on off.c_uid = co.c_creator
    inner join [_]status as st on st.c_uid = co.c_status
where ({status,int} is null or co.c_status = {status,int})
    and ({member,int} is null or co.c_member = {member,int})
    and co.c_deleted <> 1
    and me.c_deleted <> 1
    and off.c_deleted <> 1
