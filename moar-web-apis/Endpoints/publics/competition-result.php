<?php
// register_rest_route("comp-result/", "comp-result-list", [
//     "method" => "POST",
//     "Authorization" => base64_encode("admin:admin"),
//     "callback" => "result_competition",
// ]);
// $topper_class = 0;
// function result_competition($request_data)
// {
//     $getParams = $request_data->get_params();
//     // pagination code start
//     if (isset($getParams["page"])) {
//         $page = $getParams["page"];
//     } else {
//         $page = 1;
//     }
//     if (isset($getParams["perPage"])) {
//         $limitofRecords = $getParams["perPage"];
//     } else {
//         $limitofRecords = 10;
//     }
//     $offset = ($page - 1) * $limitofRecords;

//     $getParamCustomTableId = $getParams[comp_];
//     global $wpdb;
//     $totalNJ = $wpdb->get_results( "SELECT count(*) as totalJudge FROM `wp_JudgeVotes` WHERE `compId`='" . $getParamCustomTableId .  "' GROUP BY `judgeId`;" );
//     $countJudg = [];
//     foreach ($totalNJ as $juges) {
//         $countJudg[] = $juges->totalJudge;
//     }
//     $totalCompJudges       = count($countJudg);
//     $count_list            = $wpdb->get_results( "SELECT jv.compId as CompetitionID, jv.artistId,jv.ArtistName, jv.average as JudgeAverage, uv.votes as UserVotes  ,jv.song as song FROM judgevotesview jv LEFT OUTER JOIN (SELECT * FROM `uservotesviewnewtables`  WHERE `competitionId`='" . $getParamCustomTableId .
//             "') uv ON jv.artistId = uv.ArtistId WHERE jv.compId = '" .
//             $getParamCustomTableId .
//             "' GROUP BY jv.artistId ORDER BY sum(jv.average + uv.votes) DESC " );
//     $countjudgeMark         = $wpdb->get_results( "SELECT jv.compId as CompetitionID, jv.artistId,jv.ArtistName, jv.average as JudgeAverage, uv.votes as UserVotes ,jv.song as song FROM judgevotesview jv LEFT OUTER JOIN 
//                               (SELECT * FROM `uservotesviewnewtables` WHERE `competitionId`='" .  $getParamCustomTableId . "') uv  ON jv.artistId = uv.ArtistId WHERE jv.compId = '" . $getParamCustomTableId . "'
//                                GROUP BY jv.artistId ORDER BY sum(jv.average + uv.votes) DESC LIMIT {$offset} ,{$limitofRecords}" );
//     $total_users_vote_query = $wpdb->get_results(  "SELECT count(Id) as totalUsers FROM `wp_uservotes` WHERE `competitionId`='" .  $getParamCustomTableId .  "' ");
//     foreach ($total_users_vote_query as $totalUsersVote) {
//         $totalUserVotes     = $totalUsersVote->totalUsers;
//     }
//     if (count($countjudgeMark) > 0) {
//         $increes = 0;
//         $c       = 0;
//         foreach ($countjudgeMark as $topresult) {
//             $topFive[$c][comp_]     = $increes++;
//             $topFive[$c]["avatar"] = get_field(  "profile_image", "user_" . $topresult->artistId  );
//             $topFive[$c]["name"]   = get_user_by(  "ID", $topresult->artistId )->display_name;
//             $topper_class++;
//             if ($topper_class == 5) {
//                 break;
//             }
//             $c++;
//           }
//         } else {
//             $topFive["message"]    = "No Result found";
//         }
//     $data = [  "top_5_result" => $topFive,
//                "page" => $page,
//                "perPage" => $limitofRecords,
//                "total" => count($count_list),
//              ];
//     return $data;
// }
// **********************************************************************top ten resutl
register_rest_route("v1/", "top_results", [
                                        "methods" => "GET",
                                        "callback" => "comp_results",
                                    ]);
