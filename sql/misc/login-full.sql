select 
    me.c_uid as c_uid,

    -- Whether the person entered the correct password
    case when (
        me.c_password = {password,char,30}
        )
    then 1
    else 0
    end as password_correct,

    -- Total number of memberships for the member
    count(ms.c_uid) as total,
    -- Total number of activated memberships that have begun and not yet expired
    -- for this member.  These are memberships that will allow the member to log
    -- in.
    sum(
        case when (
            ms.c_uid is not null
            and st.c_title = 'active'
            and ms.c_begin_date <= current_date
            and ms.c_expiration_date >= current_date
            )
        then 1
        else 0
        end
    ) as valid,

    -- Total number of expired memberships for the member.  These are
    -- memberships that have been activated but the expiration date has
    -- passed.
    sum(
        case when (
            ms.c_uid is not null and ms.c_expiration_date < current_date
        )
        then 1
        else 0
        end
    ) as expired,

    -- Total number of inactive memberships for the member.  These are
    -- memberships that are either inactive or the begin date has not yet
    -- arrived.
    sum(
        case when (
            ms.c_uid is not null and (
                st.c_title = 'inactive' and ms.c_expiration_date > current_date
            )
        )
        then 1
        else 0
        end
    ) as pending,

    current_timestamp

from [_]member as me
    left outer join [_]membership as ms on me.c_uid = ms.c_member
        and ms.c_deleted <> 1
    left outer join [_]status as st on ms.c_status = st.c_uid
where me.c_email = {email,char,60}
    and me.c_deleted <> 1
group by me.c_uid
