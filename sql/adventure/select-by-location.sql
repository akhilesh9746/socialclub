select ad.*
from [_]adventure as ad
    inner join [_]status as st on ad.c_status = st.c_uid
where c_destination = {destination,int,,,0,c_destination}
    and st.c_title = "active"
    and ad.c_deleted <> 1
