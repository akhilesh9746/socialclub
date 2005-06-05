select
    me.c_full_name,
    at.c_uid as t_attendee,
    at.c_created_date
from
    [_]attendee as at
    inner join [_]member as me on at.c_member = me.c_uid
where
    at.c_adventure = {adventure,int}
    and (ad.c_status & 16 <> 0)
    and at.c_deleted <> 1
    and me.c_deleted <> 1
order by at.c_created_date
