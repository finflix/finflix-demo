// YOU WILL NEED TO ADD YOUR OWN API KEY IN QUOTES ON LINE 5, EVEN FOR THE PREVIEW TO WORK.
// 
// GET YOUR API HERE https://console.developers.google.com/apis/api


// https://developers.google.com/youtube/v3/docs/playlistItems/list

// https://console.developers.google.com/apis/api/youtube.googleapis.com/overview?project=webtut-195115&duration=PT1H

// <iframe width="560" height="315" src="https://www.youtube.com/embed/qxWrnhZEuRU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

// https://i.ytimg.com/vi/qxWrnhZEuRU/mqdefault.jpg

// url credential

const setButton = document.querySelector('.favorites-contens');
var URL = 'https://www.googleapis.com/youtube/v3/playlists';
var URL2 = 'https://www.googleapis.com/youtube/v3/playlistItems';
var channelID = 'UC9uE3NWbpg09xN8H5pmT4gQ';
var key = 'AIzaSyBeqEUFBvirZvgcqULZS7m3U1hqnivg5mc';
var playlistId = 'PLcslWfyre80s-cYcZzblzXIWX8-EJl4iz';
var playlistNumber = 0;
var nextPageTokenValue = '';
var totalPlaylists = 0;
var notShowPlaylist = 0;
var notShowVideo = 0;

//set url to call the playlists API
var options = {
   part: 'snippet,contentDetails',
   key: key,
   maxResults: 50,
   channelId: channelID,
}
// console.log(options);
// call function to load all playlists available in the current given channel 
loadVids(options);

// set load function to call the all playlists available in the given channelId

function loadVids(playlistvalue) {
   $.getJSON(URL, playlistvalue, function (data) {
      totalPlaylists = data.pageInfo.totalResults;
      // var id = data.items[0].snippet.resourceId.videoId;
      // mainVid(id);
      resultsLoop(data);
      console.log(data);

   });
}

//show all videos in playlist section 
function resultsLoop(data) {
   $.each(data.items, function (i, item) {
      //  console.log(item.id);
      var title = item.snippet.title;
      setList(i,title);
      fetchVideoByPlaylist_id(item.id, i);

   });

}

// /* ---------------------- call playlist with next token --------------------- */
// function callPlaylistWithToken(tokenId) {

//     var options2 = {
//         part: 'snippet,contentDetails',
//         key: key,
//         maxResults: 20,
//         channelId: channelID,
//         pageToken: tokenId,
//     }
//     // console.log(options2);
//     loadVids2(options2, 'view-more');
// }
//     function loadVids2(playlistvalue, value) {
//         $.getJSON(URL, playlistvalue, function (data) {
//             totalPlaylists = data.pageInfo.totalResults;
//             console.log(totalPlaylists);
//             // var id = data.items[0].snippet.resourceId.videoId;
//             // mainVid(id);
//             resultsLoop2(data, value);
//             console.log(data);
//         });
//     }

//     function sliderInit(show_class) {
//         jQuery(`.${show_class}`).slick({
//            dots: false,
//            arrows: true,
//            infinite: true,
//            speed: 300,
//            autoplay: false,
//            slidesToShow: 4,
//            slidesToScroll: 1,
//            // appendArrows: $('#sm-slick-arrow'),

//            nextArrow: '<a href="#" class="slick-arrow slick-next"><i class= "fa fa-chevron-right"></i></a>',
//            prevArrow: '<a href="#" class="slick-arrow slick-prev"><i class= "fa fa-chevron-left"></i></a>',
//            responsive: [
//               {
//                  breakpoint: 1200,
//                  settings: {
//                     slidesToShow: 3,
//                     slidesToScroll: 1,
//                     infinite: true,
//                     dots: true
//                  }
//               },
//               {
//                  breakpoint: 768,
//                  settings: {
//                     slidesToShow: 2,
//                     slidesToScroll: 1
//                  }
//               },
//               {
//                  breakpoint: 480,
//                  settings: {
//                     // arrows: false,
//                     slidesToShow: 1,
//                     slidesToScroll: 1
//                  }
//               }
//            ]
//         });
//      }
//     //show all videos in playlist section 

