select
    es.*,
    coalesce(sum(ex.c_amount), 0.00) as total,
    st.c_title as status_title,
    me.c_full_name
from [_]expense_submission as es
    left outer join [_]expense_submission_expense as ese on es.c_uid = ese.c_submission
        and ese.c_deleted <> 1
    left outer join [_]expense as ex on ex.c_uid = ese.c_expense
        and ex.c_deleted <> 1
    inner join [_]member as me on me.c_uid = es.c_owner
    inner join [_]status as st on es.c_status = st.c_uid
where
    ({status,int} is null or es.c_status = {status,int})
    and ({begin,date} is null or es.c_created_date >= {begin,date})
    and ({end,date} is null or es.c_created_date <= {end,date})
    and es.c_deleted <> 1
    and me.c_deleted <> 1
group by es.c_uid
