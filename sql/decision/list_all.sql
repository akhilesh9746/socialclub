select
    de.c_uid,
    de.c_title,
    de.c_text,
    ca.c_title as c_category
from [_]decision as de
    inner join [_]decision_category as ca on ca.c_uid = de.c_category
where de.c_deleted <> 1
    and ca.c_deleted <> 1
order by ca.c_title
