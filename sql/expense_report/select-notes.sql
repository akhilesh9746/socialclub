select
    me.c_full_name,
    st.c_title as status_title,
    exn.*
from [_]expense_report_note as exn
    inner join [_]member as me on exn.c_creator = me.c_uid
    inner join [_]status as st on st.c_uid = exn.c_new_status
where c_report = {report,int}
    and exn.c_deleted <> 1
    and me.c_deleted <> 1
order by exn.c_created_date