//     function resultsLoop2(data, value) {
//         var playlistCount = 0;
//         $.each(data.items, function (i, item) {
//             var thumb = item.snippet.thumbnails.standard.url;
//             var title = item.snippet.title;
//             var desc = item.snippet.description.substring(0, 500);
//             var totallists = item.contentDetails.itemCount;
//             desc = desc.replaceAll("#", "");
//             // var vid = item.snippet.resourceId.videoId;
//             var vid = item.id;
//             var publishedAt = item.snippet.publishedAt;
//             playlistCount = playlistNumber + (i + 1);
//             // console.log(i);
//             $(`.${value}`).append(`<li class="slide-item set-width" data-key="${vid}" style="z-index:0">
//                                         <a href="videoPlayer.php?playlistId=${vid}">
//                                             <div class="block-images position-relative" style="transform:none;">
//                                                 <div class="playlisticon">
//                                                     <h3 class="text-center">${totallists}</h3>
//                                                     <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet"
//                                                         focusable="false" class="style-scope yt-icon"
//                                                         style="pointer-events: none; display: block; width: 100%; height: 100%;" fill="#fff">
//                                                         <g class="style-scope yt-icon">
//                                                             <path
//                                                                 d="M3.67 8.67h14V11h-14V8.67zm0-4.67h14v2.33h-14V4zm0 9.33H13v2.34H3.67v-2.34zm11.66 0v7l5.84-3.5-5.84-3.5z"
//                                                                 class="style-scope yt-icon">
//                                                             </path>
//                                                         </g>
//                                                     </svg>
//                                                 </div>
//                                                 <div class="img-box">
//                                                     <img src="${thumb}"
//                                                         class="img-fluid">
//                                                 </div>
//                                                 <div class="sideapnel" style="background:rgba(245, 23, 23, 0.5);">
//                                                     <div class="block-description d-flex justify-content-center text-center"
//                                                         style="width: 100%;left:0;">                                                    
//                                                         <div class="hover-buttons">
//                                                             <span class="btn btn-hover ">
//                                                                 <i class="fa fa-play mr-1" aria-hidden="true"></i>
//                                                                 Play All
//                                                             </span>
//                                                         </div>
//                                                     </div>
//                                                 </div>                                          
//                                             </div>
//                                             <h6 style="font-size:1.20em;padding:15px 0;">${title}</h6>
//                                         </a>
//                                     </li>`);
//         });

//         playlistNumber = playlistCount;       
//     }


function playlistCall2(value, makeClass,page_token) {
   var options2 = {
      part: 'snippet,status',
      key: key,
      maxResults: 50,
      playlistId: value,
      pageToken: page_token,
   }
   loadVids2(options2, makeClass,value);
}

function loadVids2(playlistvalue, makeClass,value) {
   $.getJSON(URL2, playlistvalue, function (data) {     
      resultsLoop2(data, makeClass,value);
      console.log(data);
     
   });
}

function sliderInit(make_class) {
   jQuery(`.${make_class}`).slick({
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

function resultsLoop2(data, make_class,value) {
   // console.log(data.nextPageToken);
   nextPageTokenValue = data.nextPageToken;
   $.each(data.items, function (i, item) {
      if (item.status.privacyStatus == 'public' || item.status.privacyStatus == 'unlisted') {
         var thumb = item.snippet.thumbnails.standard.url;
         var title = item.snippet.title;
         var desc = item.snippet.description.substring(0, 500);
         
         desc = desc.replaceAll("#", "");
         var vid = item.snippet.resourceId.videoId;
         var publishedAt = item.snippet.publishedAt;
         // console.log(i);
         var kh = desc.substring(0, 500);
         kh = (kh.replace(/[^a-zA-Z ]/g, "")) + '...';
         // console.log(kh);

         $(`.${make_class}`).append(`							
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
                           <a href="movie-details.php?data-key=${vid}&title=${title}&desc=${desc}&date=${publishedAt}" class="btn btn-hover">
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

      } else {
         notShowVideo++;
      }

   });
   sliderInit(make_class);
   if(!(typeof nextPageTokenValue === "undefined")){     
      console.log(nextPageTokenValue);
      fetchVideoByPlaylist_id(value, make_class,nextPageTokenValue);
     

   }else{
      console.log('no value');
    
   }
}
// if video has more than 50 video than Youtube api again call start
// if video has more than 50 video than Youtube api again call end


//agin call api by loop 
function fetchVideoByPlaylist_id(a, classPass,nextPageTokenValue) {
   // alert(a);
   var makeClass = `class${classPass}`;
   playlistCall2(a, makeClass,nextPageTokenValue);
}
function setList(list_id,title){
   var makeList = `class${list_id}`;
   setUl=`<section id="iq-upcoming-movie"><div class="container-fluid"><div class="row"><div class="col-sm-12 overflow-hidden"><div class="iq-main-header d-flex align-items-center justify-content-between"><h4 class="main-title"><a href="movie-category.html">${title}</a></h4></div><div class="upcoming-contens"><ul class="favorites-slider list-inline row p-0 mb-0 ${makeList}"></ul></div></div></div></div></section>`;
   $('#MakeSection').append(setUl);
}