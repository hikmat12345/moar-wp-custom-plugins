<?php

register_rest_route("v1/", "list_entry", [
    "methods" => "GET",
    "callback" => "entries_listing_fun",
]);
function entries_listing_fun($request_data)
{
    $getparams=$request_data->get_params();
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
    // schema set
    // perPage
    // page
    // entries_list_id
    //********************************8 */ entries ******************************8
    if(isset($getparams["perPage"]))
        {
            $perPage=$getparams["perPage"]; }
        else { $perPage=10;  }
    if(isset($getparams["page"]))
        {  $page=$getparams["page"]; }
        else {  $page=1;  }
           $args_count = [
            "post_type" => "competetion",
            "post_status" => "publish",
            "posts_per_page" => -1,
            "tax_query" => [
                [
                    "taxonomy" => "All_Competition",
                    "field" => "term_id",
                    "terms" => $getparams["entry_listing_id"],
                ],
            ],
         ];
       $total=count(get_posts($args_count));
        $args = [
            "post_type" => "competetion",
            "post_status" => "publish",
            "posts_per_page" => $perPage,
            'paged'=>$page,
        "tax_query" => [
            [
                "taxonomy" => "All_Competition",
                "field" => "term_id",
                "terms" => $getparams["entry_listing_id"],
            ],
         ],
      ];
    $entry_list = [];
    $inc = 0;
    $getcomp_id=$getparams["comp_id"];
    global $wpdb;
    $CheckVoterId = $wpdb->get_results( "SELECT * FROM `wp_uservotes` WHERE  UserId='" . get_current_user_id() ."' AND competitionId='" .$getcomp_id."'");
    $isVoted = count($CheckVoterId)>=1;
     foreach ($CheckVoterId as $useridut) {
            $geta_idut=$useridut->ArtistId;
        }
        $compet = $wpdb->get_results("SELECT * FROM wp_Competetion WHERE Id = $getcomp_id");
            foreach($compet as $competetionss ){
                $comp_date=$competetionss->Date;
                $cont_date=$competetionss->pickdateforContent;
            }
       $query = new WP_Query($args);
      if ( $cont_date<=date('Y/m/d') && $comp_date<date('Y/m/d')){
        $entry_list=[];
         $message=["status"=> false, "message"=>"This competition is end."];
        $get_res= new WP_REST_Response([
                "all_entries" => $entry_list,
                "response"  =>  $message,
            ]);
            $get_res->set_status(403);
            return $get_res;
            } else {
            if ($query->have_posts()):
                while ($query->have_posts()):
                $query->the_post();
                $myString=  get_field("video");
                if ( strstr( $myString, '://' ) ) {
                    $file_video =get_field("video");
                    } else {
                        $file_video =wp_get_attachment_url( (int)get_field("video"), false); 
                    }
                   $audiFile=  get_field("audio");
                if ( strstr( $audiFile, '://' ) ) {
                    $file_audio =get_field("audio");
                    } else {
                        $file_audio =wp_get_attachment_url( (int)get_field("audio"), false); 
                      }
                        $entry_list[$inc]["artist_detail"]["artist_id"] = get_the_author_ID();
                        $entry_list[$inc]["artist_detail"]["artist"] = get_the_author();
                        $entry_list[$inc]["entry_detail"]["entry_id"] = get_the_id();
                            if ($file_video) {
                                $entry_list[$inc]["entry_detail"]["video"] = $file_video;
                            }
                            if ($file_audio) {
                                $entry_list[$inc]["entry_detail"]["audio"] = $file_audio;
                            }
                            $entry_list[$inc]["entry_detail"]["title"] = get_the_title();
                            $entry_list[$inc]["entry_detail"]["description"] = get_field("description");
                            global $post;
                            $author_id=$post->post_author;
                            if($user_id){
                                if( $user_id==$author_id ){
                                    $entry_list[$inc]["entry_detail"]["voted"]["voter_id"]=$user_id;
                                    $entry_list[$inc]["entry_detail"]["voted"]["name"]=get_user_by("ID", $user_id)->display_name;
                                    $entry_list[$inc]["entry_detail"]["voted"]["is_voted"]=true;
                                } else {
                                    $entry_list[$inc]["entry_detail"]["voted"]["voter_id"]="";
                                    $entry_list[$inc]["entry_detail"]["voted"]["name"]="";
                                    $entry_list[$inc]["entry_detail"]["voted"]["is_voted"]=false;
                                }
                         }
                      $inc++;
                    $message=["status"=> true, "message"=>"Records found"];
                  endwhile;
               $get_res= new WP_REST_Response([
                "all_entries" => $entry_list,
                "response"     =>  $message,
                "perPage"=>$perPage,
                "page"=> $page,
                "total"=> $total, ]);
           $get_res->set_status(200);
           return $get_res;
          else : 
        $entry_list=[];
        $message=["status"=> false, "message"=>"Records not found"]; 
        $get_res= new WP_REST_Response([
            "all_entries" => $entry_list,
            "response"     =>  $message,
            "perPage"=>$perPage,
            "page"=> $page,
            "total"=> $total,
        ]);
      $get_res->set_status(404);
        return $get_res;
      endif;  
   } 
}
?>
