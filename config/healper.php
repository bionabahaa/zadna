<?php
/*
| some Arrays and variable to All System
*/
// All Language
$Language=array(
    'ar'=>'Arabic',
    'en'=>'English',
    'fr'=>'French',
    'ge'=>'German',
    'sp'=>'Spanish',
    'ru'=>'Russian',
    'it'=>'Italian',
    'tu'=>'Turkish',
);
////////////////////////////////////
$setting=[
    'police'=>'Police',
    'about'=>'About us',
    'vission'=>'Our vission',
    'mission'=>'Our mission',
    'phones'=>'Phones',
    'locations'=>'Locations',
    'mediaUrl'=>'Media Urls',
    'seo'=>'SEO',
];
////////////////////////////////////
// All System Color
$color=array('red','pink','purple','deep-purple','indigo','blue','light-blue','cyan','teal','green','light-green','lime','yellow','amber','orange','deep-orange','brown','grey','blue-grey','black');
///////////////////////////////////
// All social media for login in system
$social=array(
    'Facebook'=>'label-primary',
    'Twiiter'=>'label-info',
    'Google plus'=>'label-danger',
    'LinkedIn'=>'bg-blue',
    'Gethub'=>'label-default',
);
///////////////////////////////////
// All social media in system
$socialLinks=array(
    'Facebook'=>'label-primary',
    'Twiiter'=>'label-info',
    'Google plus'=>'label-danger',
    'LinkedIn'=>'bg-blue',
    'Gethub'=>'label-default',
    'WhatsApp'=>'label-success',
);
//////////////////////////////////
// All client type in system
$clientType=array(
    0=>'Client',
    1=>'Delegate',
    2=>'Strore Owner',
);
//////////////////////////////////
// All cart type in system
$cartType=array(
    1=>'Waiting',
    2=>'Preparing',
    3=>'On The way',
    4=>'Done',
    5=>'Cancelled',
);
//////////////////////////////////
// Moduels Permissions
$moduelsPermissions=array(
    1=> ['name'=>'Open','value'=>"Open"],
    2=> ['name'=>'View','value'=>"View"],
    3=> ['name'=>'Edit','value'=>"Edit"],
    4=> ['name'=>'active_block','value'=>"Active/Block"],
    5=> ['name'=>'Delete','value'=>"Delete"],
    6=> ['name'=>'Upload','value'=>"Upload Files"],
    7=> ['name'=>'Download','value'=>"Download Files"],
    8=> ['name'=>'open_gallery','value'=>"Open gallery"],
    9=> ['name'=>'manage_gallery','value'=>"Manage gallery"],
);
//////////////////////////////////
// Moduels Permissions
$moduelsOperations=array(
    1=> ['name'=>'add_new','value'=>"Add New"],
    2=> ['name'=>'show_all','value'=>"Show table record"],
    3=> ['name'=>'edit_data','value'=>"Edit Data"],
    4=> ['name'=>'active_block','value'=>"Active/Block"],
    5=> ['name'=>'delete_one','value'=>"Delete one Record"],
    6=> ['name'=>'delete_many','value'=>"Delete many Record"],
    7=> ['name'=>'download_file','value'=>"Download Files"],
    8=> ['name'=>'upload_file','value'=>"Upload Files"],
);
//////////////////////////////////
$moduelsConfigs=array(
    0=>[
        'name'=>'is_visiable',
        'value'=>'Is Visiable ?'
    ],
    1=>[
        'name'=>'has_shareSocialMedia',
        'value'=>'Has social Media Shareing ?'
    ],
    2=>[
        'name'=>'is_main',
        'value'=>'Is Main ?'
    ],
    3=>[
        'name'=>'has_share',
        'value'=>'Has Share Content ?'
    ],
    4=>[
        'name'=>'has_like',
        'value'=>'Has Like Content ?'
    ],
    5=>[
        'name'=>'has_favorite',
        'value'=>'Has Favorite Content ?'
    ],
    6=>[
        'name'=>'has_comment',
        'value'=>'Has Comment ?'
    ],
    7=>[
        'name'=>'has_recomment',
        'value'=>'Has Re_comment ?'
    ],
    8=>[
        'name'=>'has_rate',
        'value'=>'Has Rate ?'
    ],
    10=>[
        'name'=>'has_gallery',
        'value'=>'Has Gallery ?'
    ],
    11=>[
        'name'=>'country_related',
        'value'=>'Related With Country ?'
    ],
    12=>[
        'name'=>'category_related',
        'value'=>'Related With Category ?'
    ],
    13=>[
        'name'=>'client_related',
        'value'=>'Related With Client ?',
        'field'=>7,
        'field_value'=>$clientType,
    ],
    14=>[
        'name'=>'has_map',
        'value'=>'Has Location ?'
    ],
    15=>[
        'name'=>'has_icone',
        'value'=>'Has Image ?'
    ],
);
//////////////////////////////////
$packages=[
    'Country'=>[1=>'No',2=>'Yes'],
    'Cart'=>[1=>'No',2=>'Yes'],
    'Contact_us'=>[1=>'No',2=>'Yes'],
    'Client'=>[1=>'No',2=>'Yes'],
    'Category'=>[1=>'No',2=>'Yes'],
    'Tracking_system'=>[1=>'No',2=>'Yes'],
    'Breadcrums'=>[1=>'No',2=>'Yes'],
    'Notifications'=>[1=>'No',2=>'Yes'],
];
//////////////////////////////////
// All input type in system
/*
0=> default  ,  1=> moduel related
*/
$inputType=array(
    1=> ['name'=>'Text','type'=>0],
    2=> ['name'=>'Number','type'=>0],
    3=> ['name'=>'Hidden','type'=>0],
    4=> ['name'=>'Email','type'=>0],
    5=> ['name'=>'Select','type'=>1],
    6=> ['name'=>'multiSelect','type'=>1],
    7=> ['name'=>'radioButtin','type'=>1],
    8=> ['name'=>'checkBox','type'=>1],
    9=>['name'=>'textArea','type'=>0],
    10=>['name'=>'Editor','type'=>0],
    11=> ['name'=>'Date','type'=>0],
    12=> ['name'=>'Image','type'=>0],
    13=> ['name'=>'Password','type'=>0],
);
//////////////////////////////////
$inputValidation=array(
    1=>['name'=>'Required','value'=>[]],
    2=>['name'=>'Number','value'=>[]],
    3=>['name'=>'Unique','value'=>[]],
    4=>['name'=>'Email','value'=>[]],
    5=>['name'=>'Date','value'=>[]],
    6=>['name'=>'Length','value'=>['Max'=>'number','Min'=>'number']],
);
$inputConfig=array(
    1=>['name'=>'Put In DataTable','value'=>'in_table'],
    2=>['name'=>'Related To Translation','value'=>'translation'],
);

