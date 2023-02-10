<?php
session_start();
require_once('link.php');
if (!isset($_SESSION['user'])) {
    header("Location: index");
} else {
    if (isset($_POST['playlist_id'])) {
        $playlist_id = mysqli_real_escape_string($con, $_POST['playlist_id']);
        $video_id = mysqli_real_escape_string($con, $_POST['video_id']);
        $start = mysqli_real_escape_string($con, $_POST['start']);       

                $query = "SELECT * FROM `video_list` WHERE `playlist`= '$playlist_id' limit $start,5";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    $i = 1+ $start;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $playlist_id2 = $row['playlist'];                                                                                              
                        $chapter_name = $row['title'];                                               
                        $chapter_img= $row['img_maxres'];
                        $v_id2=$row['video_id'];
                        if ($row['video_id'] == $video_id) {
                ?>
                            <div class="titleCardList--container episode-item current" tabindex="0" aria-label="Episode <?php echo $i; ?>" role="button" onclick="VidPlay2('<?= $v_id2 ?>','<?= $playlist_id2 ?>')">
                                <div class="titleCard-title_index"><?php echo $i; ?></div>
                                <div class="titleCard-imageWrapper">
                                    <div class="ptrack-content"><img src="<?= $chapter_img ?>" alt="Everything's Coming Up Lucifer">
                                    </div>
                                    <div class="titleCard-playIcon">
                                        <svg viewBox="0 0 24 24" class="titleCard-playSVG">
                                            <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <!-- <progress class="titleCard-progress" max="1" value="0.5121304018195603"></progress> -->
                                </div>
                                <div class="titleCardList--metadataWrapper">
                                    <div class="titleCardList-title">
                                        <span class="titleCard-title_text">Episode <?php echo $i; ?></span>
                                        <!-- <span><span class="duration ellipsized">48m</span></span> -->
                                    </div>
                                    <p class="titleCard-synopsis previewModal--small-text"><?php echo $row['title'] ?>
                                    </p>
                                </div>

                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="titleCardList--container episode-item" tabindex="0" aria-label="Episode <?php echo $i; ?>" role="button" onclick="VidPlay2('<?= $v_id2 ?>','<?= $playlist_id2 ?>')">
                                <div class="titleCard-title_index"><?php echo $i; ?></div>
                                <div class="titleCard-imageWrapper">
                                    <div class="ptrack-content"><img src="<?= $chapter_img ?>">
                                    </div>
                                    <div class="titleCard-playIcon">
                                        <svg viewBox="0 0 24 24" class="titleCard-playSVG">
                                            <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <!-- <progress class="titleCard-progress" max="1" value="0.5121304018195603"></progress> -->
                                </div>
                                <div class="titleCardList--metadataWrapper">
                                    <div class="titleCardList-title">
                                        <span class="titleCard-title_text">Episode <?php echo $i; ?></span>
                                        <!-- <span><span class="duration ellipsized">48m</span></span> -->
                                    </div>
                                    <p class="titleCard-synopsis previewModal--small-text"><?php echo $row['title'] ?>
                                    </p>
                                </div>

                            </div>
            <?php
                        }
                        $i = $i + 1;
                    }
                }
            }
        
        }

    ?>