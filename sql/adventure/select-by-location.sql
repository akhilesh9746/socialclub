select ad.*
from [_]adventure as ad
where c_destination = {destination,int,,,0,c_destination}
    and (ad.c_status & {active,int} = {active,int})
    and ad.c_deleted <> 1
