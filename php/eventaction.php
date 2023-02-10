<?php

session_start();
ini_set( "display_errors", 0); 
// require './php/config.php';
require 'config.php';

  if(isset($_POST['selectindex']) && isset($_POST['selectedid']) &&  isset($_POST['selectevent']) ){

    $selectindex = $_POST['selectindex'];
    $selectedid = $_POST['selectedid'];
    $selectevent = $_POST['selectevent'];
    echo $selectevent;
    $j = 1 ;
// Product_1_no _video_watched
    $tablename = 'event_'.$selectevent.'_no_video_watched';

    $query = "SELECT * FROM `users` WHERE id = $selectedid";
    //getting email of customer
             if ($result = mysqli_query($conn, $query)) {
                     while( $row = mysqli_fetch_array($result)){
                    $customremail = $row['email'] ;
                    // $last_played_vide = $row['event_1_last_played_video'] ;
                    $no_of_watched_video = $row[$tablename] ;
                    if($no_of_watched_video != " "){
                    $no_of_watched_videos = explode("-",$no_of_watched_video);
                    for ($i = 0;$i < sizeof($no_of_watched_videos);$i++ )
                    {
                            $no_of_watched_videoss = $no_of_watched_videos[$i];

                            if( number_format($no_of_watched_videoss ,0) == $selectindex )
                            {
                             $j = 0 ;
                             
                            }
                            else{
                              // echo "good";
                            
                            }
                    }
                    if( $j == 1 ){
                    $final_no_of_watched_video = $no_of_watched_video.$selectindex."-" ;
                    $query = "UPDATE `users` SET `$tablename` =  '".mysqli_real_escape_string($conn, $final_no_of_watched_video)."' WHERE id = $selectedid";
                    if(!$result = mysqli_query($conn, $query)){
                      die('Error occured [' . $conn->error . ']');
              
                      }
                      else{
                           // echo "good";
                    $data['status'] = 201;
                    $data['id'] = "good not at all first";
                    echo json_encode($data);
               
                      
                      }
                    }
                  }else{
                    $final_no_of_watched_video = $selectindex."-" ;
                    $query = "UPDATE `users` SET `$tablename` =  '".mysqli_real_escape_string($conn, $final_no_of_watched_video)."' WHERE id = $selectedid";
                    // mysqli_query($conn, $query);
                    if(!$result = mysqli_query($conn, $query)){
                      die('Error occured [' . $conn->error . ']');
              
                      }
                      else{
                           // echo "good";
                    $data['status'] = 201;
                    $data['id'] = "good not at all first";
                    echo json_encode($data);
               
                      
                      }
                  
                  }


                  
              }
    
      }
  }



?>