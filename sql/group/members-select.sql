select me.*
from [_]member_group as mg
    inner join [_]member as me on mg.c_member=me.c_uid
where mg.c_related_group = {group,int,,,0}
    and mg.c_deleted <> 1
    and me.c_deleted <> 1
order by me.c_last_name, me.c_first_name
