select
    ad.c_uid,
    ad.c_title
from [_]classified_ad as ad
where (ad.c_status & 4 <> 0)
    and ad.c_deleted <> 1
order by ad.c_created_date desc
limit {limit,int}
