select
    at.c_uid as c_attendee,
    me.c_uid as t_member,
    me.c_full_name,
    me.c_email,
    me.c_gender,
    me.c_birth_date,
    count(ab.c_uid) as c_absences
from
    [_]attendee as at
    inner join [_]member as me on at.c_member = me.c_uid
    inner join [_]status as st on at.c_status = st.c_uid
    left outer join [_]absence as ab on ab.c_attendee = at.c_uid
        and ab.c_deleted <> 1
where
    at.c_adventure = {adventure,int}
    and (st.c_title = "active" or st.c_title = "default")
    and at.c_deleted <> 1
    and me.c_deleted <> 1
group by me.c_uid
order by at.c_created_date
