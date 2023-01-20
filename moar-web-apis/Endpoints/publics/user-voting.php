<?php
register_rest_route("v1/", "do_vote", [
    "methods"    => "POST",
    "callback"  => "do_vote_competition",
]);
function do_vote_competition($request_data) {  
    $requestParams=$request_data->get_params();
    global $wpdb;   
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
    // the following code is about to check the comp is this com start
    $nowDate=date("Y/m/d");
    global $wpdb;
    $comp_table_id=$requestParams["comp_id"];
    $compet = $wpdb->get_results("SELECT * FROM wp_Competetion WHERE Id = $comp_table_id");
        foreach($compet as $competetionss ){
          $dateOfDb=$competetionss->Date;
          $dateOfDbEntry_start=$competetionss->pickdateforContent;
        }
    // The following is the query to get votes from a specific user in a competition
    $getuser= get_userdata( $user_id );
    $get_user_data = get_userdata($user_id); // get user data
    $get_roles = $get_user_data->roles;
    if($getuser){
        if(!empty($requestParams["entry_id"]) && !empty($requestParams["comp_id"])){
                 if( is_null(get_post($requestParams["entry_id"]))){
                     if ( $dateOfDbEntry_start<date('Y/m/d') && $dateOfDb>=date('Y/m/d') ){
                        $CheckVoterId = $wpdb->get_results( "SELECT * FROM `wp_uservotes` WHERE  UserId='" .  $user_id ."' AND competitionId='" .$comp_table_id."'");
                        if ( count($CheckVoterId)>=1){
                            $message = ["status"=>false, "message"=> "You have voted in this competition."];
                                $get_res= new WP_REST_Response( [  "response"   =>  $message ]);
                            $get_res->set_status(200);
                            return $get_res; 
                        } else {
                            $post_tmp       = get_post($requestParams["entry_id"]);
                            $author_id      = $post_tmp->post_author;
                            $ar_name        = get_user_by( 'ID',$author_id)->display_name;
                            $date           = new DateTime();
                            $id             = $user_id;
                            $ArtistName     = $ar_name;
                            $userRole       = $get_roles[0];
                            $timeOf_casting = $date->format('Y-m-d H:i:s');
                            $artistid       = $author_id;
                            $competitionId  = $requestParams["comp_id"];
                            global $wpdb;     
                            // Query to add the vote details in the table
                            if($wpdb->insert('wp_uservotes', [
                                'UserId'        => "$id",
                                'competitionId' => "$competitionId",
                                'UserRole'      => "$userRole",
                                'ArtistName'    => "$ArtistName",
                                'ArtistId'      => "$artistid",
                                'DateTime'      => "$timeOf_casting",])) {
                                $message = ["status"=>true, "message" => "successfully voted" ];
                                $get_res= new WP_REST_Response( [  "response"   =>  $message ]);
                                    $get_res->set_status(200);
                                    return $get_res; 
                                    } else{
                                        $message = ["status"=>false, "message" => "vote failed",];
                                        $get_res= new WP_REST_Response( ["response"   =>  $message ]);
                                    $get_res->set_status(403);
                                return $get_res; 
                                    }
                                }
                            } else{
                            $message= ["status"=> false, "message"=>"You are not able to vote. check competition status."];
                             $get_res= new WP_REST_Response( ["response"   =>  $message ]);
                            $get_res->set_status(417);
                            return $get_res;
                                } 
                            }
                        else {
                            $message= ["status"=> false, "message"=>" field can't be empty"];
                            $get_res= new WP_REST_Response( ["response"   =>  $message ]);
                            $get_res->set_status(422);
                        return $get_res;
                        }
                    } else {
                   $message= ["status"=> false, "message"=>"Entry is not exists"];
                    $get_res= new WP_REST_Response( ["response"   =>  $message ]);
                        $get_res->set_status(404);
                    return $get_res;
                }
            } else {
            $message= ["status"=> false, "message"=>"This user is not registered"];
              $get_res= new WP_REST_Response( ["response"   =>  $message ]);
                  $get_res->set_status(403);
               return $get_res;
        }
}