//////////////////////////////////
$reportOption=array(
    1=>['name'=>'pdf','value'=>'Print Pdf ?'],
    2=>['name'=>'excel','value'=>'Print Excel ?'],
    3=>['name'=>'copy','value'=>'Has Copy ?'],
    4=>['name'=>'F_user','value'=>'Filter By user ?'],
    5=>['name'=>'F_date','value'=>'Filter By DateTime ?'],
    6=>['name'=>'F_status','value'=>'Filter by status ?'],
    7=>['name'=>'F_type','value'=>'Filter by type ?'],
);
//////////////////////////////////
return [
    'sys_language'=>$Language,
    'sys_color'=>$color,
    'sys_social'=>$social,
    'sys_clientType'=>$clientType,
    'sys_cartType'=>$cartType,
    'sys_inputType'=>$inputType,
    'sys_inputValidation'=>$inputValidation,
    'sys_moduelsPermissions'=>$moduelsPermissions,
    'sys_moduelsConfigs'=>$moduelsConfigs,
    'sys_moduelsOperations'=>$moduelsOperations,
    'sys_packages'=>$packages,
    'sys_setting'=>$setting,
    'sys_reportOption'=>$reportOption,
    'sys_socialLinks'=>$socialLinks,
    'sys_inputConfig'=>$inputConfig,
];