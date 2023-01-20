<?php

register_rest_route("home-ep/", "home-listing", [
    "methods" => "POST",
    "callback" => "home_endpoint",
]);
function home_endpoint($request_data)
{
    $slider = [];
    $comp = [];
    $audioSong = [];
    $whoslive = [];
    $recommended = [];
    $videoSOng = [];
    $data = [];
    $SaveFeatur_Artist = [];

    $user_args = [
        "role" => "Artist",
    ];
    $users_list = get_users($user_args);
    $fr = 0;
    $topper_class = 1;
    function CounterAlbum($Uid)
    {
        $countposts = [
            "post_type" => "artist_cpt",
            "post_status" => "publish",
            "author" => $Uid,
            // no limit
        ];
        $current_user_posts = get_posts($countposts);
        $total = count($current_user_posts);
        return !empty($total) ? $total : "0";
    }
    function albums($userId_album)
    {
        global $wpdb;
        $albumOne = $wpdb->get_results(
            'SELECT count(*) as userAlbums FROM `wp_termmeta` WHERE `meta_value`="' .
                $userId_album .
                '"'
        );

        foreach ($albumOne as $album) {
            return $album->userAlbums;
        }
    }
    function artistname($id)
    {
        $author_obj_two = get_user_by("id", $id);
        foreach ($author_obj_two as $authorNames) {
            return esc_html($authorNames->display_name);
        }
    }
    function arprofilImage($id)
    {
        return get_field("profile_image", "user_" . $id);
    }

    $storeData = [];
    function headerTitle($headertitile)
    {
        $getFilter = json_decode($headertitile);
        foreach ($getFilter as $value) {
            foreach ($value->layers as $item) {
                foreach ($item->item as $values) {
                    $storeData[] = $values->heading;
                }
            }
        }
        return $storeData;
    }
    $arrayOfTopImage = [];
    function headertoImage($bannerTop)
    {
        $getFilter = json_decode($bannerTop);
        foreach ($getFilter as $value) {
            foreach ($value->layers as $item) {
                foreach ($item as $singleItem) {
                    $arrayOfTopImage[] = $singleItem->values->image;
                }
            }
        }
        return $arrayOfTopImage;
    }

    function filterCotent($filterContent)
    {
        $getFilter = json_decode($filterContent);
        foreach ($getFilter as $value) {
            foreach ($value->layers[5] as $item) {
                $contentStor = $item->values->content;
            }
        }
        return $contentStor;
    }
    //  welcome slider *************************************************************************
    $sl = 0;
    global $wpdb;
    $slides = $wpdb->get_results(
        "SELECT * FROM wp_nextend2_smartslider3_slides WHERE slider=5 ORDER BY Id DESC "
    );

    foreach ($slides as $Each_slides) {
        $slider[$sl]["title"] = headerTitle($Each_slides->slide)[9];
        $slider[$sl]["heading"] = headerTitle($Each_slides->slide)[1];
        $slider[$sl]["banner_image"] = str_replace(
            '$upload$',
            "http://192.168.100.34/wp-content/uploads/",
            json_decode($Each_slides->params)->backgroundImage
        );
        $slider[$sl]["content"] = filterCotent($Each_slides->slide);

        $slider[$sl]["bannerTopImage"] = str_replace(
            '$upload$',
            "http://192.168.100.34/wp-content/uploads/",
            headertoImage($Each_slides->slide)[63]
        );
        $slider[$sl]["thumbnail"] = str_replace(
            '$upload$',
            "http://192.168.100.34/wp-content/uploads/",
            $Each_slides->thumbnail
        );
        $sl++;
    }
    // competiton *************************************************************************
    $c = 0;
    global $wpdb;
    $competetion = $wpdb->get_results(
        "SELECT * FROM wp_Competetion ORDER BY Id DESC LIMIT 1, 5"
    );
    foreach ($competetion as $Each_competetion) {
        $comp[$c]["id"] = $Each_competetion->Id;
        $comp[$c]["title"] = $Each_competetion->competetionName;
        $comp[$c]["description"] = $Each_competetion->description;
        $comp[$c]["comp_entry_start_date"] =
            $Each_competetion->pickdateforContent;
        $comp[$c]["comp_end_date"] = $Each_competetion->Date;
        $comp[$c]["banner"] = $Each_competetion->media_document;
        $c++;
    }

    // audo songs *************************************************************************
    $audioSongArgs = [
        "post_type" => "artist_cpt",
        "post_status" => "publish",
        "posts_per_page" => 10,
        "order" => "DESC",
        "orderby" => "ID",
    ];
    $audio_query = get_posts($audioSongArgs);
    $j = 1;
    foreach ($audio_query as $song) {
        if (get_field("upload_audio_song", $song->ID)) {
            $audioSong[$j]["id"] = $song->ID;
            $audioSong[$j]["title"] = $song->post_title;
            $audioSong[$j]["artist"] = get_the_author_meta(
                "display_name",
                $song->post_author
            );
            $audioSong[$j]["song_url"] = get_field(
                "upload_audio_song",
                $song->ID
            );
            $audioSong[$j]["views"] = 0;
            $j++;
        }
    }
    //  who's live section*******************************************************************
    $whoslive[0]["poster"] =
        "http://192.168.100.34/wp-content/uploads/2021/08/whosLive.png";
    $whoslive[0]["description"] =
        "It is a long established fact that a reader will be distracted by the readable.";
    $whoslive[0]["readmore"] = "#";

    $whoslive[1]["poster"] =
        "http://192.168.100.34/wp-content/uploads/2021/08/whosLive.png";
    $whoslive[1]["description"] =
        "It is a long established fact that a reader will be distracted by the readable.";
    $whoslive[1]["readmore"] = "#";

    $whoslive[2]["poster"] =
        "http://192.168.100.34/wp-content/uploads/2021/08/whosLive.png";
    $whoslive[2]["description"] =
        "It is a long established fact that a reader will be distracted by the readable.";
    $whoslive[2]["readmore"] = "#";
    // recommende section*******************************************************************
    $recommended[0]["image_url"] =
        "http://192.168.100.34/wp-content/uploads/2021/08/Ali.png";
    $recommended[0]["title"] =
        "Our listeners think that Saad sings from heart, here's why ";
    $recommended[0]["description"] =
        "It is a long established fact that a reader will be distracted by the readable.";

    $recommended[1]["image_url"] =
        "http://192.168.100.34/wp-content/uploads/2021/08/Ali.png";
    $recommended[1]["title"] =
        "Our listeners think that Saad sings from heart, here's why ";
    $recommended[1]["description"] =
        "It is a long established fact that a reader will be distracted by the readable.";

    $recommended[2]["image_url"] =
        "http://192.168.100.34/wp-content/uploads/2021/08/Ali.png";
    $recommended[2]["title"] =
        "Our listeners think that Saad sings from heart, here's why ";
    $recommended[2]["description"] =
        "It is a long established fact that a reader will be distracted by the readable.";
    //  video songs *************************************************************************

    $videos = [
        "post_type" => "artist_cpt",
        "post_status" => "publish",
        "posts_per_page" => -1,
        "order" => "DESC",
        "orderby" => "ID",
    ];

    $the_video_query = get_posts($videos);

    $i = 0;
    foreach ($the_video_query as $video_song) {
        global $post;
        if (
            get_field("upload_video", $video_song->ID) &&
            get_post_meta($video_song->ID, "post_reading_time", true)[0] == 1
        ) {
            $videoSOng[$i]["id"] = $video_song->ID;
            $videoSOng[$i]["title"] = $video_song->post_name;
            $videoSOng[$i]["artist"] = get_the_author_meta(
                "display_name",
                $video_song->post_author
            );
            $videoSOng[$i]["video_url"] = get_field(
                "upload_video",
                $video_song->ID
            );
            $i++;
        }
    }

    // featured artists *************************************************************************
    $categories = get_categories($get_count_post);
    foreach ($users_list as $user) {
        if (get_user_meta($user->ID, "featur_user", true)[0] == 1) {
            $SaveFeatur_Artist[$fr]["artist_id"] = $user->ID;
            $SaveFeatur_Artist[$fr]["artist_profile_image"] = arprofilImage(
                $user->ID
            );
            $SaveFeatur_Artist[$fr]["artist_name"] = artistname($user->ID);
            $SaveFeatur_Artist[$fr]["fans"] = "655344";
            $SaveFeatur_Artist[$fr]["description"] = get_field(
                "description",
                "user_" . $user->ID
            );
            $SaveFeatur_Artist[$fr]["album"] = albums(
                !empty($user->ID) ? $user->ID : 1
            );
            $SaveFeatur_Artist[$fr]["single"] = CounterAlbum($user->ID);
            $SaveFeatur_Artist[$fr]["concerts"] = "0";
            $SaveFeatur_Artist[$fr]["track"] = "0";
            $fr++;
            $topper_class++;
            if ($topper_class == 4) {
                break;
            }
        }
    }
    // $data["status"]='OK';
    // $data["message"]='hellow tested for home page';
    $data = [
        "welcome_slider" => $slider,
        "Prove your metal - Compete against Other Artists" => $comp,
        "Today's Highlights" => $audioSong,
        "Who's Live" => $whoslive,
        "featurd_artists" => $SaveFeatur_Artist,
        "Recommended for you" => $recommended,
        "Editor's choice" => $videoSOng,
    ];
    return $data;
    //     }
    //       else{
    //         $data["status"]='Ok';
    //         $data["message"]="user and password is incorrect";
    //         return $data;
    //       }
    //   } else{
    //     $data["status"]="Ok";
    //     $data["message"]="user name is not set.";
    //   return $data;
    // }
}
?>
