<?php
register_rest_route("v1/", "entry", [
    "methods" => "POST",
    "callback" => "add_entries",
]);
function add_entries( $req)
{ 

// $mimes = array(
//     'bmp'  => 'image/bmp',
//     'gif'  => 'image/gif',
//     'jpe'  => 'image/jpeg',
//     'jpeg' => 'image/jpeg',
//     'jpg'  => 'image/jpeg',
//     'png'  => 'image/png',
//     'tif'  => 'image/tiff',
//     'tiff' => 'image/tiff'
// );

// $overrides = array(
//     'mimes'     => $mimes,
//     'test_form' => false
// );

// $upload = wp_handle_upload( $_FILES['file'], $overrides );
// remove_filter( 'upload_dir', array($this, 'change_upload_dir') );
// if ( isset( $upload['error'] ) ){
//     echo "SOME UPLOAD ERROR OCCURED";
// } else {
//      echo "File uploaded successfully"; 
//     $uploadedFileURL = $upload['url'];
//     $uploadedFileName = basename($upload['url']);
// }

    $getresult = $req->get_params();
    // call api for getting user ap
    $headers            = apache_request_headers();
    $newstr             = str_replace("Bearer","", $headers["Authorization"] );
	$filter_trim_token  = str_replace(" ","", $newstr);
    $base_url           = get_site_url();
    $url                = "{$base_url}/wp-json/wp/v2/users/me";
   
    // The following is the array for the arguments
    $args = array(
        'headers'     => array(
            'Authorization' => 'Bearer ' .  $filter_trim_token,
        ),
    ); 
    $data_res       = wp_remote_get($url, $args);
    $body           = wp_remote_retrieve_body( $data_res );
    $auht_res_id    = json_decode($body)->id;
    $user_id        = $auht_res_id;
    // end api call
    $my_post = [
        "post_type" => "competetion",
        "post_title" => wp_strip_all_tags($getresult["title"]),
        "post_status" => "publish",
        "post_author" => $user_id,
    ];
    $meta_value_des=wp_strip_all_tags($getresult["description"]);
    $meta_value_vid=$getresult["file_id"];
    $termid = [ $getresult["entry_listing_id"] ];
    
    // Insert the post into the database
    
    $desc_key="description";
    $vid_key="video";
    $getuser= get_userdata( $user_id );
    $get_user_data = get_userdata($user_id); // get user data
    $get_roles = $get_user_data->roles;
    $get_com_id= $getresult["comp_id"];
    global $wpdb;
    $compet = $wpdb->get_results("SELECT * FROM wp_Competetion WHERE Id = $get_com_id");
        foreach($compet as $competetionss ){
            $comp_date=$competetionss->Date;
            $cont_date=$competetionss->pickdateforContent;
        }
    // the following code is of the count comp against this id that is it exist.
   
    $do_check_comp=count($compet);
    if($do_check_comp>=1){
      if ( $cont_date>=date('Y/m/d') && $cont_date<=$comp_date){
         if( !empty($termid) && !empty($meta_value_vid) && !empty($meta_value_des) && !empty($getresult["title"])){
            if($getuser){
              if($get_roles[0] =="artist"){
                  $check_val = single_upload_restriciton($getresult["entry_listing_id"]); 
                    if( isset($check_val) && !empty($check_val) && $check_val >= 1 ) {
                        $message= ["status"=> false, "message"=>"You have already submitted your entry."];
                        $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
                        $get_res->set_status(422);
                        return $get_res;
                        } else {
                            $post_id=wp_insert_post($my_post);
                            add_post_meta($post_id, $desc_key, $meta_value_des);
                            add_post_meta($post_id, $vid_key, $meta_value_vid );
                            $add_entery= wp_set_post_terms($post_id, $termid, 'All_Competition' );
                        if ($add_entery) {
                            $message= ["status"=> true, "message"=>"You have successfuly submit your entry."];
                            $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
                            $get_res->set_status(200);
                            return $get_res;
                        } else { 
                        $message= ["status"=> false, "message"=>"Entry is failed."];
                        $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
                        $get_res->set_status(403);
                        return $get_res;
                    }
                  }
                    } else {
                    $message= ["status"=> false, "message"=>"This user is not an artist"];
                    $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
                    $get_res->set_status(403);
                    return $get_res;
                 }
                } else {
                $message= ["status"=> false, "message"=>"This user is not registered"];
                $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
                $get_res->set_status(403);
                return $get_res;
            }
          } else {
                $message= ["status"=> false, "message"=>"all fields are required"];
                $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
                $get_res->set_status(422);
                return $get_res;
          } 
        } else {
            $message= ["status"=> false, "message"=>"You can't do entry in this competiton check competition status."];
            $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
            $get_res->set_status(404);
            return $get_res;
        }
    } else {
         $message= ["status"=> false, "message"=>"This competiton is not exist."];
         $get_res= new WP_REST_Response([ "response"     =>  $message,  ]);
         $get_res->set_status(404);
         return $get_res;
    }

}
