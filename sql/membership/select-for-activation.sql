select
    me.c_uid,
    me.c_first_name,
    me.c_last_name,
    case when (date_add(me.c_birth_date, interval 18 year) > ms.c_created_date)
        then 1 else 0 end as c_underage, 
    ms.c_uid as membership_uid,
    ms.c_type,
    mt.c_title,
    ms.c_total_cost,
    ms.c_begin_date,
    ms.c_expiration_date
from [_]member as me
    inner join [_]membership as ms on ms.c_member = me.c_uid
    inner join [_]membership_type as mt on ms.c_type = mt.c_uid
    inner join [_]status as st on st.c_uid = ms.c_status
where st.c_title = 'inactive'
    and ms.c_expiration_date > current_date
    and me.c_deleted <> 1
    and ms.c_deleted <> 1
    and mt.c_deleted <> 1
order by me.c_last_name, me.c_first_name
