-- Selects membership types that the current user does not already have.  These
-- are then valid options for renewing.  Flexible membership types are not
-- included, since a member can have many memberships of a flexible type.
-- Parameters: private, flexible, member
select
    mt.c_uid, mt.c_title, mt.c_description, mt.c_begin_date, mt.c_expiration_date, mt.c_total_cost,
    case when (not(mt.c_flags & {flexible,int}) and ms.c_uid is not null)
        then 1
        else 0
    end as already_has
from [_]membership_type as mt
    left outer join [_]membership as ms on mt.c_uid = ms.c_type
        and ms.c_member = {member,int}
        and ms.c_deleted <> 1
where not(mt.c_flags & {private,int})
    and (
        (mt.c_flags & {flexible,int})
        or current_date between mt.c_show_date and mt.c_hide_date
        )
    and mt.c_deleted <> 1
