-- Select the number of days remaining until the member needs to renew.
select
    to_days(coalesce(max(c_expiration_date), current_date)) - to_days(current_date) as days_left
from [_]membership as ms
where ms.c_member = {member,int}
    and ms.c_deleted <> 1
