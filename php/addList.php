<?php
session_start();
require_once('link.php');
$client = 'https://ipfs.fleek.co/ipfs/';
if (!isset($_SESSION['userAddress'])) {
    header("Location: index");
} else {
    if (isset($_POST['fetch'])) {
        $user_address = ($_SESSION['userAddress']);
        $query = "SELECT * FROM `favourite_videos` INNER JOIN `video_info` ON `favourite_videos`.`video_info_id`=`video_info`.`video_uuid` WHERE `user_id`= '$user_address' ORDER BY `favourite_videos`.`favourite_video_id` DESC LIMIT 10";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
?>
<ul class="favorites-slider list-inline row p-0 mb-0 ccc">
    <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
               $thumbnail = $client.$row['thumbnail_ipfs'];
               $video_id = $row['video_uid'];
               $chapter_part = $row['video_id'];
               $chapter_name = $row['name'];
               $chapter_id = $row['video_id'];
               $module_name = $row['module'];
               $video_uuid = $row['video_uuid'];
            ?>
    <li class="slide-item">
        <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>">
            <div class="block-images position-relative">
                <div class="img-box">
                    <img src="<?php echo $thumbnail; ?>" class="img-fluid">
                </div>
                <div class="block-description">
                    <h6><?php echo  $chapter_name ?></h6>
                    <div class="movie-time d-flex align-items-center my-2">
                        <div class="badge badge-secondary p-1 mr-2">Added</div>
                        <span class="text-white"><?php echo $row['from_time']; ?></span>
                    </div>
                    <div class="hover-buttons">
                        <a href="videoPlayer.php?course=<?= $video_id ?>&module=<?= $module_name ?>"
                            class="btn btn-hover">
                            <i class="fa fa-play mr-1" aria-hidden="true"></i>
                            Play Now
                        </a>
                    </div>
                </div>
                <div class="block-social-info">
                    <ul class="list-inline p-0 m-0 music-play-lists">
                        <li><span><i class="ri-volume-mute-fill"></i></span></li>
                        <li onclick="removeVid('<?php echo $user_address ?>','<?php echo $video_uuid ?>')"><span><i
                                    class="ri-heart-fill"></i></span></li>
                    </ul>
                </div>
            </div>
        </a>
    </li>
</ul>
<?php
            }
        }
        }
    }
    ?>