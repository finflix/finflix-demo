<?php
session_start();
require_once('link.php');
if (!isset($_SESSION['user'])) {
    header("Location: index");
} else {
    if (isset($_POST['course'])) {
        $course = mysqli_real_escape_string($con, $_POST['course']);
        $chapter = mysqli_real_escape_string($con, $_POST['chapter']);

        $query2 = "SELECT * FROM `chapter` WHERE `chapter_id`= '$chapter'";
        $result2 = mysqli_query($con, $query2);
        if (mysqli_num_rows($result2) > 0) {
            $i = 1;
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $Bigcourse = $row2['course_id'];
                $Bigmodule = $row2['module_id'];
                $Bigchapter_part = $row2['chapter_part'];
                $Bigchapter_name = $row2['chapter_name'];
                $Bigchapter_id = $row2['chapter_id'];
                $Bigchapter_img= $row2['chapter_thumbnail'];
?>
                <div class="previewModal--player_container detail-modal">
                    <div class="videoMerchPlayer--boxart-wrapper" style="position: absolute;">
                        <img alt="" src="<?= $img_link ?><?= $Bigchapter_img ?>" aria-hidden="true" style="display: none;">
                    </div>
                    <div class="storyArt detail-modal">
                        <img src="<?= $img_link ?><?= $Bigchapter_img ?>" class="playerModel--player__storyArt detail-modal" alt="Money Heist" style="opacity: 1;">
                        <img alt="" src="<?= $img_link ?><?= $Bigchapter_img ?>" aria-hidden="true" style="display: none;">
                    </div>
                    <div>
                        <div class="previewModal--player-titleTreatmentWrapper" style="opacity: 1;">
                            <div class="previewModal--player-titleTreatment-left previewModal--player-titleTreatment detail-modal has-progress detail-modal">
                                <!-- <img alt="" src="https://occ-0-2590-2164.1.nflxso.net/dnm/api/v6/tx1O544a9T7n8Z_G12qaboulQQE/AAAABXvH0T1WSL5DTOEz_QMuPijRAbxdwSo7_uMXUhW_lSKUGNIVZOgNfomSthYOhQ5NE7MhgI6pMVPmcS1-PoJYf_MLV98feoWykW-VFy1lGGEJVUHeoWQrFDbNc_-2GZegrAyUKLOOrWTeXHRvIJ8UIcssNUcFtLTXZSajS6QeNtcQ.webp?r=dc7" aria-hidden="true" style="display: none;">
                                <img class="previewModal--player-titleTreatment-logo" alt="Money Heist" title="Money Heist" src="https://occ-0-2590-2164.1.nflxso.net/dnm/api/v6/tx1O544a9T7n8Z_G12qaboulQQE/AAAABXvH0T1WSL5DTOEz_QMuPijRAbxdwSo7_uMXUhW_lSKUGNIVZOgNfomSthYOhQ5NE7MhgI6pMVPmcS1-PoJYf_MLV98feoWykW-VFy1lGGEJVUHeoWQrFDbNc_-2GZegrAyUKLOOrWTeXHRvIJ8UIcssNUcFtLTXZSajS6QeNtcQ.webp?r=dc7" style="width: 100%; opacity: 1;"> -->

                                <div class="buttonControls--container">
                                    <a tabindex="0" toolkitsize="medium" listid="" ranknum="-97" requestid="" rownum="-97" trackid="14277281" role="link" aria-label="Resume" class="primary-button playLink isToolkit" href="videoPlayer.php?course=<?= $Bigcourse ?>&module=<?= $Bigmodule?>&chapter=<?php echo $Bigchapter_part?>">
                                        <button class="color-primary hasLabel hasIcon ltr-v8pdkb" tabindex="-1" type="button">
                                            <div class="ltr-1ksxkn9">
                                                <div class="medium ltr-shvwfm" role="presentation">
                                                    <svg viewBox="0 0 24 24">
                                                        <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ltr-1i33xgl" style="width: 1rem;"></div>
                                            <span class="ltr-zd4xih">Play</span>
                                        </button>
                                    </a>
                                </div>
                                <div class="buttonControls--messaging"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="previewModal-close" onclick="ClosePopup()">
                    <svg viewBox="0 0 24 24" role="button" aria-label="close" tabindex="0">
                        <path d="M12 10.586l7.293-7.293 1.414 1.414L13.414 12l7.293 7.293-1.414 1.414L12 13.414l-7.293 7.293-1.414-1.414L10.586 12 3.293 4.707l1.414-1.414L12 10.586z" fill="currentColor">
                        </path>
                    </svg>
                </div>
                <div class="previewModal--info" style="opacity: 1;">
                    <div class="detail-modal-container">
                        <div class="previewModal--detailsMetadata detail-modal">
                            <div class="previewModal--detailsMetadata-left">
                                <div class="previewModal--detailsMetadata-info">
                                    <div class="">
                                        <!-- <div class="videoMetadata--container">
                                            <div class="videoMetadata--first-line">
                                                <span class="match-score-wrapper">
                                                    <div class="show-match-score rating-inner">
                                                        <div class="meta-thumb-container thumb-down">
                                                            <svg class="svg-icon svg-icon-thumb-down-filled thumb thumb-down-filled" focusable="true">
                                                                <use filter="" xlink:href="#thumb-down-filled">
                                                                </use>
                                                            </svg>
                                                        </div>
                                                        <div class="meta-thumb-container thumb-up">
                                                            <svg class="svg-icon svg-icon-thumb-up-filled thumb thumb-up-filled" focusable="true">
                                                                <use filter="" xlink:href="#thumb-up-filled"></use>
                                                            </svg>
                                                        </div>
                                                        <span class="match-score">99% Match</span>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="videoMetadata--second-line">
                                                <div class="year">2021</div>
                                                <a href="#about">
                                                    <span class="maturity-rating ">
                                                        <span class="maturity-number">18+</span>
                                                    </span>
                                                </a>
                                                <span class="duration">4 Parts</span>
                                                <div class="video-metadata--adBadge-container">
                                                    <div class="ltr-79elbk">
                                                        <span class="audio-description-badge" aria-labelledby="episodesAudioDescriptionAvailable" data-tooltip="Audio Description is available for some episodes">
                                                            <svg class="svg-icon svg-icon-audio-description" focusable="true">
                                                                <use filter="" xlink:href="#audio-description">
                                                                </use>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- <div class="supplemental-message">It's Official: A Final Season Is Coming</div> -->
                                <div class="previewModal-episodeDetails"><b>Episode:</b> "<?php echo $row2['chapter_name'] ?>"</div>
                                <p class="preview-modal-synopsis previewModal--text"><?php echo $row2['chapter_desc'] ?></p>
                            </div>
                            <!-- <div class="previewModal--detailsMetadata-right">
                                <div class="previewModal--tags">
                                    <span class="previewModal--tags-label">Cast:</span>
                                    <span class="tag-item"><a href="/browse/person/40068460"> Úrsula Corberó,</a></span>
                                    <span class="tag-item"><a href="/browse/person/40162136">Álvaro Morte, </a></span>
                                    <span class="tag-item"><a href="/browse/person/40162203">Itziar Ituño, </a></span>
                                    <span class="tag-more"><a href="#about">more</a></span>
                                </div>
                                <div class="previewModal--tags">
                                    <span class="previewModal--tags-label">Genres:</span>
                                    <span class="tag-item"><a href="/browse/genre/81399657"> Spanish,</a></span>
                                    <span class="tag-item"><a href="/browse/genre/89811">TV Thrillers</a></span>
                                </div>
                                <div class="previewModal--tags">
                                    <span class="previewModal--tags-label">This show is:</span>
                                    <span class="tag-item"><a href="/browse/genre/100055"> Suspenseful,</a></span>
                                    <span class="tag-item"><a href="/browse/genre/100041">Exciting</a></span>
                                </div>
                            </div> -->
                        </div>
                        <div class="ptrack-container">
                            <div class="ptrack-content" data-tracking-uuid="16cf5ed9-7295-4f57-bdf5-6421b5ec37dd">
                                <div class="episodeSelector">
                                    <div class="episodeSelector-header">
                                        <p class="previewModal--section-header episodeSelector-label">Episodes</p>
                                        <!-- <div class="episodeSelector-dropdown">
                                    <div class="ltr-rqgsqp">
                                        <button aria-expanded="false" aria-haspopup="true" aria-label="dropdown-menu-trigger-button" class="dropdown-toggle ltr-111bn9j">Part 1</button>
                                    </div>
                                </div> -->
                                    </div>
                                    <div class="episodeSelector-container" id="takeEpisode">
                                        <!-- start -->
                                        <!-- end -->
                                        <!-- </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
                                        <?php
                                        $query = "SELECT * FROM `chapter` WHERE `course_id`= '$course'";
                                        $result = mysqli_query($con, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $course = $row['course_id'];
                                                $module = $row['module_id'];
                                                $chapter_part = $row['chapter_part'];
                                                $chapter_name = $row['chapter_name'];
                                                $chapter_id = $row['chapter_id'];
                                                $chapter_img= $row2['chapter_thumbnail'];
                                                if ($row['chapter_id'] == $chapter) {
                                        ?>
                                                    <div class="titleCardList--container episode-item current" tabindex="0" aria-label="Episode <?php echo $i; ?>" role="button" onclick="VidPlay(<?= $course ?>,<?= $module ?>,<?= $chapter_part ?>)">
                                                        <div class="titleCard-title_index"><?php echo $i; ?></div>
                                                        <div class="titleCard-imageWrapper">
                                                            <div class="ptrack-content"><img src="<?= $img_link ?><?= $Bigchapter_img ?>" alt="Everything's Coming Up Lucifer">
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
                                                            <p class="titleCard-synopsis previewModal--small-text"><?php echo $row['chapter_name'] ?>
                                                            </p>
                                                        </div>

                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="titleCardList--container episode-item" tabindex="0" aria-label="Episode <?php echo $i; ?>" role="button" onclick="VidPlay(<?= $course ?>,<?= $module ?>,<?= $chapter_part ?>)">
                                                        <div class="titleCard-title_index"><?php echo $i; ?></div>
                                                        <div class="titleCard-imageWrapper">
                                                            <div class="ptrack-content"><img src="<?= $img_link ?><?= $Bigchapter_img ?>">
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
                                                            <p class="titleCard-synopsis previewModal--small-text"><?php echo $row['chapter_name'] ?>
                                                            </p>
                                                        </div>

                                                    </div>
                                    <?php
                                                }
                                                $i = $i + 1;
                                            }
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
        }
    }
}
    ?>