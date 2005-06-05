select
    ch.c_uid as T_CHAT,
    ch.c_screenname as C_SCREENNAME,
    ty.c_title as C_TYPE,
    ty.c_abbreviation as C_ABBREVIATION,
    case when (ch.c_flags & 512 <> 0) then 1 else 0 end as private
from [_]chat as ch
    inner join [_]chat_type as ty on ch.c_type = ty.c_uid
where ch.c_owner = {member,int}
    and ch.c_deleted <> 1
    and ty.c_deleted <> 1
