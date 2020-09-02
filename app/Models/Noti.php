<?php

namespace App\Models;

use App\Models\Helper;

class Noti extends Helper
{
     protected $table = "noti";


    public static $tasks_type=[
        1=>[
            'type'=>'تعين مسئول عن مربع',
            'msg'=>'لقد تم تعيينك لتكون مسئول عن مربع داخل المزرعه',
        ],
        2=>[
            'type'=>'تعين مسئول عن مرحله الوقايه فى عمليه الغرس',
            'msg'=>'لقد تم تعيينك لتكون مسئول عن عمليه الوقايه فى عمليه الغرس',
        ],
        3=>[
            'type'=>'تعين مسئول عن مرحله الرى فى عمليه الغرس',
            'msg'=>'لقد تم تعيينك لتكون مسئول عن عمليه الرى فى عمليه الغرس',
        ],
        4=>[
            'type'=>'تعين مسئول عن مرحله الرى فى عمليه الانتاج',
            'msg'=>'لقد تم تعيينك لتكون مسئول عن عمليه الرى فى عمليه الانتاج',
        ],
        5=>[
            'type'=>'تعين مسئول عن مرحله الوقايه فى عمليه الانتاج',
            'msg'=>'لقد تم تعيينك لتكون مسئول عن عمليه الوقايه فى عمليه الانتاج',
        ],
        6=>[
            'type'=>'تعين مسئول عن مكافحه مرض معين',
            'msg'=>'لقد تم تعيينك لتكون مسئول عن مكافحه مرض',
        ],
        7=>[
            'type'=>'إرسال عطل جديد',
            'msg'=>'تم إرسال عطل جديد',
        ],
        8=>[
            'type'=>'تعين مسئول عن تجربه ',
            'msg'=>'لقد تم تعيينك لتكون مسئول عن  تجربه ',
        ],
        9=>[
            'type'=>'تعين مهمه جديده ',
            'msg'=>'لقد تم تكليفك بمهمه جديده ',
        ],
    ];

    public static function transform(Noti $items){
        $transaction=new \stdclass();
        $transaction->id=$items->id;
        $transaction->msg=self::$tasks_type[$items->noti_type_id]['msg'];
        $transaction->url_redirect	=$items->url_redirect;
        $transaction->seen	=$items->seen;
        return $transaction;
    }
}
