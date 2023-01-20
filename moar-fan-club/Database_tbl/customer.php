<?php
// function bms_customers_tbl_fun() {
//     global $wpdb;

//     $table_name = $wpdb->prefix . "bms_customer_tbl";
//     $charset_collate = $wpdb->get_charset_collate();

//     $sql = "CREATE TABLE IF NOT EXISTS $table_name (
//     id mediumint(9) NOT NULL AUTO_INCREMENT,
//     name text NOT NULL,
//     email text NOT NULL,
//     address text NOT NULL,
//     contact text NOT NULL,
//     employment text NOT NULL, 
//     PRIMARY KEY  (id)
//     ) $charset_collate;";

//     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//     dbDelta( $sql );
// }
// // user signup form
// function bms_signup()
//   {
//     global $wpdb;
//     $signupTbl=$wpdb->prefix.'Competetion';
//     $charset_collate_signup=$wpdb->get_charset_collate();
//     $signupSql="CREATE TABLE IF NOT EXISTS $signupTbl(
//                  Id int(50) NOT NULL AUTO_INCREMENT,
//                  competetionName varchar(100) NOT NULL,
//                  competetionKey varchar(200) NOT NULL,
//                  Date varchar(100) NOT NULL,
//                  Time varchar(100) NOT NULL,
//                  country varchar(100) NOT NULL,
//                  state varchar(100) NOT NULL,
//                  PRIMARY KEY (Id)
//                ) $charset_collate_signup";
//     require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//     dbDelta( $signupSql );
//   }

//   // user voting table
// function user_voting()
// {
//   global $wpdb;
//   $votingTable=$wpdb->prefix.'uservotes';
//   $charset_collate_votingTable=$wpdb->get_charset_collate();
//   $votingSqlTable="CREATE TABLE IF NOT EXISTS $votingTable(
//                Id int(50) NOT NULL AUTO_INCREMENT,
//                UserId varchar(50) NOT NULL,
//                UserRole varchar(100) NOT NULL,
//                UserIP varchar(100) NOT NULL,
//                UserEmail varchar(100) NOT NULL,
//                DateTime DATETIME,
//                PRIMARY KEY (Id)
//              ) $charset_collate_signup";
//   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//   dbDelta( $votingSqlTable );
// }


//  // enable content table
//  function enable_content_artist()
//  {
//    global $wpdb;
//    $EnableContentArtistForCmpetetion=$wpdb->prefix.'ArtistEnableContent';
//    $charset_collate_ecafc=$wpdb->get_charset_collate();
//    $EnableContentArtistForCmpetetionTable="CREATE TABLE IF NOT EXISTS $EnableContentArtistForCmpetetion(
//                 Id int(50) NOT NULL AUTO_INCREMENT,
//                 status varchar(50) NOT NULL,
//                 PRIMARY KEY (Id)
//               ) $charset_collate_signup";
//    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//    dbDelta( $EnableContentArtistForCmpetetionTable );
//  }