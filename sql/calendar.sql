select
    ad.c_start_date,
    ad.c_end_date,
    ad.c_title,
    ad.c_description,
    ad.c_uid
from [_]adventure as ad
inner join [_]status as st on st.c_uid = ad.c_status
where ((ad.c_start_date >= {start,date,,,0} and ad.c_start_date <= {end,date,,,0})
    or (ad.c_end_date >= {start,date,,,0} and ad.c_end_date <= {end,date,,,0}))
    and st.c_title = 'active'
    and ad.c_deleted <> 1
order by ad.c_start_date
