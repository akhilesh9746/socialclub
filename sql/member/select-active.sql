select
    me.c_uid, me.c_last_name, me.c_first_name
from [_]member as me
    inner join [_]membership as ms on ms.c_member = me.c_uid
    inner join [_]status as st on ms.c_status = st.c_uid
where st.c_title = 'active'
    and me.c_deleted <> 1
    and ms.c_begin_date <= current_date
    and ms.c_expiration_date >= current_date
    and ms.c_deleted <> 1
group by me.c_uid
order by me.c_last_name, me.c_first_name
