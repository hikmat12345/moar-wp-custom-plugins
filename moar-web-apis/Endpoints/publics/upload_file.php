 <?php
 register_rest_route('v2/','upload_file', array(
    'methods' => 'POST',
    'callback' => 'wc_rest_join_membership_handler',
  ));

function wc_rest_join_membership_handler($request = null) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                // call api for token decoding and validating
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
                // api calling end
                $file       = $_FILES['file'];
                $file_check= $_FILES['file'];
                $file_name  = $file['name'];
                  // file is debuging
                $upload_dir = wp_upload_dir();
               
                 $file_name_test=  $upload_dir['url'].'/'.$file_name;

                  var_dump($upload_dir['url'].'/'.$file_name);
                if(file_exists($file_name_test)){
                  echo 'It does exist';
                } else {
                  echo 'not exsists';
                }
                // file debugin end
                  $file_temp  = $file['tmp_name'];
                  $upload_dir = wp_upload_dir();
                  
                  $filename   = basename( $file_name );
                  $filetype   = wp_check_filetype($file_name);
                  $filename   = $file_name;
                  if ( wp_mkdir_p( $upload_dir['path'] ) ) {
                    $file     = $upload_dir['path'] . '/' . $filename;
                  }
                  else {
                    $file     = $upload_dir['basedir'] . '/' . $filename;
                  }
                  $getuser= get_userdata( $user_id );
                  $get_user_data = get_userdata($user_id); // get user data
                  $get_roles = $get_user_data->roles;
                    if($getuser){
                        if($get_roles[0] =="artist"){
                          if($file_check["type"] == "video/mp4" && !empty($file_check["type"])){
                            $image_data = file_get_contents( $file_temp );
                            file_put_contents( $file, $image_data );
                             $wp_filetype = wp_check_filetype( $filename, null );
                             $attachment = array(
                              'post_author'    	=> $user_id,
                              'post_mime_type' 	=> $wp_filetype['type'],
                              'post_title'		=> sanitize_file_name( $filename ),
                              'post_content' 	=> '',
                              'post_status' 	=> 'inherit' );
                              $attach_id = wp_insert_attachment( $attachment, $file );
                              require_once( ABSPATH . 'wp-admin/includes/image.php' );
                              $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                                if(wp_update_attachment_metadata( $attach_id, $attach_data )){
                                  $message= ["status"=>true, "file_id"=>$attach_id, "file_name"=>$file_name, "message"=> "File has been uploaded."];
                                  $get_res= new WP_REST_Response( [ 
                                      "response"   =>  $message
                                  ]);
                                  $get_res->set_status(200);
                                return $get_res;
                                } else {
                                  $message= ["status"=>true, "message"=> "File has not uploaded."];
                                  $get_res= new WP_REST_Response( [ 
                                      "response"   =>  $message
                                  ]);
                                  $get_res->set_status(403);
                                  return $get_res;
                                }
                        } else{
                          $message= ["status"=> false, "message"=>"check your  file type is an audio or video formate or should not be empty."];
                         $get_res= new WP_REST_Response( [ 
                                "response"   =>  $message
                            ]);
                            $get_res->set_status(403);
                          return $get_res;
                        }
                      } else {
                      $message= ["status"=> false, "message"=>"This user is not an artist"];
                      $get_res= new WP_REST_Response( [ 
                                "response"   =>  $message
                            ]);
                            $get_res->set_status(403);
                          return $get_res;
                    }
                  } else {
                $message= ["status"=> false, "message"=>"This user is not registered. You are not authorized person."];
                 $get_res= new WP_REST_Response( [ 
                   "response"   =>  $message
                ]);
                $get_res->set_status(403);
              return $get_res;
           }  
     } 