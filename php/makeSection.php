<?php
session_start();
require_once('link.php');
if (!isset($_SESSION['user'])) {
    header("Location: index");
} else {
    if (isset($_POST['start'])) {
        $start = mysqli_real_escape_string($con, $_POST['start']);    

            $query = "SELECT * FROM  `playlist_list` WHERE 1 limit $start,5";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $playlist_id = $row['playlist_id'];
                    $playlist_title = $row['title'];
                    
        ?>
            <section id="iq-upcoming-movie">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title"><a href="movie-category.html"><?= $playlist_title ?></a></h4>
                        </div>
                        <div class="upcoming-contens">
                            <ul class="favorites-slider list-inline row p-0 mb-0 jj<?= $start ?>">
                                <?php
                                    $query2 = "SELECT * FROM  `video_list` WHERE `playlist` = '$playlist_id' limit 8";
                                    $result2 = mysqli_query($con, $query2);
                                    if (mysqli_num_rows($result2) > 0) {
                                        $i = 1;
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $video_title = $row2['title'];
                                            $image_link = $row2['img_maxres'];
                                            $playlist_id= $row2['playlist'];
                                            $video_id= $row2['video_id'];
                                            $image = $row2['img_maxres'];
                                            $name = $row2['title'];                
                                            $desc = $row2['description'];
                                            $time = $row2['published_at'];
                                            $new_name = str_replace("'", " ", $name);
                                            if($i<=7){
                                        ?>
                                        <li class="slide-item" data-key="<?= $video_id ?>">
                                            <a href="videoPlayer.php?data-key=<?= $video_id ?>&playlist_id=<?= $playlist_id ?>">
                                                <div class="block-images position-relative">
                                                    <div class="img-box">
                                                        <img src="<?= $image_link ?>" class="img-fluid">
                                                    </div>
                                                    <div class="block-description">
                                                        <h6><?= $video_title ?></h6>
                                                        <div class="movie-time d-flex align-items-center my-2">
                                                        <div class="badge badge-secondary p-1 mr-2">Episode</div>
                                                        <span class="text-white"><?= $i; ?></span>
                                                        </div>
                                                        <div class="hover-buttons">
                                                        <a href="videoPlayer.php?data-key=<?= $video_id ?>&playlist_id=<?= $playlist_id ?>" class="btn btn-hover">
                                                        <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                                        Play Now
                                                        </a>
                                                        </div>
                                                    </div>
                                                    <div class="block-social-info">
                                                        <ul class="list-inline p-0 m-0 music-play-lists">
                                                            <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                                            <li onclick="myVid('<?= $video_id ?>','<?= $new_name ?>','<?= $desc ?>','<?= $time ?>','<?= $image ?>','<?= $playlist_id ?>')"><span><i class="ri-heart-fill"></i></span></li>
                                                            <li onclick="popup('<?= $playlist_id ?>','<?= $video_id ?>');"><span><i class="ri-information-fill"></i></span></li>                                 
                                                        </ul>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php 
                                            }else{
                                                ?>                                                
                                                <li class="slide-item set-width" data-key="<?= $video_id ?>" style="z-index:0">
                                                    <a href="view-more.php?data-key=<?= $video_id ?>&playlist_id=<?= $playlist_id ?>">
                                                        <div class="block-images position-relative more_view" style="transform: none;">
                                                            
                                                            <div class="img-box">
                                                                <img src="<?= $image_link ?>"
                                                                    class="img-fluid">
                                                            </div>
                                                            <div class="sideapnel" style="background:rgba(245, 23, 23, 0.5);">
                                                                <div class="block-description d-flex justify-content-center text-center setDesc"
                                                                    style="width: 100%;animation: fadeIn 0.6s ease-in-out;opacity: 1;left:0;display:block !important;">                                                    
                                                                    <div class="hover-buttons d-flex justify-content-center">
                                                                    <div class="playlisticon">
                                                                    <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet"
                                                                        focusable="false" class="style-scope yt-icon"
                                                                        style="pointer-events: none; display: block; width: 100%; height: 100%;" fill="#fff">
                                                                        <g class="style-scope yt-icon">
                                                                            <path
                                                                                d="M3.67 8.67h14V11h-14V8.67zm0-4.67h14v2.33h-14V4zm0 9.33H13v2.34H3.67v-2.34zm11.66 0v7l5.84-3.5-5.84-3.5z"
                                                                                class="style-scope yt-icon">
                                                                            </path>
                                                                        </g>
                                                                    </svg>
                                                                <h3 class="text-center" style="font-size:1.5rem;">View More</h3>                                                                    
                                                                </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                          
                                                        </div>                                                        
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                $i = $i + 1;
                            }}?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <?php }} 
    }
}
?>