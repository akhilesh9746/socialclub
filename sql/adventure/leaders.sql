-- Gets a list of everyone who has ever led an adventure
select
    distinct me.c_uid, c_full_name
from [_]member as me
    inner join [_]adventure as ad on ad.c_owner = me.c_uid
    inner join [_]status as st on ad.c_status = st.c_uid
where st.c_title = 'active'
    and ad.c_deleted <> 1
    and me.c_deleted <> 1
order by me.c_last_name, me.c_first_name
