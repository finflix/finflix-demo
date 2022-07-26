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
var channelID = 'UC9uE3NWbpg09xN8H5pmT4gQ';
var key = 'AIzaSyBeqEUFBvirZvgcqULZS7m3U1hqnivg5mc';
var playlistId = 'PLcslWfyre80s-cYcZzblzXIWX8-EJl4iz';
var playlistNumber = 0;
var nextPageTokenValue = '';
var totalPlaylists = 0;
var notShowPlaylist = 0;

//set url to call the playlists API
var options = {
    part: 'snippet,contentDetails',
    key: key,
    maxResults: 20,
    channelId: channelID,

}
// console.log(options);
// call function to load all playlists available in the current given channel 
loadVids(options, 'view-more');

// set load function to call the all playlists available in the given channelId

function loadVids(playlistvalue, value) {
    $.getJSON(URL, playlistvalue, function (data) {
        totalPlaylists = data.pageInfo.totalResults;
        // var id = data.items[0].snippet.resourceId.videoId;
        // mainVid(id);
        resultsLoop(data, value);
        console.log(data);
    });
}

//show all videos in playlist section 

function resultsLoop(data, value) {
    $.each(data.items, function (i, item) {
        var thumb = item.snippet.thumbnails.standard.url;
        var title = item.snippet.title;
        var desc = item.snippet.description.substring(0, 500);
        var totallists = item.contentDetails.itemCount;
        desc = desc.replaceAll("#", "");
        nextPageTokenValue = data.nextPageToken;
        // var vid = item.snippet.resourceId.videoId;
        var vid = item.id;
        var publishedAt = item.snippet.publishedAt;
        playlistNumber = i + 1;
        // console.log(i);
        $(`.${value}`).append(`<li class="slide-item set-width" data-key="${vid}" style="z-index:0">
                                    <a href="videoPlayer.php?playlistId=${vid}">
                                        <div class="block-images position-relative" style="transform:none;">
                                            <div class="playlisticon">
                                                <h3 class="text-center">${totallists}</h3>
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
                                            </div>
                                            <div class="img-box">
                                                <img src="${thumb}"
                                                    class="img-fluid">
                                            </div>
                                            <div class="sideapnel" style="background:rgba(245, 23, 23, 0.5);">
                                                <div class="block-description d-flex justify-content-center text-center"
                                                    style="width: 100%;left:0;">                                                    
                                                    <div class="hover-buttons">
                                                        <span class="btn btn-hover ">
                                                            <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                                            Play All
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>                                          
                                        </div>
                                        <h6 style="font-size:1.20em;padding:15px 0;">${title}</h6>
                                    </a>
                                </li>`);

    });
}

/* ---------------------- call playlist with next token --------------------- */
function callPlaylistWithToken(tokenId) {

    var options2 = {
        part: 'snippet,contentDetails',
        key: key,
        maxResults: 20,
        channelId: channelID,
        pageToken: tokenId,
    }
    // console.log(options2);
    loadVids2(options2, 'view-more');
}
    function loadVids2(playlistvalue, value) {
        $.getJSON(URL, playlistvalue, function (data) {
            totalPlaylists = data.pageInfo.totalResults;
            console.log(totalPlaylists);
            // var id = data.items[0].snippet.resourceId.videoId;
            // mainVid(id);
            resultsLoop2(data, value);
            console.log(data);
        });
    }

    //show all videos in playlist section 

    function resultsLoop2(data, value) {
        var playlistCount = 0;
        $.each(data.items, function (i, item) {
            var thumb = item.snippet.thumbnails.standard.url;
            var title = item.snippet.title;
            var desc = item.snippet.description.substring(0, 500);
            var totallists = item.contentDetails.itemCount;
            desc = desc.replaceAll("#", "");
            // var vid = item.snippet.resourceId.videoId;
            var vid = item.id;
            var publishedAt = item.snippet.publishedAt;
            playlistCount = playlistNumber + (i + 1);
            // console.log(i);
            $(`.${value}`).append(`<li class="slide-item set-width" data-key="${vid}" style="z-index:0">
                                        <a href="videoPlayer.php?playlistId=${vid}">
                                            <div class="block-images position-relative" style="transform:none;">
                                                <div class="playlisticon">
                                                    <h3 class="text-center">${totallists}</h3>
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
                                                </div>
                                                <div class="img-box">
                                                    <img src="${thumb}"
                                                        class="img-fluid">
                                                </div>
                                                <div class="sideapnel" style="background:rgba(245, 23, 23, 0.5);">
                                                    <div class="block-description d-flex justify-content-center text-center"
                                                        style="width: 100%;left:0;">                                                    
                                                        <div class="hover-buttons">
                                                            <span class="btn btn-hover ">
                                                                <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                                                Play All
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>                                          
                                            </div>
                                            <h6 style="font-size:1.20em;padding:15px 0;">${title}</h6>
                                        </a>
                                    </li>`);
        });
        playlistNumber = playlistCount;       
    }
    

