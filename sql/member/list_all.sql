/* Selects a list of members who are active.  Hides details such as phone
 * numbers if the member running this query (hide_info) is not allowed to see
 * them.
 *
 * Parameters:
 * hide_info int
 *      1 if the member is not supposed to see information the other members
 *      have marked as private
 * email_private int
 *      The bitmask for the preference to keep email private
 * private int
 *      The bitmask for the preference for all info to be private
 * primary int
 *      The bitmask for the flag that says this item is primary
 */
select
    me.c_uid, 
    me.c_first_name, 
    me.c_last_name,
    case when ({hide_info,int} and (me.c_flags & {email_private,int}))
        then '[private]'
        else me.c_email end as c_email,
    case when (
        ph.c_uid is null 
        or ({hide_info,int} and (ph.c_flags & {private,int})))
        then '[private]'
        else concat(
            '(', ph.c_area_code, ') ', 
            ph.c_exchange, '-', ph.c_number)
        end as phone_number,
    coalesce(ct.c_abbreviation, '') as c_abbreviation,
    case when (ch.c_uid is null) then ""
        when ({hide_info,int} and (ch.c_flags & {private,int})) then ""
        else ch.c_screenname
        end as c_screenname
from 
    [_]member as me
    inner join [_]membership as ms on ms.c_member = me.c_uid
    left outer join [_]phone_number as ph 
        on ph.c_owner = me.c_uid
        and (ph.c_flags & {primary,int})
        and ph.c_deleted <> 1
    left outer join [_]chat as ch
        on ch.c_owner = me.c_uid
        and (ch.c_flags & {primary,int})
        and ch.c_deleted <> 1
    left outer join [_]chat_type as ct on ct.c_uid = ch.c_type
        and ct.c_deleted <> 1
where 
    ({view_inactive,int} > 0 or (
        ms.c_status & {active,int} <> 0
        and now() >= ms.c_begin_date 
        and now() <= ms.c_expiration_date
    ))
    and ({view_private,int} > 0 or (
        me.c_flags & {private,int} = 0
    ))
    and ms.c_deleted <> 1
    and me.c_deleted <> 1
    and ({name,char} is null or me.c_full_name like {name,char})
    and ({email,char} is null or me.c_email like {email,char})
group by me.c_uid
order by {orderby,none,,,0,me.c_last_name}
