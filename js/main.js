// YOU WILL NEED TO ADD YOUR OWN API KEY IN QUOTES ON LINE 5, EVEN FOR THE PREVIEW TO WORK.
// 
// GET YOUR API HERE https://console.developers.google.com/apis/api


// https://developers.google.com/youtube/v3/docs/playlistItems/list

// https://console.developers.google.com/apis/api/youtube.googleapis.com/overview?project=webtut-195115&duration=PT1H

// <iframe width="560" height="315" src="https://www.youtube.com/embed/qxWrnhZEuRU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

// https://i.ytimg.com/vi/qxWrnhZEuRU/mqdefault.jpg




var key = 'AIzaSyBeqEUFBvirZvgcqULZS7m3U1hqnivg5mc';
var playlistId = 'PLcslWfyre80s-cYcZzblzXIWX8-EJl4iz';
var URL = 'https://www.googleapis.com/youtube/v3/playlistItems';
var channelID = 'UC9uE3NWbpg09xN8H5pmT4gQ';

const setButton = document.querySelector('.favorites-contens');

var options = {
   part: 'snippet',
   key: key,
   maxResults: 10,
   playlistId: playlistId,     
}

loadVids();

function loadVids() {
   $.getJSON(URL, options, function (data) {
      var id = data.items[0].snippet.resourceId.videoId;
      // mainVid(id);
      resultsLoop(data);
      console.log(data.nextPageToken);
   });
}

function sliderInit() {
   jQuery('.kbc').slick({
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

function resultsLoop(data) {
   $.each(data.items, function (i, item) {
      var thumb = item.snippet.thumbnails.standard.url;
      var title = item.snippet.title;
      var desc = item.snippet.description.substring(0, 500);
      desc = desc.replaceAll("#", "");
      var vid = item.snippet.resourceId.videoId;
      var publishedAt=item.snippet.publishedAt;
      // console.log(i);
      var kh=desc.substring(0, 100)+'...';
      // console.log(kh);
      if(i<9){
      $(".kbc").append(`							
                     <li class="slide-item" data-key="${vid}">
                     <a href="movie-details.php?data-key=${vid}&title=${title}&desc=${desc}&date=${publishedAt}&playlistsId=${playlistId}">
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
                                 <a href="movie-details.php?data-key=${vid}&title=${title}&desc=${desc}&date=${publishedAt}&playlistsId=${playlistId}" class="btn btn-hover">
                                 <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                 Play Now
                                 </a>
                              </div>
                           </div>
                           <div class="block-social-info">
                              <ul class="list-inline p-0 m-0 music-play-lists">
                                 <li><span><i class="ri-volume-mute-fill"></i></span></li>
                                 <li onclick="myVid('${vid}','${title}','${kh}','${publishedAt}','${thumb}')"><span><i class="ri-heart-fill"></i></span></li>                                
                              </ul>
                           </div>
                        </div>
                     </a>
                  </li>`);
      }
      
   });
   sliderInit();   
}
//view more functionality start
var playlistId2 = 'PLcslWfyre80s-cYcZzblzXIWX8-EJl4iz';
var nextPage='';
var options2 = {
   part: 'snippet',
   key: key,
   maxResults: 12,
   playlistId: playlistId2,     
}
loadVids2();

function loadVids2() {
   $.getJSON(URL, options2, function (data) {
      var id = data.items[0].snippet.resourceId.videoId;
      // mainVid(id);
      resultsLoop2(data);
      // console.log(data.nextPageToken);
      nextPage=data.nextPageToken;
      console.log(nextPage);
   });
}
function CallNextPage(nextPageToken){
   alert(nextPageToken);
   var options3 = {
      part: 'snippet',
      key: key,
      maxResults: 12,
      playlistId: playlistId2,
      nextPage:nextPageToken,     
   }
}
function resultsLoop2(data) {
   $.each(data.items, function (i, item) {
      var thumb = item.snippet.thumbnails.standard.url;
      var title = item.snippet.title;
      var desc = item.snippet.description.substring(0, 500);
      desc = desc.replaceAll("#", "");
      var vid = item.snippet.resourceId.videoId;
      var publishedAt=item.snippet.publishedAt;
      // console.log(i);
      if(i<=11){
      $(".view-more").append(`							
                     <li class="slide-item set-width" data-key="${vid}">
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
      }else{
         $(".view-more").append(`							
                     <li class="slide-item bg-danger" data-key="${vid}">
                     <a href="#">
                        <div class="block-images position-relative active" style="transform:none;">
                           <div class="img-box">
                              <img src="${thumb}" class="img-fluid">
                           </div>
                           <div class="block-description">
                              <h6>View More</h6>
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
      }
      
   });
   // htmlData=`<div class="row">
   //             <div class="col-12">
   //                <div class="float-right">
   //                   <button class="btn btn-hover mx-1 mt-5 mb-4">Pre</button>
   //                   <button class="btn btn-hover mx-1 mt-5 mb-4" onclick="CallNextPage(nextPage)">Next</button>
   //                </div>
   //             </div>
   //          </div>`;
   // setButton.insertAdjacentHTML('beforeend',htmlData);
}

//view more functionality end

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