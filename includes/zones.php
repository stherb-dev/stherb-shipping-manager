<?php
if (!defined('ABSPATH')) exit;

function stherb_get_zone($country) {

    // =====================
    // Zone 1 — Asia & Oceania
    // =====================
    $zone1 = [
        'AF','AE','AM','AZ','BD','BH','BN','BT','CN','HK','ID','IL','IN','IQ','IR','JO',
        'JP','KG','KH','KP','KR','KW','KZ','LA','LB','LK','MM','MN','MO','MV','MY','NP',
        'NZ','OM','PH','PK','PS','QA','SA','SG','SY','TH','TJ','TL','TM','TR','TW','UZ',
        'VN','YE','FJ','PG','TO','WS','KI','MH','FM','TV','NR','NU','NC','PF','CK','TK',
        'WF','VU','SB'
    ];

    // =====================
    // Zone 2 — Europe + Africa
    // =====================
    $zone2 = [
        'AL','AD','AT','AX','BA','BE','BG','BY','CH','CY','CZ','DE','DK','EE','ES','FI',
        'FO','FR','GB','GE','GI','GR','HR','HU','IE','IM','IS','IT','JE','LI','LT','LU',
        'LV','MC','MD','ME','MK','MT','NL','NO','PL','PT','RO','RS','RU','SE','SI','SK',
        'SM','UA','VA','XK',

        'DZ','AO','BJ','BF','BW','BI','CM','CV','CF','TD','KM','CG','CD','CI','DJ','EG',
        'ER','ET','GA','GM','GH','GN','GQ','GW','KE','LS','LR','LY','MG','ML','MR','MU',
        'MW','MZ','NA','NE','NG','RW','SC','SD','SL','SN','SO','SS','ST','SZ','TG','TN',
        'TZ','UG','ZA','ZM','ZW','RE','SH','YT','EH'
    ];

    // =====================
    // Zone 3 — America
    // =====================
    $zone3 = [
        'US','CA','MX','AR','BO','BR','CL','CO','EC','FK','GF','GY','PE','PY','SR','UY',
        'VE','AG','AI','AW','BB','BL','BM','BS','BQ','CW','DM','DO','GD','GL','GP','HT',
        'HN','JM','KN','KY','LC','MF','MQ','MS','NI','PA','PM','PR','SV','SX','TC','TT',
        'VC','VG','VI','CR'
    ];

    if (in_array($country, $zone1)) return 1;
    if (in_array($country, $zone2)) return 2;
    if (in_array($country, $zone3)) return 3;

    return null;
}