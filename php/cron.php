<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53J6JBV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->   
</body>
</html>
<?php
?>
<script src="../js/jquery-3.4.1.min.js"></script>
<script>
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
        $.getJSON(URL, playlistvalue, function(data) {
            totalPlaylists = data.pageInfo.totalResults;
            // var id = data.items[0].snippet.resourceId.videoId;
            // mainVid(id);
            resultsLoop(data);
            // console.log(data);

        });
    }

    //show all videos in playlist section 
    function resultsLoop(data) {
        $.each(data.items, function(i, item) {
            //  console.log(item.id);
            var title = item.snippet.title;
            var playlist = item.id;
            var published_date = item.snippet.publishedAt;
            var img_standard = item.snippet.thumbnails.standard.url;  
            var img_maxres='';        
                if(typeof (item.snippet.thumbnails.maxres) === 'undefined'){
                    img_maxres = item.snippet.thumbnails.standard.url;
                }else{
                    img_maxres = item.snippet.thumbnails.maxres.url;
                }
                // call ecah playlist one by one start
                setPlaylistList(playlist,title,published_date,img_standard,img_maxres);
                // call ecah playlist one by one start    
            // setList(i, title);
            fetchVideoByPlaylist_id(item.id, i);
        });
    }

    // fetch video by each playlist

    function playlistCall2(value, makeClass, page_token) {
        var options2 = {
            part: 'snippet,status',
            key: key,
            maxResults: 50,
            playlistId: value,
            pageToken: page_token,
        }
        loadVids2(options2, makeClass, value);
    }

    function loadVids2(playlistvalue, makeClass, value) {
        $.getJSON(URL2, playlistvalue, function(data) {
            resultsLoop2(data, makeClass, value);
            // console.log(data);

        });
    }


    function resultsLoop2(data, make_class, value) {
        // console.log(data.nextPageToken);
        nextPageTokenValue = data.nextPageToken;
        $.each(data.items, function(i, item) {
            if (item.status.privacyStatus == 'public' || item.status.privacyStatus == 'unlisted') {
                var img_standard2 = item.snippet.thumbnails.standard.url;
                var vid = item.snippet.resourceId.videoId;
                var publishedAt = item.snippet.publishedAt;
                var img_maxres2='';        
                if(typeof (item.snippet.thumbnails.maxres) === 'undefined'){
                    img_maxres2 = item.snippet.thumbnails.standard.url;
                }else{
                    img_maxres2 = item.snippet.thumbnails.maxres.url;
                }
                var title = item.snippet.title;
                var p_id = item.snippet.playlistId;
                // console.log(item.snippet.playlistId);
                var desc = item.snippet.description.substring(0, 500);
                desc = desc.replaceAll("#", "");                
                    // console.log(title);
                var kh = desc.substring(0, 500);
                kh = (kh.replace(/[^a-zA-Z ]/g, "")) + '...';      
                  // call ecah video one by one start
                setVideoList(vid,title,kh,publishedAt,p_id,img_standard2,img_maxres2);
                // call ecah video one by one start
            } else {
                notShowVideo++;
            }

        });       
        
          // if video 4has more than 50 video than Youtube api again call start
        if ((typeof nextPageTokenValue !== "undefined")) {
            // console.log(nextPageTokenValue);
            fetchVideoByPlaylist_id(value, make_class, nextPageTokenValue);
        } else {
            // console.log('no value');

        }
         // if video has more than 50 video than Youtube api again call end
    }

    //agin call api by loop 
    function fetchVideoByPlaylist_id(a, classPass, nextPageTokenValue) {
        // alert(a);
        var makeClass = `class${classPass}`;
        playlistCall2(a, makeClass, nextPageTokenValue);
    }

    $('#playlist_img_standard').change(function(){
        // Call submit() method on <form id='myform'>
        $('#myform').submit();
    });

    //insert playlist data in database one-by-one 
    function setPlaylistList(playlist_id,title,published_date,img_standard,img_maxres){
        $.ajax({
                type: 'POST',
                url: 'setPlaylist.php',
                dataType: "json",
                data : {
                    "playlist_id": playlist_id,
                    "title": title,
                    "published_date": published_date,
                    "img_standard": img_standard,
                    "img_maxres": img_maxres,
                    
                },
                success: function(data) {               
                    console.log(data);
                }
            });
    }
    //insert video data in database one by one start
    function setVideoList(vid,title,kh,publishedAt,p_id,img_standard2,img_maxres2){
        $.ajax({
                type: 'POST',
                url: 'setVideo.php',
                dataType: "json",                
                data : {
                    "video_id": vid,
                    "title": title,
                    "desc": kh,
                    "published_date": publishedAt,
                    "playlist_id": p_id,
                    "img_standard": img_standard2,
                    "img_maxres": img_maxres2,                    
                },
                success: function(data) {               
                    console.log(data);
                }
            });
    }
</script>
<?php
?>