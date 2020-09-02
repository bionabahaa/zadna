<?php
/*
    Provided By "Ayman Bassiony" / php Developer
    - This Controller has many function php help any developer php laravel
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use File;
use Image;
use Storage;
use Validator;
use App;
use Datatables;
use DB;

class HelperController extends Controller
{
    // Files
    public function check_file($filename){
        if (File::isFile($filename)){
            return 'file';
        }else{
            if (File::isDirectory($filename)){
                return 'dir';
            }
        }
        return false;
    }
    public function get_files_in_folder($filename,$by_name=true,$folder_path,$exc=''){
        if(!$by_name){
            $result = File::glob($folder_path.'*.log'.$exc);
            if ($result){
                return $result;
            }
        }else{
            $result = File::allFiles($folder_path);
            if ($result){
                return $result;
            }
        }
        
        return false;
    }
    public function create_folder($directory){
        if(Storage::makeDirectory($directory)){
            return true;
        }
        return false;
    }
    public function get_folder($directory,$all=true){
        if($all){
            $result = Storage::allDirectories($directory);
        }else{
            $result = Storage::directories($directory);
        }
        return $result;
    }
    public function delete_folder($directory){
        if(Storage::deleteDirectory($directory)){
            return true;
        }
        return false;
    }
    public function create_file($directory,$fileName){
        if (Storage::putFileAs('text', new File($directory), $fileName)){
            return true;
        }
        return false;
    }
    public function data_file($file_path){
        $result['type']=File::type($filename);
        $result['size']=File::size($filename);
        $result['lastModified']=File::lastModified($filename);
        return $result;
    }
    public function read_content_file(){}
    public function delete_file($file_path){
        if(Storage::delete($file_path)){
            return true;
        }
        return false;
    }
    public function write_in_file($path,$content,$start=true){
        if($start){
            if(Storage::prepend($path, $content)){
                return true;
            }
        }else{
            if(Storage::append($path, $content)){
                return true;
            }
        }
        return false;
    }
    public function move_file($new_path,$old_path){
        if(Storage::move($old_path, $new_path)){
            return true;
        }
        return false;
    }
    public function download_file(){}
    public function upload_file(){}
    public function zip_files(){}
    public function un_zip_file(){}
    //Images
    public function uploadImage($req,$image_file,$folder,$base64=false){
        if(!$base64){
            // if ($req->file($image_file)->isValid()) {
                $image = $req->file($image_file);
                if(is_array($image)){
                    $count=1;
                    foreach($image as $file){
                        $filename  = time() .$count. '.' . $file->getClientOriginalExtension();
                        if(!File::exists(public_path('/images/Uploads/'.$folder))){
                        File::makeDirectory(public_path('/images/Uploads/'.$folder));
                        File::makeDirectory(public_path('/images/Uploads/'.$folder.'/Small'));
                        }
                        $path = public_path('/images/Uploads/'.$folder.'/' . $filename);
                        $path_small = public_path('/images/Uploads/'.$folder.'/Small/' . $filename);
                        Image::make($file->getRealPath())->save($path);
                        Image::make($file->getRealPath())->resize(200, 200)->save($path_small);
                        $files[]=$filename;
                        $count++;
                    }
                    return implode(',',$files);
                }else{
                    $filename  = time() . '.' . $image->getClientOriginalExtension();
                    if(!File::exists(public_path('/images/Uploads/'.$folder))){
                    File::makeDirectory(public_path('/images/Uploads/'.$folder));
                    File::makeDirectory(public_path('/images/Uploads/'.$folder.'/Small'));
                    }
                    $path = public_path('/images/Uploads/'.$folder.'/' . $filename);
                    $path_small = public_path('/images/Uploads/'.$folder.'/Small/' . $filename);
                    Image::make($image->getRealPath())->save($path);
                    Image::make($image->getRealPath())->resize(200, 200)->save($path_small);
                    return $filename;
                }
            // }
        }else{
            $image = $req->$image_file;
            
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            if(!File::exists(public_path('/images/Uploads/'.$folder))){
                File::makeDirectory(public_path('/images/Uploads/'.$folder));
                File::makeDirectory(public_path('/images/Uploads/'.$folder.'/Small'));
            }
            $path = public_path('/images/Uploads/'.$folder.'/' . $filename);
            $path_small = public_path('/images/Uploads/'.$folder.'/Small/' . $filename);
            Image::make(file_get_contents($image))->save($path);
            Image::make(file_get_contents($image))->resize(200, 200)->save($path_small);
            return $filename;
        }
        return false;
    }
    public function resizeImage($path,$width,$height,$x=25,$y=25){
        $img = Image::make($path);
        $img->crop($width, $height, $x, $y);
        return true;
    }
    public function watermarkImage($image_path,$watermark_path,$position='bottom-right',$x=0,$y=0){
        $img = Image::make($image_path);
        $watermark = Image::make($watermark_path);
        $img->insert($watermark_path,$position,$x,$y);
        return true;
    }
    public function deleteImage($image_path){
        $path=public_path('images/Uploads/').$image_path;
        if (file_exists($path)) {
            unlink($path);
        }
        return true;
    }
    public function uploadFile($file_name,$folder){
            $targetfolder = "testupload/";
            $fileName = basename($_FILES[$file_name]['name']);

               if (!File::exists(public_path('/images/Uploads/' . $folder))) {
                   File::makeDirectory(public_path('/images/Uploads/' . $folder));
               }
               $path = public_path('/images/Uploads/' . $folder . '/' . str_replace(' ','',$fileName) );
               if (move_uploaded_file($_FILES[$file_name]['tmp_name'], $path)) {
                   return $fileName;
               } else {
                   return false;
               }


    }
    // Map
    public function Get_Address_From_Google_Maps($lat, $lon,$lang='en') {
		if($lat=='' || $lon==''){
			if ($this->session->userdata('language')) {
				if($this->session->userdata('language')=='en'){
					return 'Anonymous place';
				}else{
					return 'المكان غير معروف';
				}
		    }else{
				return 'المكان غير معروف';
			}
		}
		  $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&key=AIzaSyBUyHUMEdN1Fjbj4z8Ig8MZIxl9meBW2Go&language=$lang";
		$ch = curl_init();  
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$output=curl_exec($ch);
		curl_close($ch);
		$jsondata = json_decode($output,true);
		return $jsondata["results"][0]["formatted_address"];
    }
    public function distance($lat1, $lon1, $lat2, $lon2,$type=2) {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$lon1."&destinations=".$lat2.",".$lon2."&mode=driving&language=pl-PL";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);
        if(isset($response_a['rows'][0]['elements'][0]['distance'])){
            $dist = $response_a['rows'][0]['elements'][0]['distance']['value'];
        $dist2=$dist/1000;
        if($type==2){
            if($dist2 < 1){
                return $dist.'M';
            }else{
                return ceil($dist2).'Km';
            }
        }
        }else{
            $dist=0;
        }
        // $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

        return $dist;
    }
    public function get_LatLon(){
		$getloc = json_decode(file_get_contents("http://ipinfo.io/"));
		return explode(",",$getloc->loc);
	}
    // String
    // Number
    public function random($length = 8) {
		$chars = '654165191584841813685468480840656346084684046840850';
		$result = '';
		for ($p = 0; $p < $length; $p++) {
			$result .= ($p % 2) ? $chars[mt_rand(19, 23)] : $chars[mt_rand(0, 18)];
		}

		return $result;
	}
    // Array
    public function sortArray($array, $key, $sort_flags = SORT_REGULAR,$order = SORT_DESC){
        if (is_array($array) && count($array) > 0) {
          if (!empty($key)) {
              $mapping = array();
              foreach ($array as $k => $v) {
                  $sort_key = '';
                  if (!is_array($key)) {
                      $sort_key = $v[$key];
                  } else {
                      // @TODO This should be fixed, now it will be sorted as string
                      foreach ($key as $key_key) {
                          $sort_key .= $v[$key_key];
                      }
                      $sort_flags = SORT_STRING;
                  }
                  $mapping[$k] = $sort_key;
              }
              switch ($order) {
              case SORT_ASC:
              asort($mapping, $sort_flags);
              break;
              case SORT_DESC:
              arsort($mapping, $sort_flags);
              break;
              }
              $sorted = array();
              foreach ($mapping as $k => $v) {
                  $sorted[] = $array[$k];
              }
              return $sorted;
          }
        }
          return $array;
    }
    public function reverse($array){
        $result = $array->reverse();
        return $result->all();
    }
    // json
    function json($type = 'success', $data = NULL, $http_code = 200) {
        $json = array();
        $json['type'] = $type;
        $json['message'] = $data;
        return response()->json($json, $http_code);
    }
    function api_json($success, $data = NULL, $extra_params = array(),$http_code = 200) {
        $json = array();
        $json['success'] = $success;
        $json['data'] = $data;
        $json['message'] = '';
        if (!empty($extra_params)) {
            foreach ($extra_params as $key => $param) {
                $json[$key] = $param;
            }
        }
        if (!$success && isset($json['errors'])) {
            $errors_arr = $json['errors'];
            $errors_str = array();
            if (!empty($errors_arr)) {
                foreach ($errors_arr as $key => $value) {
                    $error = str_replace(' ', '_', $value[0]);
                    $error = trim($error, '.');
                    $errors_str[] = _lang('app.' . $error);
                }
                unset($json['errors']);
                $json['message'] = implode("\n", $errors_str);
            }
        }

        return response()->json($json, $http_code, [], JSON_NUMERIC_CHECK);
    }
    // Auth
    // Notification
    public function sendNotification($notification,$token,$device_type){
        $params=array();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $key = 'AAAA7NJWmTI:APA91bHtx_jGllbSgbkvnBVBSX2TaPb5A3Iufo0WEkKgfbvUPWasu_NSrahVhSB9BoiKSMNHWk9nV6CThRUU4bPDtuqnsTtw9Ec_Gk3GEWfhLzWl3MmswJIz8XQFJLH1Rbm5mNY_4U5o';
        $headers = array(
            'Authorization: key=' . $key,
            'Content-Type: application/json; charset=utf-8',
        );
        $data = array('priority' => 'high', 'content_available' => true, 'vibrate' => 1, 'sound' => 1, 'alert' => 1);
        foreach ($notification as $key => $value) {
            $data[$key] = $value;
        }
        if(is_array($token)){
            $params['registration_ids']=$token;
        }else{
            $params['to']=$token;
        }
        if ($device_type == 'ios') {
            $params['notification'] = $data;
        } else if ($device_type == 'and') {
            $params['data'] = $data;
        } else if ($device_type == 'twice') {
            $params['notification'] = $data;
            $params['data'] = $data;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        $result = curl_exec($ch);
        if ($result === False) {
            die('Curl Filed ' . curl_errno($ch));
        }
        curl_close($ch);
        return $result;
    }
    // Email
    public function sendEmail($email){}
    // Validations
    public function validation($rules,$request,$json=true){
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
//            dd($errors);
            return response()->json([
                        'type' => 'error',
                        'errors' => $errors
            ]);
        }
        return true;
    }
    public function inputs_check($model, $inputs = array(), $id = false)
    {
        $errors = array();
        foreach ($inputs as $key => $value) {
            $where_array = array();
            $where_array[] = array($key, '=', $value);
            if ($id) {
                $where_array[] = array('id', '!=', $id);

                $find = $model::where($where_array)->get();
                if (count($find)) {

                    $errors[$key] = array(_lang('app.' . $key) . ' ' . _lang("app.added_before"));
                }
            }
            return $errors;
        }
    }
    //Other
    public function getYoutubeEmbedUrl($url){
	    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
	    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

	    if (preg_match($longUrlRegex, $url, $matches)) {
	        $youtube_id = $matches[count($matches) - 1];
	    }

	    if (preg_match($shortUrlRegex, $url, $matches)) {
	        $youtube_id = $matches[count($matches) - 1];
	    }
	    return 'https://www.youtube.com/embed/' . $youtube_id ;
    }

    function dd(){

    }

    public function _editButn($object,$route,$param=[]){
        if(empty($param)){
            return '<a  href="'.url($route).'/'.$object->id.'/edit" data-id="'.$object->id.'">
                <i class="fas fa-eye view-row" title="View"" ></i>
                                    </a>';
        }else{
            $where='?';
            $count=1;
            foreach($param as $key=>$value){
                $where .=$key.'='.$value;
                if($count < count($param)){
                    $where .='&';
                }
                $count++;
            }
            return '<a href="'.url($route).'/'.$object->id.'/edit'.$where.'" data-id="'.$object->id.'">
         <i class="fas fa-eye view-row" title="View""></i>
                            </a>';
        //     return '<a href="'.url($route).'/'.$object->id.'/edit'.$where.'" data-id="'.$object->id.'">
        //  مشاهده المحتوى
                            // </a>';
        }
         
    }
    public function _deleteBtn($object){
        return '<button type="button" class="delete_TecTest" data-id="'.$object->id.'">
        <i class="fas fa-trash-alt "title="Delete"></i>
                            </button>';
        // return '<button type="button" class="delete_TecTest" data-id="'.$object->id.'">
        //     مسح </button>';
        
    }
    public function _activeBtn($object){
        if($object->active==0){
        return '<button type="button" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-float ActiveBlockbtn" data-id="'.$object->id.'" >
                                    <i class="material-icons">close</i>
                                </button>';
        }elseif($object->active==1){
        return '<button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float ActiveBlockbtn" data-id="'.$object->id.'" >
                                    <i class="material-icons">done</i>
                                </button>';
        }

    }
    public function _LinkBtn($Url,$title=""){
            return '<a title="'.$title.'" href="'.$Url.'" class="btn bg-yellow btn-circle waves-effect waves-circle waves-float">
                <i class="material-icons">trending_up</i>
            </a>';
    }
    public function _creatBtn($Url,$icone,$color,$title=""){
        return '<a title="'.$title.'" href="'.$Url.'" class="btn bg-'.$color.' btn-circle waves-effect waves-circle waves-float">
                <i class="material-icons">'.$icone.'</i>
            </a>';
    }
    public function _AjaxSelect($Model,$field,$id,$where=array()){
        $Object=$Model::where('stop',1);
        foreach ($where as $key => $value) {
            $Object->where($key,$value);
        }
        $Object->get();
        $text='<option value="">-- No Data Found --</option>';
        if($Object){
            $text='<option value="">-- Please select --</option>';
            foreach ($Object as $value) {
            $text.='<option value="'.$value->$id.'">'.$value->$field.'</option>';
            }
        }
        return $text;
    }
    public function checkUnique($table,$check_array,$id=''){
        $result=[];
        foreach($check_array as $key=>$value){
            $result=DB::table($table)->where($key, $value);
            if ($id) {
                $result=$result->where('id', '<>', $id);
            }
            $result=$result->first();
            
            if($result){
                // dd($result);
                $error[$key]='*The '.$key.' has already been taken';
            }
        }
        if(empty($error)){
            return true;
        }
        return response()->json([
            'type' => 'error',
            'errors' => $error
        ]);
    }
}
