select
    ms.*, mt.c_title, st.c_title as st_title
from [_]membership as ms
    inner join [_]membership_type as mt on mt.c_uid = ms.c_type
    inner join [_]status as st on ms.c_status = st.c_uid
where ms.c_member = {member,int}
    and ms.c_deleted <> 1
    and mt.c_deleted <> 1
order by c_begin_date
