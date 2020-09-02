<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    protected static $lang;
    public function __construct(array $attributes = []){
        if(!isset($_COOKIE['Lang_Admin'])){
            self::$lang='en';
        }else{
            self::$lang=$_COOKIE['Lang_Admin'];
        }
    }
    public static function transformCollection($items, $type =null){
        $transformers = array();
        if($type==null){
            $transform = 'transform';
        }else{
            $transform = 'transform'.$type;
        }
         if (count($items)) {
             foreach ($items as $item) {
                //  dd($item);
                  $transformers[] = self::$transform($item);
             }
         }
        //  dd($transformers);
         return $transformers;
    }

    public static $project_moduels=[
        1=>'مزارع',
        2=>'مربعات',
        3=>' المحصول',
        4=>'معدات',
        5=>'اصول ثابته',
        6=>'شبكة الري',
        7=>'خامات',
        8=>'ابار',
        9=>'المستخدمين',
        10=>'الوظائف',
        11=>'الصلاحيات',
        12=>'well_tec_specification',
        13=>'الابار',
        14=>'مربعات',
        15=>'شبكه الرى',
        16=>'تجهيز الجوره',
        17=>'عمليات الغرس',
        18=>'الكيب',
        19=>'رى',
        20=>'تسميد',
        21=>'الوقايه',
        22=>'فصل الفسائل',
        23=>'الحصاد',
        24=>'عمليات مستديمه',
        25=>'طاقم عمل (مؤقت)',
        26=>'طاقم عمل (دائم)',
        27=>'رصيد المخزن',
        28=>'المطلوب من المخزن',
        29=>'التجارب',
        30=>'الاعطال',
        31=>'تعيين مهمه',
        32=>'تكلفه المربعات',
        33=>'التكلفه العامه',
        34=>'الموسم السابق',
        35=>'الموسم الحالى',
        36=>'الموسم القادم',
        37=>'الامراض',
        38=>'الامراض الحاليه',
        39=>'سجل الامراض',
        40=>'سجل الفاقد',
        41=>'التقارير',
        42=>'اوامر التوريد',
    ];
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

  // columns that appear in reports view
    public static $report_columns_name=[

        'Farm'=>[
            'الاسم',
            'تاريخ الانشاء',
            'الموقع',
            ' المساحه (فدان)  ',
            'عدد المربعات',
            'عدد المحاصيل',
            'عدد الاصناف',
            'عدد الاعطال',
            'عرض التقرير',
        ],
        'Matriels'=>[
            'كود الخامه',
            'النوع',
            'الاسم',
            'السعر',
            'الكمية',
            'وحدة القياس',
            'تفاصيل الخامة',
            'عرض التقرير',
        ],
        'Crops'=>[
            'كود المحصول',
            'اسم المحصول',
            'تاريخ الاضافه',
            'عدد الاصناف',
            'اسماء الاصناف',
            'عرض التقرير',
        ],
        'Irrigation'=>[
            'كودالخط',
            'نوع الخط',
            'الاسم',
            'المربعات التى يمر بها',
            'كميه المياه',
            'التكلفه',
            'الطول',
            'عدد المحابس',
            'عدد الاعظال',
            'عدد التوصيات',
            'عدد الملاحظات ',
            'عدد موارد العمليات ',
            'التوقيع',
            'عرض التقرير',
        ],
        'Boxes'=>[
            'كود المربع',
            'الصف',
            'العمود',
            'المحصول',
            'عدد الاصناف ',
            'الاصناف',
            'مقاس المربع',
            ' عدد الجوره',
            'التوقيع',
            'عرض التقرير',
        ],
        'Wells'=>[
            'كود البير',
            'الاسم',
            'الحاله',
            'تاريخ الحفر',
            'التكلفه',
            'عدد الاعطال', // show  faults for this beer
            'عدد الصيانه', //show maintenance for this beer
            'التوقيع',
            'عرض التقرير',
//            'توصيات' //show last recomandation
        ],
        //display palm diseases
        'diseasePalmTree'=>[
            'كود النخله المصابه',
            'فى المربع',
            'اسم المرض',
            'تاريخ الاصابه',
            ' المكافحه بواسطه',
            'عدد موارد العمليات ',
            'عرض التقرير',
        ],
       //store
         'StoreRequest'=>[
            'كود',
            'النوع ',
            'الاسم',
            'الكمية الحالية	',
            'عرض التقرير',
        ],



    ];

    //general report
    public function general_report($modelname,$cost=true,$file,$modelname_ar){
        $model_name = '\App\Models\\'.$modelname;
        $model = new $model_name;
        if($modelname=='Crops'){
            $result=$model::whereNull('crop_id')->get();
        }
        else {
            $data = $model::all();
            $result=$model::transformCollection($data,'report');
        }
        $count=count($result);
        $total_cost=null;
        $model_file=null;
        //calculate cost for model
        if($cost=='true') {
            foreach ($result as $value) {
                $total_cost +=preg_replace("/([^0-9\\.])/i", "", $value->cost) ;
            }
        }
        //get general file for model if exists
        if($file){
            $model_file=\DB::table('config')->where('name',$file)->select('value')->first();
        }
        $html='<p class="report_count">'.  " عدد$modelname_ar : $count  ".'</p>';
        if($modelname=='Crops'){
            $crop_count=$model::whereNotNull('crop_id')->count();
            $html.='<span class="report_count"> عدد الاصناف فى المزرعه : '.$crop_count.'  </span> ';
        }

        if(!empty($total_cost)){
            $html.='<span class="report_cost">    التكلفه الكليه  ' . $modelname_ar  .' : '  .' '.$total_cost  .'</span>';
        }
        if($file && $model_file){
                $path = asset('public/images/Uploads/config/' . $model_file->value);
                $html .= '<a  class="report_file"  href=' . $path . '>' . ' الملف العام لل  ' . $modelname_ar . ' ' . '</a>';

        }

        $result=['html'=>$html,'total_cost'=>$total_cost,'count'=>$count,'irrigation_file'=>$model_file];
        return $result;
    }


}
