select mt.c_title, ms.*
from [_]membership as ms
    inner join [_]membership_type as mt on ms.c_type = mt.c_uid
    inner join [_]status as st on ms.c_status = st.c_uid
where ms.c_member = {member,int}
    and st.c_title = "inactive"
    and ms.c_deleted <> 1
    and mt.c_deleted <> 1
