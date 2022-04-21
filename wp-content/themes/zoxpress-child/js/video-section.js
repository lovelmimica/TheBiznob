var player;

var floatingVideoClosed = false;

var tag = document.createElement("script");
tag.src = "https://youtube.com/iframe_api";
tag.id = "youtubeScript";
var firstScriptTag = document.getElementsByTagName("script")[1];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

addLoadEventCallback( () => {
    setupFloatingVideo();
    document.addEventListener('scroll', (event) => {
        if(floatingVideoClosed) return;
        setupFloatingVideo();
    });
    
    let allVideos = document.querySelectorAll(".video-card");
    allVideos.forEach( video => {
        let videoTitle = video.querySelector(".video-title");
        videoTitle.addEventListener("click", (e) => {
           if(e.target.closest(".video-card").classList.contains("main-video")) return;
           loadVideo(video);           
        });
        
       let playControl = video.querySelector(".video-thumbnail .ctrl-play");
       playControl.addEventListener("click", (e) => {
           if(e.target.closest(".video-card").classList.contains("main-video")) return;
           loadVideo(video);
       });
       
       let closeControl = video.querySelector(".video-thumbnail .ctrl-close");
       closeControl.addEventListener("click", (e) => {
           closeFloatingVideo();
       });
       
       let minimizeControl = video.querySelector(".video-thumbnail .ctrl-minimize");
        minimizeControl.addEventListener("click", (e) => {
           minimizeFloatingVideo();
       });
       
        let expandControl = video.querySelector(".video-thumbnail .ctrl-expand");
        expandControl.addEventListener("click", (e) => {
            expandFloatingVideo();
       });
    });
});

function setupVideoPlayer(){
    let videoId = document.querySelector( '.main-video .iframe-wrapper' ).dataset.videoid;
    let playerContainer = document.querySelector( '.main-video .iframe-wrapper .player-container' );
    let containerId = 'video-' + videoId;
    delete player;
    player = new YT.Player( 
        playerContainer, {
            videoId: videoId,
            events: {'onReady': onPlayerReady, 'onStateChange': onPlayerStateChange }
        }
    );
}

function onYouTubeIframeAPIReady(){
    setupVideoPlayer();
}

function onPlayerReady(e){
    e.target.mute();
    e.target.playVideo();
}

function onPlayerStateChange(e) {
    if(e.data == 0 ) {
        console.log("Video ended");
        let mainVideo = document.querySelector('.main-video');
        let nextVideo = document.querySelector( ":is(.video-wrapper .secondary-col, .video-posts-wrapper .secondary-video) .video-card[data-played='false']" );
        nextVideo.classList.add("main-video");
        
        let primaryCol = document.querySelector(':is(.video-wrapper .primary-col, .video-posts-wrapper .primary-video)');
        let secondaryCol = document.querySelector(':is(.video-wrapper .secondary-col, .video-posts-wrapper .secondary-video)');
        
        //let mainVideoClone = mainVideo.cloneNode(true)
        mainVideo.classList.remove('main-video');
        mainVideo.dataset.played = true;
        secondaryCol.replaceChild(mainVideo, nextVideo);
        primaryCol.appendChild(nextVideo);
        //mainVideo.remove();
        sortVideoList();
        setupVideoPlayer();
    }
}

function setupFloatingVideo(){
    let mainVideo = document.querySelector('.main-video');
    let videoWrapper = mainVideo.parentNode;
    //console.log("TOP: " + videoWrapper.getBoundingClientRect().top);
    //console.log("BOTTOM: " + videoWrapper.getBoundingClientRect().bottom);
    if(videoWrapper.getBoundingClientRect().bottom < 100 || videoWrapper.getBoundingClientRect().top > 800 ){
        if(window.innerWidth > 1024) mainVideo.classList.add('floating-video');
    }else{
        mainVideo.classList.remove('floating-video');
    }
}

function closeFloatingVideo(){
    player.pauseVideo();
    let floatingVideo = document.querySelector(".main-video.floating-video");
    floatingVideo.classList.remove("floating-video");
    floatingVideoClosed = true;
}

function minimizeFloatingVideo(){
    player.pauseVideo();
    let minimizeControl = document.querySelector(".main-video.floating-video .video-thumbnail .ctrl-minimize");
    let expandControl = document.querySelector(".main-video.floating-video .video-thumbnail .ctrl-expand");
    minimizeControl.style.display = 'none';
    expandControl.style.display = 'inline-block';
    
    let floatingVideo = document.querySelector(".main-video.floating-video");
    floatingVideo.classList.add("minimized-floating-video");
}

function expandFloatingVideo(){
    let minimizeControl = document.querySelector(".main-video.floating-video .video-thumbnail .ctrl-minimize");
    let expandControl = document.querySelector(".main-video.floating-video .video-thumbnail .ctrl-expand");
    minimizeControl.style.display = 'inline-block';
    expandControl.style.display = 'none';
    
    let floatingVideo = document.querySelector(".main-video.floating-video");
    floatingVideo.classList.remove("minimized-floating-video");
    player.playVideo();
}
    
function loadVideo(video){
    if(video.classList.contains('main-video')) return;
    let mainVideo = document.querySelector('.main-video');
   
   video.classList.add("main-video");
   mainVideo.classList.remove("main-video");
           
   let playerContainer = document.createElement('div');
   playerContainer.classList.add("player-container");
   let videoIframe = mainVideo.querySelector("iframe");
           
   let middleBorder = document.createElement('div');
   middleBorder.classList.add("middle-border");
           
   videoIframe.parentNode.replaceChild(playerContainer, videoIframe);
           
   let mainVideoParent = mainVideo.parentNode;
           
   video = video.parentNode.replaceChild(mainVideo, video);
           
   mainVideoParent.appendChild(video);

   sortVideoList();
           
    setupVideoPlayer();
    //video.parentNode.scrollIntoView({behavior: 'smooth'});
}

function sortVideoList(){
    let videoList = document.querySelectorAll('.secondary-video .video-card');
    let sortedVideoList = Array.from(videoList);
    
    let videoListParent = document.querySelector('.secondary-video');
    
    sortedVideoList.sort(compareVideosByDate);
    
    for(let i = 0; i < videoList.length; i++){
        let clone = sortedVideoList[i].cloneNode(true);
        
        let videoTitle = clone.querySelector(".video-title");
        videoTitle.addEventListener("click", (e) => {
           if(e.target.closest(".video-card").classList.contains("main-video")) return;
           loadVideo(clone);           
        });
        
       let playControl = clone.querySelector(".video-thumbnail .ctrl-play");
       playControl.addEventListener("click", (e) => {
           if(e.target.closest(".video-card").classList.contains("main-video")) return;
           loadVideo(clone);
       });
        
        videoListParent.replaceChild(clone, videoList[i]);
    }
}

function compareVideosByDate(first, second){
    let date1 = parseInt(first.dataset.published);
    let date2 = parseInt(second.dataset.published);

    if(date1 > date2) return -1;
    else if(date2 > date1) return 1;
    else return 0;
}

