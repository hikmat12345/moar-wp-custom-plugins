<?php
    register_rest_route(
        'upload_file/', // Namespace
        'attachement', // Endpoint
        array(
            'methods'  => 'POST',
            'callback' => 'attachment_fun'
        )
    );
function attachment_fun(WP_REST_Request  $request_data ) {
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    $parameters = $request_data->get_params();
    //var_dump($parameters);
    $wp_file = $parameters['file'];
    if ( isset($file) ) {
        $file = array( 
            $name = $wp_file['name'],
            $type = $wp_file['type'], 
            $tmp_name = $wp_file['tmp_name'], 
            $error = $wp_file['error'],
            $size = $wp_file['size']
        );
        wp_handle_upload($wp_file, $overrides);
    } else {
        $data['status'] = 'Failed';
        $data['message'] = "File not uploaded something missing";  
    }
    // t testing code
    // $geturl=get_site_url();
    // $file = file_get_contents('http://192.168.100.34/moar_wp/wp-content/uploads/2021/09/joel-muniz-QadWZdWSe_8-unsplash.png' );
    // $url = "{$geturl}/wp-json/wp/v2/media/";
    // $ch = curl_init();
    // $username = 'MoarAdmin';
    // $password = 'moaradmin';
    // curl_setopt( $ch, CURLOPT_URL, $url );
    // curl_setopt( $ch, CURLOPT_POST, 1 );
    // curl_setopt( $ch, CURLOPT_POSTFIELDS, $file );
    // curl_setopt( $ch, CURLOPT_HTTPHEADER, [
    //     'Content-Disposition: form-data; filename="example.jpg"',
    //     'Authorization: Basic ' . base64_encode( $username . ':' . $password ),
    // ] );
    // $result = curl_exec( $ch );
    // curl_close( $ch );
    // print_r( json_decode( $result ) );
     return $_POST;
}