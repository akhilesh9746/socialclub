select
    me.c_full_name,
    me.c_email,
    ad.c_uid,
    ad.c_owner,
    ad.c_created_date,
    ad.c_title,
    ad.c_text
from [_]classified_ad as ad
    inner join [_]member as me on me.c_uid = ad.c_owner
    inner join [_]status as st on st.c_uid = ad.c_status
where st.c_title <> 'inactive'
    and ad.c_deleted <> 1
    and me.c_deleted <> 1
order by ad.c_created_date desc
