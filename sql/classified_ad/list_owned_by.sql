select
    ad.c_uid,
    ad.c_created_date,
    ad.c_title,
    st.c_title as c_status
from [_]classified_ad as ad
    inner join [_]status as st on st.c_uid = ad.c_status
where ad.c_owner = {member,int}
    and ad.c_deleted <> 1
