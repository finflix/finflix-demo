<?php
session_start();
require_once('link.php');
if (!isset($_SESSION['user'])) {
    header("Location: index");
} else {
    if (isset($_POST['start'])) {
        $start = mysqli_real_escape_string($con, $_POST['start']);
        $playlist_id = mysqli_real_escape_string($con, $_POST['playlist_id']);    

            $query = "SELECT * FROM  `video_list` WHERE `playlist`= '$playlist_id' limit $start,8";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $i = 1+ $start;
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = $row['img_maxres'];
                    // $image = $row['img_standard'];                    
                    $name = $row['title'];
                    $playlist_id = $row['playlist'];
                    $video_id = $row['video_id'];
                    $desc = $row['description'];
                    $time = $row['published_at'];
                    $new_name = str_replace("'"," ",$name);
                    
        ?>
            
        <div class="col-lg-3 col-md-6 col-sm-12 my-3 more_video_div">
                <a href="videoPlayer.php?data-key=<?= $video_id ?>&playlist_id=<?= $playlist_id ?>">
                    <div class="block-images position-relative">
                        <div class="img-box">
                            <img src="<?= $image ?>" class="img-fluid" alt="">
                        </div>
                        <div class="block-description">
                            <h6><?php echo $name ?></h6>
                            <div class="movie-time d-flex align-items-center my-2">
                                <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                <span class="text-white"><?= $i; ?></span>
                            </div>
                            <div class="hover-buttons">
                                <a href="videoPlayer.php?data-key=<?= $video_id ?>&playlist_id=<?= $playlist_id ?>" class="btn btn-hover"><i class="fa fa-play mr-1" aria-hidden="true"></i>
                                    Play Now</a>
                            </div>
                        </div>
                        <div class="block-social-info">
                            <ul class="list-inline p-0 m-0 music-play-lists">
                                <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                <li onclick="myVid('<?= $video_id ?>','<?= $new_name ?>','<?= $desc ?>','<?= $time ?>','<?= $image ?>','<?= $playlist_id ?>')"><span><i class="ri-heart-fill"></i></span></li>
                                <!-- <li><span><i class="ri-information-fill"></i></span></li> -->
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        <?php  $i = $i + 1;
        }
    }
                        
    }
}
?>