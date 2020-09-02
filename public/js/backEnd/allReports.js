


var url_data = urls.base_url + "/reports/data_report";



//farm columns
var tableColumnFarm = [
    {data: 'title', name: 'title' },
    {data: 'creation_date', name: 'creation_date' },
    {data: 'location', name: 'location' },
    {data: 'area', name: 'area' },
    {data: 'boxe_count', name: 'boxe_count' },
    {data: 'crop_count', name: 'crop_count' },
    {data: 'crops_in_type_count', name: 'crops_in_type_count' },
    {data: 'faults_count', name: 'faults_count' },
    {data: 'show_report', name: 'show_report' },
];


//irrigation columns
var tableColumnIrrigation= [
     {data: 'code', name: 'code' },
    {data: 'line_type', name: 'line_type' },
    { data: 'title', name: 'title' },
    { data: 'boxs_code', name: 'boxs_code' },
    { data: 'water_amount', name: 'water_amount' },
    {data:'cost',name:'cost'},
    { data: 'lenght', name: 'lenght' },
    { data: 'Mahbs_count', name: 'Mahbs_count' },
    { data: 'irrigation_faults_count', name: 'irrigation_faults_count' },
    { data: 'irrigation_recommendations_count', name: 'irrigation_recommendations_count' },
    { data: 'irrigation_notes_count', name: 'irrigation_notes_count' },
    { data: 'irrigation_resources_count', name: 'irrigation_resources_count' },
    { data: 'signed', name: 'lenght' },
    { data: 'show_report', name: 'show_report' },

 ];



//well columns
var tableColumnWells= [
    {data: 'code', name: 'code' },
    { data: 'title', name: 'title' },
    { data: 'well_status', name: 'well_status' },
    { data: 'date_of_excavation', name: 'date_of_excavation' },
    { data: 'cost', name: 'cost' },
    { data: 'well_fault_count', name: 'well_fault_count' },
    { data: 'well_mainentance_count', name: 'well_mainentance_count' },
    { data: 'signed', name: 'signed' },
    { data: 'show_report', name: 'show_report' },
];


//crops columns
var tableColumnCrops = [
     {data: 'code', name: 'code' },
    { data: 'title', name: 'title' },
    { data: 'date', name: 'date' },
    { data: 'all_crops_in_type.length', name: 'all_crops_in_type' },
    { data: 'crops_name', name: 'crops_name' },
    { data: 'show_report', name: 'show_report' },
];

//materials columns
var tableColumnMatriels = [
    {data: 'code', name: 'code' },
    { data: 'material_type', name: 'material_type' },
    { data: 'title', name: 'title' },
    { data: 'cost', name: 'cost' },
    { data: 'qyt', name: 'qyt' },
    { data: 'material_unit', name: 'material_unit' },
    { data: 'note', name: 'note' },
    { data: 'show_report', name: 'show_report' },
];

//boxes columns
var tableColumnBoxes = [
    {data: 'code', name: 'code' },
    { data: 'row', name: 'row' },
    { data: 'column', name: 'column' },
    { data: 'type_crop_in_box.title', name: 'type_crop_in_box' },
    { data: 'crop_title.length', name: 'crop_title' },
    { data: 'crops_in_box', name: 'crops_in_box' },
    { data: 'size', name: 'size' },
    { data: 'jura_count', name: 'jura_count' },
    { data: 'signed', name: 'signed' },
    { data: 'show_report', name: 'show_report' },
];


//diseases columns
var tableColumndiseasePalmTree = [
    {data: 'plam_tree_id', name: 'plam_tree_id' },
    { data: 'box.code', name: 'box_code' },
    { data: 'disease_name', name: 'disease_name' },
    { data: 'date', name: 'date' },
    { data: 'user.username', name: 'order_date' },
    { data: 'palmDisease_resourcess_count', name: 'palmDisease_resourcess_count' },
    { data: 'show_report', name: 'show_report' },
];


//store columns
var tableColumnStoreRequest = [
    {data: 'code', name: 'code' },
    { data: 'type', name: 'type' },
    { data: 'title', name: 'title' },
    { data: 'QYT', name: 'QYT' },
    { data: 'show_report', name: 'show_report' },
];



$(document).on('click','.report',function (){
    var id=$(this).attr('data-id');
    var modelName=$(this).attr('data-modelName');
    window.location.href="show_report/"+id+"/"+modelName;
});

//show all reports for item using datatable
$(document).ready(function() {
     var model_name=$('#modelName').val();
     var cols='tableColumn'+model_name;
     var url=url_data+'/'+model_name;
    dataTable('reportDatatable', url,eval(cols));
});

