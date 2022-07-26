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
var videoNumber = 0;
var nextPageTokenValue = '';
var totalVideos = 0;
var notShowVideo = 0;
//set url to fetch the youtube API start
function playlistCall(value) {
    var options = {
        part: 'snippet,status',
        key: key,
        maxResults: 50,
        playlistId: value,
    }
    // console.log(options);
    loadVids(options, '.main');
}
//set url to fetch the youtube API end

//load videos using playlist id start

function loadVids(playlistvalue, value) {
    $.getJSON(URL, playlistvalue, function (data) {
        console.log(data);
        totalVideos = data.pageInfo.totalResults;

        if (data.items[0].status.privacyStatus == 'public') {
            var id = data.items[0].snippet.resourceId.videoId;
            var title = data.items[0].snippet.title;
            var desc = data.items[0].snippet.description.substring(0, 500);
            desc = desc.replaceAll("#", "");
            var publishedAt = data.items[0].snippet.publishedAt;
            mainVid(id);

            setDetails(title, desc, publishedAt);
            resultsLoop(data, value);
            // console.log(data);
            nextPageTokenValue = data.nextPageToken;
        } else {
            var id = data.items[1].snippet.resourceId.videoId;
            var title = data.items[1].snippet.title;
            var desc = data.items[1].snippet.description.substring(0, 500);
            desc = desc.replaceAll("#", "");
            var publishedAt = data.items[1].snippet.publishedAt;
            mainVid(id);

            setDetails(title, desc, publishedAt);
            resultsLoop(data, value);
            console.log(data);
            nextPageTokenValue = data.nextPageToken;
            console.log('not public');
        }
    });
}
//load videos using playlist id end

//fetch each videos which are public and unlisted start
function resultsLoop(data, value) {
    $.each(data.items, function (i, item) {
        if (item.status.privacyStatus == 'public' || item.status.privacyStatus == 'unlisted') {
            var thumb = item.snippet.thumbnails.standard.url;
            var title = item.snippet.title;
            var desc = item.snippet.description.substring(0, 500);
            desc = desc.replaceAll("#", "");
            var vid = item.snippet.resourceId.videoId;
            var publishedAt = item.snippet.publishedAt;
            videoNumber = i + 1;
            // console.log(i);
            // if (i < 9) {
            $(`${value}`).append(`
         <article class="item" data-key="${vid}" style="margin:1rem;cursor:pointer;" onclick="openNav()" id="data${i}">
        <div class="bg-red" style="
        position: absolute;
        background: #443838;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        display: grid;
        place-items: center;
    ">${i + 1}</div>
            <img src="${thumb}" alt="" class="thumb" style="height:100%;width:100%;">
            <div class="details bg-white">
                <h5 style="color:#333 !important;padding:10px;">${title}</h5>              
            </div>
         </article>
      `);
        } else {
            notShowVideo++;
        }
    });
    // sliderInit(value);
    $('#data0').addClass('active');
    $('#data0').children('img').css('width','98%');

}
//fetch each videos which are public and unlisted end 

//if pages are more than 50 than again api call with tokenId start 

//set url to fetch the youtube API start

function callApiWithToken(value, tokenId) {

    var options2 = {
        part: 'snippet,status',
        key: key,
        maxResults: 50,
        playlistId: value,
        pageToken: tokenId,
    }
    // console.log(options2);
    loadVids2(options2, 'main');
}
//load videos using playlist id start
function loadVids2(playlistvalue, value) {
    $.getJSON(URL, playlistvalue, function (data) {
        totalVideos = data.pageInfo.totalResults;
        // var id = data.items[0].snippet.resourceId.videoId;       
        // var title = data.items[0].snippet.title;
        // var desc = data.items[0].snippet.description.substring(0, 500);
        // desc = desc.replaceAll("#", "");        
        // var publishedAt = data.items[0].snippet.publishedAt;
        // mainVid(id);
        // setDetails(title,desc,publishedAt);
        nextPageTokenValue = data.nextPageToken;
        resultsLoop2(data, value);
        console.log(data);
    });
}
//fetch each videos which are public and unlisted start

function resultsLoop2(data, value) {
    var videoCount = 0;
    $.each(data.items, function (i, item) {
        if (item.status.privacyStatus == 'public' || item.status.privacyStatus == 'unlisted') {
            var thumb = item.snippet.thumbnails.standard.url;
            var title = item.snippet.title;
            var desc = item.snippet.description.substring(0, 500);
            desc = desc.replaceAll("#", "");
            var vid = item.snippet.resourceId.videoId;
            var publishedAt = item.snippet.publishedAt;
            videoCount = videoNumber + (i + 1);
            notShow = notShowVideo;
            // console.log(i);
            // if (i < 9) {
            $(`${value}`).append(`
             <article class="item" data-key="${vid}" style="margin:1rem;cursor:pointer;" onclick="openNav()">
            <div class="bg-red" style="
            position: absolute;
            background: #443838;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            display: grid;
            place-items: center;
        ">${videoCount}</div>
                <img src="${thumb}" alt="" class="thumb" style="height:100%;width:200px;">
                <div class="details bg-white">
                    <h5 style="color:#333 !important;padding:10px;">${title}</h5>              
                </div>
             </article>
          `);
        } else {
            notShow++;
        }
    });
    videoNumber = videoCount;
    notShowVideo = notShow;
}

