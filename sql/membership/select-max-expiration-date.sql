-- Find the max date of the member's currently active memberships. If
-- there are none, use today's date.
select
    coalesce(max(c_expiration_date), current_date) as max_date
from [_]membership as ms
    inner join [_]status as st on ms.c_status = st.c_uid
where ms.c_member = {member,int}
    and st.c_title = "active"
    and ms.c_deleted <> 1
