select
    de.c_uid,
    de.c_title
from [_]decision as de
    inner join [_]decision_xref as xr on de.c_uid = xr.c_xref
where xr.c_decision = {decision,int}
    and xr.c_deleted <> 1
    and de.c_deleted <> 1
