<?php

register_rest_route("v1/", "current-competitions", [
    "methods" => "GET",
    "callback" => "current_competition",
]);
function current_competition($request_data)
{
    function getTermsIdWOLink($competitionNameIs)
    {
        $termAll = get_terms([
            "taxonomy" => "All_Competition",
            "hide_empty" => false,
        ]);
        foreach ($termAll as $Singkleterm) {
            if ($Singkleterm->name == $competitionNameIs) {
                return $Singkleterm->term_id;
            }
        }
    }
    // competiton *************************************************************************
    $c = 0;
    global $wpdb;
    $getparameter=$request_data->get_params();
// pagination code
  if(isset($getparameter['page'])){
        $page = $getparameter['page'];
        }else{
        $page = 1;
        }
    if(isset($getparameter["perPage"])){
        $limitofRecords = $getparameter['perPage'];
    } else {
        $limitofRecords = 10;
    }
   $offset= ($page - 1) * $limitofRecords;
// pagination code end
    $competetion = $wpdb->get_results(
        "SELECT * FROM wp_Competetion WHERE Date>='" .
            date("Y/m/d") .
            "' ORDER BY Id DESC LIMIT {$offset} , {$limitofRecords}" );
    if(count($competetion)>=1){
    foreach ($competetion as $Each_competetion) {
        if (  $Each_competetion->pickdateforContent >= date("Y/m/d") &&  $Each_competetion->pickdateforContent <= $Each_competetion->Date ) {
                $status = "conent_start";
            } elseif (  $Each_competetion->pickdateforContent < date("Y/m/d") && $Each_competetion->Date >= date("Y/m/d") ) {
                $status = "comp-start";
            } elseif ( $Each_competetion->pickdateforContent <= date("Y/m/d") &&  $Each_competetion->Date < date("Y/m/d")  ) {
                $status = "comp-end";
            }
        $jge1 = !empty($Each_competetion->JudgeOne)
            ? $Each_competetion->JudgeOne
            : "";
        $jge2 = !empty($Each_competetion->JudgeTwo)
            ? $Each_competetion->JudgeTwo
            : "";
        $jge3 = !empty($Each_competetion->JudgeThree)
            ? $Each_competetion->JudgeThree
            : "";
        $jge4 = !empty($Each_competetion->Judge4)
            ? $Each_competetion->Judge4
            : "";
        $jge5 = !empty($Each_competetion->Judge5)
            ? $Each_competetion->Judge5
            : "";
        $jge6 = !empty($Each_competetion->Judge6)
            ? $Each_competetion->Judge6
            : "";
        $jge7 = !empty($Each_competetion->Judge7)
            ? $Each_competetion->Judge7
            : "";
        $jge8 = !empty($Each_competetion->Judge8)
            ? $Each_competetion->Judge8
            : "";
        $jge9 = !empty($Each_competetion->Judge9)
            ? $Each_competetion->Judge9
            : "";
        $jge10 = !empty($Each_competetion->Judge10)
            ? $Each_competetion->Judge10 : "";
        $tags = $Each_competetion->tags;
        $tags = unserialize($tags);
        $tag_string = [];
        if (isset($tags) && !empty($tags)) {
            foreach ($tags as $tag) {
                array_push($tag_string, $tag);
            }
        }
        $competetion_count = $wpdb->get_results(  "SELECT * FROM wp_Competetion WHERE Date>='" . date("Y/m/d") .  "' ORDER BY Id DESC " );
        $total=count($competetion_count);
        $to=$limitofRecords;
        $from= $page;
          $judgesNamesList                        = [];
        $judgesNames = [
                        ["judge_name"=>get_user_by("ID", $jge1)->display_name,"judge_id"=>$jge1   , "avatar" => get_field("profile_image", "user_" . $jge1)],
                        ["judge_name"=>get_user_by("ID", $jge2)->display_name,"judge_id"=>$jge2   , "avatar" => get_field("profile_image", "user_" . $jge2)],
                        ["judge_name"=>get_user_by("ID", $jge3)->display_name,"judge_id"=>$jge3   , "avatar" => get_field("profile_image", "user_" . $jge3)],
                        ["judge_name"=>get_user_by("ID", $jge4)->display_name,"judge_id"=>$jge4   , "avatar" => get_field("profile_image", "user_" . $jge4)],
                        ["judge_name"=>get_user_by("ID", $jge5)->display_name,"judge_id"=>$jge5   , "avatar" => get_field("profile_image", "user_" . $jge5)],
                        ["judge_name"=>get_user_by("ID", $jge6)->display_name,"judge_id"=>$jge6   , "avatar" => get_field("profile_image", "user_" . $jge6)],
                        ["judge_name"=>get_user_by("ID", $jge7)->display_name,"judge_id"=>$jge7   , "avatar" => get_field("profile_image", "user_" . $jge7)],
                        ["judge_name"=>get_user_by("ID", $jge8)->display_name,"judge_id"=>$jge8   , "avatar" => get_field("profile_image", "user_" . $jge8)],
                        ["judge_name"=>get_user_by("ID", $jge9)->display_name,"judge_id"=>$jge9   , "avatar" => get_field("profile_image", "user_" . $jge9)],
                        ["judge_name"=>get_user_by("ID", $jge10)->display_name,"judge_id"=>$jge10 , "avatar" => get_field("profile_image", "user_" . $jge10)]
                      ];      
                    foreach ($judgesNames as $singlejudge) {
                      if($singlejudge["judge_id"] !== ""){
                          array_push($judgesNamesList, $singlejudge);
                      }
                    }
                $comp[$c]["comp_id"] = $Each_competetion->Id;
                $comp[$c]["title"] = $Each_competetion->competetionName;
                $comp[$c]["comp_start_date"]        = $Each_competetion->pickdateforContent;
                $comp[$c]["comp_entry_end_date"]    = $Each_competetion->pickdateforContent;
                $comp[$c]["voting_end_date"]        = $Each_competetion->Date;
                $comp[$c]["comp_end_date"]          = $Each_competetion->Date;
                $comp[$c]["description"] =   $Each_competetion->description;
                $comp[$c]["Judges"] = $judgesNamesList;
                $comp[$c]["tags"] = $tag_string;
                $comp[$c]["banner"] = $Each_competetion->media_document;
                $comp[$c]["status"]                 = $status;
                $comp[$c]["entry_listing_id"] = getTermsIdWOLink(
                $Each_competetion->competetionName
                );
                $c++;
            }
            $message=["status"=> true, "message"=>"Records found"];
            $get_res= new WP_REST_Response(
                        array([ "current_competitions" => $comp,
                                "response"  =>  $message,
                                "page" => $from,
                                "perPage" => $to,
                                "total" => $total,
                                ]));
            $get_res->set_status(200);
            return $get_res;
        } else {
            $comp=[];
            $message=["status"=> false, "message"=>"Records not found"];
            $get_res= new WP_REST_Response(
                        array([ "current_competitions" => $comp,
                                "response"     =>  $message,
                                "page" => $from,
                                "perPage" => $to,
                                "total" => $total,
                                ]));
            $get_res->set_status(404);
       return $get_res;
   }
     
}
?>
