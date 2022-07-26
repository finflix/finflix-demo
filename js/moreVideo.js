
var key = 'AIzaSyBeqEUFBvirZvgcqULZS7m3U1hqnivg5mc';
var playlistId = 'PLcslWfyre80s-cYcZzblzXIWX8-EJl4iz';
var URL = 'https://www.googleapis.com/youtube/v3/playlistItems';
var channelID = 'UC9uE3NWbpg09xN8H5pmT4gQ';
const setButton = document.querySelector('.favorites-contens');
function playlistCall(value,show_class) {
var options = {
    part: 'snippet',
    key: key,
    maxResults: 10,
    playlistId: value,     
 }
 loadVids(options,show_class,value);
}

function loadVids(playlistvalue,show_class,p_id) {
   $.getJSON(URL,playlistvalue, function (data) {
      var id = data.items[0].snippet.resourceId.videoId;
      // mainVid(id);
      resultsLoop(data,show_class,p_id);
      console.log(data.nextPageToken);
   });
}

function sliderInit(show_class) {
   jQuery(`.${show_class}`).slick({
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

function resultsLoop(data,show_class,p_id) {
   $.each(data.items, function (i, item) {
      var thumb = item.snippet.thumbnails.maxres.url;
      var title = item.snippet.title;
      var desc = item.snippet.description.substring(0, 500);
      desc = desc.replaceAll("#", "");
      var vid = item.snippet.resourceId.videoId;
      var publishedAt=item.snippet.publishedAt;
      // console.log(i);
      var kh=desc.substring(0, 500);
      kh = (kh.replace(/[^a-zA-Z ]/g, ""))+'...';
      // console.log(kh);
      if(i<9){
      $(`.${show_class}`).append(`							
                     <li class="slide-item" data-key="${vid}">
                     <a href="movie-details.php?data-key=${vid}&title=${title}&desc=${desc}&date=${publishedAt}&playlistsId=${p_id}">
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
                                 <a href="movie-details.php?data-key=${vid}&title=${title}&desc=${desc}&date=${publishedAt}&playlistsId=${p_id}" class="btn btn-hover">
                                 <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                 Play Now
                                 </a>
                              </div>
                           </div>
                           <div class="block-social-info">
                              <ul class="list-inline p-0 m-0 music-play-lists">
                                 <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                 <li onclick="myVid('${vid}','${title}','${kh}','${publishedAt}','${thumb}','${p_id}')"><span><i class="ri-heart-fill"></i></span></li>                                 
                              </ul>
                           </div>
                        </div>
                     </a>
                  </li>`);
      }
      
   });
   sliderInit(show_class);   
}

function sliderInit2() {
   jQuery('.ccc').slick({
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