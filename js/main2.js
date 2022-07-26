// YOU WILL NEED TO ADD YOUR OWN API KEY IN QUOTES ON LINE 5, EVEN FOR THE PREVIEW TO WORK.
// 
// GET YOUR API HERE https://console.developers.google.com/apis/api


// https://developers.google.com/youtube/v3/docs/playlistItems/list

// https://console.developers.google.com/apis/api/youtube.googleapis.com/overview?project=webtut-195115&duration=PT1H

// <iframe width="560" height="315" src="https://www.youtube.com/embed/qxWrnhZEuRU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

// https://i.ytimg.com/vi/qxWrnhZEuRU/mqdefault.jpg


const setButton = document.querySelector('.favorites-contens');
var URL = 'https://www.googleapis.com/youtube/v3/playlistItems';
var channelID = 'UC9uE3NWbpg09xN8H5pmT4gQ';
var key = 'AIzaSyBeqEUFBvirZvgcqULZS7m3U1hqnivg5mc';
var playlistId = 'PLcslWfyre80vqPioKR79EAb5PY6lfc-fr';
//duke coin playlistID
var duckcoinPlaylistId = 'PLcslWfyre80utAda3Hjbj4qznbwmPOEq2';
//stock ki ABCD playlistId
var abcdPlaylistId = 'PLcslWfyre80su3VkPrKqKB94PxrYUqeqb';


var options = {
    part: 'snippet',
    key: key,   
    maxResults: 100, 
    playlistId: playlistId,
}
var options2 = {
    part: 'snippet',
    key: key,
    maxResults: 10,
    playlistId: duckcoinPlaylistId,
}
var options3 = {
    part: 'snippet',
    key: key,
    maxResults: 7,
    playlistId: abcdPlaylistId,
}

loadVids(options,'kbc');
loadVids(options2,'kbc2');
loadVids(options3,'kbc3');

function loadVids(playlistvalue,value) {
    $.getJSON(URL, playlistvalue, function (data) {
        var id = data.items[0].snippet.resourceId.videoId;
        // mainVid(id);
        resultsLoop(data,value);
        console.log(data);
    });
}

function sliderInit(value) {
    jQuery(`.${value}`).slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        autoplay: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        // appendArrows: $('#sm-slick-arrow'),

        nextArrow: '<a href="#" class="slick-arrow slick-next"><i class= "fa fa-chevron-right"></i></a>',
        prevArrow: '<a href="#" class="slick-arrow slick-prev"><i class= "fa fa-chevron-left"></i></a>',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    // arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
}

function resultsLoop(data,value) {
    $.each(data.items, function (i, item) {
        var thumb = item.snippet.thumbnails.maxres.url;
        var title = item.snippet.title;
        var desc = item.snippet.description.substring(0, 500);
        desc = desc.replaceAll("#", "");
        var vid = item.snippet.resourceId.videoId;
        var publishedAt = item.snippet.publishedAt;
        // console.log(i);
        // if (i < 9) {
            $(`.${value}`).append(`							
                     <li class="slide-item" data-key="${vid}">
                     <a href="movie-details.php?data-key=${vid}&title=${title}&desc=${desc}&date=${publishedAt}">
                        <div class="block-images position-relative">
                           <div class="img-box">
                              <img src="${thumb}" class="img-fluid">
                           </div>
                           <div class="block-description">
                              <h6>${title}</h6>
                              <div class="movie-time d-flex align-items-center my-2">
                                 <div class="badge badge-secondary p-1 mr-2">13+</div>
                                 <span class="text-white">2h 30m</span>
                              </div>
                              <div class="hover-buttons">
                                 <span class="btn btn-hover">
                                 <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                 Play Now
                                 </span>
                              </div>
                           </div>
                           <div class="block-social-info">
                              <ul class="list-inline p-0 m-0 music-play-lists">
                                 <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                 <li><span><i class="ri-heart-fill"></i></span></li>
                                 <li><span><i class="ri-information-fill"></i></span></li>
                              </ul>
                           </div>
                        </div>
                     </a>
                  </li>`);
        // } else {
        //     $(`.${value}`).append(`							
        //              <li class="slide-item " data-key="${vid}">
        //              <a href="view-more">
        //                 <div class="block-images position-relative active" style="transform:none;">
        //                    <div class="img-box">
        //                       <img src="${thumb}" class="img-fluid">
        //                    </div>
        //                    <div class="block-description">
        //                       <h6>View More</h6>
        //                       <div class="movie-time d-flex align-items-center my-2">
        //                          <div class="badge badge-secondary p-1 mr-2">13+</div>
        //                          <span class="text-white">2h 30m</span>
        //                       </div>
        //                       <div class="hover-buttons">
        //                          <span class="btn btn-hover">
        //                          <i class="fa fa-play mr-1" aria-hidden="true"></i>
        //                          Play Now
        //                          </span>
        //                       </div>
        //                    </div>
        //                    <div class="block-social-info">
        //                       <ul class="list-inline p-0 m-0 music-play-lists">
        //                          <li><span><i class="ri-volume-mute-fill"></i></span></li>
        //                          <li><span><i class="ri-heart-fill"></i></span></li>
        //                          <li><span><i class="ri-information-fill"></i></span></li>
        //                       </ul>
        //                    </div>
        //                 </div>
        //              </a>
        //           </li>`);
        // }

    });
    sliderInit(value);
}


