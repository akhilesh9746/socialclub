select
    at.c_uid,
    case when(at.c_status = {waitlisted,int}) then 'W' else 'J' end as c_status,
    at.c_joined_date,
    at.c_member,
    me.c_full_name,
    me.c_birth_date,
    me.c_email,
    me.c_gender,
    count(distinct ab.c_uid) as c_absences,
    count(distinct wa.c_uid) as c_waitlists
from [_]attendee as at
    inner join [_]member as me on at.c_member = me.c_uid
    -- join in attendees marked absent
    left outer join [_]attendee as abat on abat.c_member = me.c_uid
        and abat.c_deleted <> 1
    left outer join [_]absence as ab on ab.c_attendee = abat.c_uid
        and ab.c_deleted <> 1
    -- join in attendees that are waitlisted
    left outer join [_]attendee as wa on wa.c_member = at.c_member
        and wa.c_status = {waitlisted,int}
        and wa.c_uid <> at.c_uid
        and wa.c_deleted <> 1
where
    at.c_adventure = {adventure,int}
    and at.c_deleted <> 1
    and me.c_deleted <> 1
    and ({status,int} is null or at.c_status = {status,none})
group by me.c_uid
order by at.c_joined_date
