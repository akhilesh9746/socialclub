select
    ad.c_uid,
    ad.c_title
from [_]classified_ad as ad
    inner join [_]status as st on st.c_uid = ad.c_status
where st.c_title <> 'inactive'
    and ad.c_deleted <> 1
order by st.c_created_date desc
limit {limit,int}
