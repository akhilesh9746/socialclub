select *
from [_]membership_type as mt
where not(mt.c_flags & {private,int})
    and (
        (mt.c_flags & {flexible,int})
        or current_date between mt.c_show_date and mt.c_hide_date
        )
    and mt.c_deleted <> 1