function comp_results($params)
{
    $getParams = $params->get_params();
    // pagination code end
    $getParamCustomTableId = $getParams["comp_id"];
    global $wpdb;
    $totalNJ = $wpdb->get_results(
        "SELECT count(*) as totalJudge FROM `wp_JudgeVotes` WHERE `compId`='" .  $getParamCustomTableId .  "' GROUP BY `judgeId`;" );
    $countJudg = [];
    foreach ($totalNJ as $juges) {
        $countJudg[] = $juges->totalJudge;
    }
    $totalCompJudges = count($countJudg);
    $count_list = $wpdb->get_results(
        "SELECT jv.compId as CompetitionID, jv.artistId,jv.ArtistName, jv.average as JudgeAverage, uv.votes as UserVotes
        ,jv.song as song FROM judgevotesview jv LEFT OUTER JOIN (SELECT * FROM `uservotesviewnewtables` 
        WHERE `competitionId`='" .
            $getParamCustomTableId .
            "') uv ON jv.artistId = uv.ArtistId WHERE jv.compId = '" .
            $getParamCustomTableId .
            "' GROUP BY jv.artistId ORDER BY sum(jv.average + uv.votes) DESC "
    );
    $countjudgeMark = $wpdb->get_results(
        "SELECT jv.compId as CompetitionID, jv.artistId,jv.ArtistName, jv.average as JudgeAverage, uv.votes as UserVotes
        ,jv.song as song FROM judgevotesview jv LEFT OUTER JOIN (SELECT * FROM `uservotesviewnewtables` 
        WHERE `competitionId`='" .
            $getParamCustomTableId .
            "') uv ON jv.artistId = uv.ArtistId WHERE jv.compId = '" .
            $getParamCustomTableId .
            "' GROUP BY jv.artistId ORDER BY sum(jv.average + uv.votes) DESC "
    );
    $total_users_vote_query = $wpdb->get_results( "SELECT count(Id) as totalUsers FROM `wp_uservotes` WHERE `competitionId`='" . $getParamCustomTableId . "'" );
    $getting_name = $wpdb->get_results(  "SELECT * FROM `wp_competetion` WHERE `Id`='" . $getParamCustomTableId . "'" );
    foreach ($getting_name as $getname) {
        $comp_name = $getname->competetionName;
    }
    foreach ($total_users_vote_query as $totalUsersVote) {
        $totalUserVotes = $totalUsersVote->totalUsers;
    } 
     if (count($countjudgeMark)>0) {
                        $serial=1;
                            foreach($countjudgeMark as $key=> $singleResult ) {  ?>
                            <?php $uservotes=$singleResult->UserVotes !=="NULL" ?$singleResult->UserVotes:0;
                                $judgeEnd=$singleResult->JudgeAverage/$totalCompJudges;
                                $userEnd= ($uservotes/$totalUserVotes)*20;
                                ?>
                        <?php
                        if($singleResult->JudgeAverage){
                            $singleResult->JudgeAverage=number_format(abs($userEnd+$judgeEnd),2);
                        }
                        $topper_class++;
                        if ($topper_class == 10) break;
                    } 
                     $items = array();
                            foreach($countjudgeMark as $username) {
                            $items[] = $username;
                            }?>
                <?php	array_multisort($items , SORT_DESC);
		        $sorted = val_sort_new($items, 'JudgeAverage');
                $sortedArray =array_reverse($sorted); 
            ?>
            <?php
            $top_five_inc = 0;
             $serial = 1;
            $topFive=[];
              foreach ($sortedArray as $sorted) {
                $topFive[$top_five_inc]["sr"] = $serial++;
                $topFive[$top_five_inc]["name"] = $sorted->ArtistName;
                $topFive[$top_five_inc]["content_name"] = $sorted->song;
                $topFive[$top_five_inc]["avatar"] = get_field(  "profile_image", "user_" . $sorted->artistId  );
                $topFive[$top_five_inc]["name"]   = get_user_by(  "ID", $sorted->artistId )->display_name;
                $topFive[$top_five_inc]["points"] = $sorted->JudgeAverage;
                $topFive[$top_five_inc]["artist_id"]   =  $sorted->artistId;
                $top_five_inc++;
                if($top_five_inc==5){
                    break;
                }
            }
             $top_ten_inc = 0;
             $toptenSr = 1;
             $top_ten=[];
            foreach ($sortedArray as $topten) {
                $top_ten[$top_ten_inc]["sr"] = $toptenSr++;
                $top_ten[$top_ten_inc]["name"] = $topten->ArtistName;
                $top_ten[$top_ten_inc]["content_name"] = $topten->song;
                $top_ten[$top_ten_inc]["avatar"] = get_field(  "profile_image", "user_" . $topten->artistId  );
                $top_ten[$top_ten_inc]["name"]   = get_user_by(  "ID", $topten->artistId )->display_name;
                $top_ten[$top_ten_inc]["points"] = $topten->JudgeAverage;
                 $top_ten[$top_five_inc]["artist_id"]   =  $topten->artistId;
                $top_ten_inc++;
                if($top_ten_inc==10){
                    break;
                }
            }
            // count conditition
             $message=["status"=> true, "message"=>"Records found"];
             $get_res= new WP_REST_Response( [  "top_five_result" => $topFive,
                                        "top_ten_result" => $top_ten,
                                        "response"     =>  $message,
                                        ]);
                $get_res->set_status(200);
                return $get_res;
            } else {
                $topFive=[];
                $top_ten=[];
                $message=["status"=> false, "message"=>"Records not found"];
                $get_res= new WP_REST_Response( [  "top_five_result" => $topFive,
                                        "top_ten_result" => $top_ten,
                                        "response"     =>  $message,
                                        ]);
                $get_res->set_status(404);
                return $get_res;
            }
          
    
}
?>
