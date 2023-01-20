<?php
register_rest_route("v1/", "file-list", [
    "methods" => "GET",
    "callback" => "read_filse",
]);
function read_filse($req)
{
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
    
    // end api call
    // get params as pages
    // pagination code
    if( isset($getresult['page']) && !empty($getresult['page']) ) {
        $page_num = $getresult['page'];  
      }else{
          $page_num = 1;
      }
    if(isset($getresult["perPage"])){
        $perPage_num = $getresult['perPage'];
      } else {
          $perPage_num = 10;
      }
  //  get params end 
    $artist_id= $auht_res_id;
    $page=$page_num;
    $perPage=$perPage_num;
    $args = array(
    'post_type' => 'attachment',
    'post_mime_type' => array('video'), 
    'paged' => $page,
    'posts_per_page'=> $perPage,
    "author" => $artist_id,
    ); 
    $attachments = get_posts($args);
    $files=[];
    $get_about_file=array();
    $serial=1;
    $r_inc=0;
    $getuser= get_userdata( $artist_id );
    $get_user_data = get_userdata($artist_id); // get user data
    $get_roles = $get_user_data->roles;
      if($getuser){
           if($get_roles[0] =="artist"){
              if (count($attachments) >= 1) {
                  foreach ($attachments as $post) {
                      if(pathinfo(wp_get_attachment_url($post->ID, false))["extension"]=="mp4"  ){
                            $files[$r_inc]["sr#"] = $serial++;
                            $files[$r_inc]["name"] = basename( get_attached_file( $post->ID ) );
                            $files[$r_inc]["mime-type"]=pathinfo(wp_get_attachment_url($post->ID, false))["extension"];
                            $files[$r_inc]["src"] = wp_get_attachment_url($post->ID, false);
                            $files[$r_inc]["file_id"] = $post->ID;
                            }
                          $r_inc++;
                        }
                        $message=["status"=> true, "message"=>"Records  found"];
                        $get_res= new WP_REST_Response( [
                            "files"=>$files,
                            "response"   =>  $message,
                            "page"=>$page_num,
                            "perPage"=>$perPage_num
                          ]);
                        $get_res->set_status(200);
                      return $get_res;
                      }
                else {
                  $files  =[];
                  $message=["status"=> false, "message"=>"Records not found"];
                  $get_res= new WP_REST_Response( [
                      "files"=>$files,
                      "response"   =>  $message,
                      "page"=>$page_num,
                      "perPage"=>$perPage_num
                  ]);
                  $get_res->set_status(404);
              return $get_res;
            }
          } else {
            $files  =[];
            $message=["status"=> false, "message"=>"this user is not an artist"];
            $get_res= new WP_REST_Response( [
                    "files"=>$files,
                    "response"   =>  $message,
                    "page"=>$page_num,
                    "perPage"=>$perPage_num
                ]);
                $get_res->set_status(403);
              return $get_res;
           }
         } else {
            $files  =[];
            $message=["status"=> false, "message"=>"this user is not found"];
            $get_res= new WP_REST_Response( [
                    "files"=>$files,
                    "response"   =>  $message,
                    "page"=>$page_num,
                    "perPage"=>$perPage_num  ]);
         $get_res->set_status(404);
         return $get_res;
      }  
}