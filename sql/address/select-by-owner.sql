select
    me.c_full_name,
    me.c_uid as t_member,
    ad.c_title,
    ad.c_uid as t_address,
    case when (ad.c_flags & fl.c_bitmask) then 'Y' else 'N' end as c_primary
from
    [_]address as ad
    inner join [_]member as me on me.c_uid = ad.c_owner
    inner join [_]flag as fl on fl.c_title = "primary"
where ad.c_owner = {owner,int,,,0,c_owner}
    and ad.c_deleted <> 1
    and me.c_deleted <> 1
order by {orderby,none,,0,me.c_last_name}
