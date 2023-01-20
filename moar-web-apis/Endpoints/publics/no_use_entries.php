<?php

register_rest_route("v1/", "entries-list", [
    "method" => "POST",
    "Authorization" => base64_encode("admin:admin"),
    "callback" => "entries_listing_competition",
]);
function entries_listing_competition($request_data)
{
    $headers = apache_request_headers();

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
    $getparams=$request_data->get_params();
    // schema
    // comp_id
    $c = 0;
    global $wpdb;
    $iterator = 1;
    $comp_custom_id = $getparams["comp_id"];
    $competetion = $wpdb->get_results(
        "SELECT * FROM wp_Competetion WHERE Id='" . $comp_custom_id . "'"
    );
    foreach ($competetion as $Each_competetion) {
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
            ? $Each_competetion->Judge10
            : "";

        $tags = $Each_competetion->tags;
        $tags = unserialize($tags);
        $tag_string = [];
        if (isset($tags) && !empty($tags)) {
            foreach ($tags as $tag) {
                array_push($tag_string, $tag);
            }
        }
          $judgesNamesList                        = [];
        $judgesNames = [
                        get_user_by("ID", $jge1)->display_name,
                        get_user_by("ID", $jge2)->display_name,
                        get_user_by("ID", $jge3)->display_name,
                        get_user_by("ID", $jge4)->display_name,
                        get_user_by("ID", $jge5)->display_name,
                        get_user_by("ID", $jge6)->display_name,
                        get_user_by("ID", $jge7)->display_name,
                        get_user_by("ID", $jge8)->display_name,
                        get_user_by("ID", $jge9)->display_name,
                        get_user_by("ID", $jge10)->display_name,
                      ];
                   $filterJudge=[ [  "judge_id" => get_user_by("ID", $jge1)->ID,
                                     "name" => get_user_by("ID", $jge1)->display_name,
                                     "avatar" => get_field("profile_image", "user_" . $jge1), ],
                                   [ "judge_id" => get_user_by("ID", $jge2)->ID,
                                     "name" => get_user_by("ID", $jge2)->display_name,
                                     "avatar" => get_field("profile_image", "user_" . $jge2), ],
                                    [ "judge_id" => get_user_by("ID", $jge3)->ID,
                                      "name" => get_user_by("ID", $jge3)->display_name,
                                      "avatar" => get_field("profile_image", "user_" . $jge3),],
                                    [ "judge_id" => get_user_by("ID", $jge4)->ID,
                                      "name" => get_user_by("ID", $jge4)->display_name,
                                      "avatar" => get_field("profile_image", "user_" . $jge4),],
                                    [ "judge_id" => get_user_by("ID", $jge5)->ID,
                                      "name" => get_user_by("ID", $jge5)->display_name,
                                      "avatar" => get_field("profile_image", "user_" . $jge5),],
                                    [ "judge_id" => get_user_by("ID", $jge6)->ID,
                                      "name" => get_user_by("ID", $jge6)->display_name,
                                      "avatar" => get_field("profile_image", "user_" . $jge6),],
                                    [ "judge_id" => get_user_by("ID", $jge7)->ID,
                                      "name" => get_user_by("ID", $jge7)->display_name,
                                      "avatar" => get_field("profile_image", "user_" . $jge7), ],
                                    [ "judge_id" => get_user_by("ID", $jge8)->ID,
                                      "name" => get_user_by("ID", $jge8)->display_name,
                                      "avatar" => get_field("profile_image", "user_" . $jge8),  ],
                                     [ "judge_id" => get_user_by("ID", $jge9)->ID,
                                       "name" => get_user_by("ID", $jge9)->display_name,
                                       "avatar" => get_field("profile_image", "user_" . $jge9), ],
                                     [ "judge_id" => get_user_by("ID", $jge10)->ID,
                                       "name" => get_user_by("ID", $jge10)->display_name,
                                       "avatar" => get_field("profile_image", "user_" . $jge10), ]];
                       foreach ($filterJudge as $singlejudge) {
                        // if($singlejudge !== null){
                          var_dump($singlejudge);
                                            
                                        
                        // }
                     }
                   
        if (  $Each_competetion->pickdateforContent >= date("Y/m/d") &&  $Each_competetion->pickdateforContent <= $Each_competetion->Date ) {
            $status = "conent_start";
        } elseif (  $Each_competetion->pickdateforContent < date("Y/m/d") && $Each_competetion->Date >= date("Y/m/d") ) {
            $status = "comp-start";
        } elseif ( $Each_competetion->pickdateforContent <= date("Y/m/d") &&  $Each_competetion->Date < date("Y/m/d")  ) {
            $status = "comp-end";
        }
       
        $comp[$c]["competition_id"]   = $Each_competetion->Id;
        $comp[$c]["competition_name"] = $Each_competetion->competetionName;
        $comp[$c]["entry_start_date"] = $Each_competetion->pickdateforContent;
        $comp[$c]["comp_end_date"]    = $Each_competetion->Date;
        $comp[$c]["description"]      = $Each_competetion->description;
        $comp[$c]["banner"]           = $Each_competetion->media_document;
        // $comp[$c]["Judges"]           = $filterJudge;
         //[
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge1)->ID,
        //                                         "name" => get_user_by("ID", $jge1)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge1),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge2)->ID,
        //                                         "name" => get_user_by("ID", $jge2)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge2),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge3)->ID,
        //                                         "name" => get_user_by("ID", $jge3)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge3),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge4)->ID,
        //                                         "name" => get_user_by("ID", $jge4)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge4),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge5)->ID,
        //                                         "name" => get_user_by("ID", $jge5)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge5),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge6)->ID,
        //                                         "name" => get_user_by("ID", $jge6)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge6),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge7)->ID,
        //                                         "name" => get_user_by("ID", $jge7)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge7),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge8)->ID,
        //                                         "name" => get_user_by("ID", $jge8)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge8),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge9)->ID,
        //                                         "name" => get_user_by("ID", $jge9)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge9),
        //                                     ],
        //                                     [
        //                                         "judge_id" => get_user_by("ID", $jge10)->ID,
        //                                         "name" => get_user_by("ID", $jge10)->display_name,
        //                                         "avatar" => get_field("profile_image", "user_" . $jge10),
        //                                     ],
        //                                 ];

        $comp[$c]["tags"]             = $tag_string;
        $comp[$c]["status"]           = $status;
        $comp[$c]["entry_listing_id"] = getTermsIdWOLink(  $Each_competetion->competetionName  );
        $c++;
      }
        $data = [ "comeptition_detail" => $comp,];
    return $data;
}