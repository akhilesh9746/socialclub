select mt.c_title, ms.*
from [_]membership as ms
    inner join [_]membership_type as mt on ms.c_type = mt.c_uid
where ms.c_member = {member,int}
    and (ms.c_status & 4 <> 0)
    and ms.c_deleted <> 1
    and mt.c_deleted <> 1
