select
    me.c_full_name,
    co.c_title,
    st.c_title as status_title,
    itn.*
from [_]item_note as itn
    inner join [_]member as me on itn.c_creator = me.c_uid
    inner join [_]condition as co on co.c_uid = itn.c_condition
    inner join [_]status as st on st.c_uid = itn.c_status
where c_item = {item,int}
    and itn.c_deleted <> 1
    and me.c_deleted <> 1
    and co.c_deleted <> 1
order by itn.c_created_date
