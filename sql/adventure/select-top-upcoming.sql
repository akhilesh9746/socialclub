select
    ad.c_uid,
    ad.c_title,
    ad.c_start_date, 
    lo.c_title as loc_title,
    lo.c_uid as loc_uid,
    sum(
        case when (ir.c_uid is null) then 0 else 1 end
    ) as fav
from [_]adventure as ad
    inner join [_]location as lo on ad.c_destination = lo.c_uid
    left outer join [_]adventure_activity as aa on aa.c_adventure = ad.c_uid
        and aa.c_deleted <> 1
    left outer join [_]interest as ir on ir.c_activity = aa.c_activity
        and ir.c_member = {member,int}
        and ir.c_deleted <> 1
where (ad.c_status & {active,int} = {active,int})
    and c_start_date > current_date
    and ad.c_deleted <> 1
    and lo.c_deleted <> 1
group by ad.c_uid
order by ad.c_start_date
limit {number,int}
