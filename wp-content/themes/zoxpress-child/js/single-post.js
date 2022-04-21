



addLoadEventCallback( () => {

    let expandFtImgCaption = document.querySelector(".single .zox-post-img-cap .expand-img-cap");

    let minimizeFtImgCaption = document.querySelector(".single .zox-post-img-cap .minimize-img-cap");

    

    let fullFtImgCaption = document.querySelector(".single .zox-post-img-cap.zox-post-img-cap-full");

    let shortFtImgCaption= document.querySelector(".single .zox-post-img-cap");

    

    if(expandFtImgCaption) expandFtImgCaption.addEventListener("click", () => {

        fullFtImgCaption.style.display = "inline";

        shortFtImgCaption.style.display = "none";

    });

    

    if(minimizeFtImgCaption) minimizeFtImgCaption.addEventListener("click", () => {

        shortFtImgCaption.style.display = "inline";

        fullFtImgCaption.style.display = "none";

    });

    

    var fetching = false;

    

    let postArticles = document.querySelectorAll("#zox-main-body-wrap article.post");

    let postIds = new Array();

    postArticles.forEach( post => {

        postIds.push( post.id.substring(5) );

    });



    //console.log("Initial fetch");

    fetching = true;

    let baseUrl = window.location.href.substring(0, window.location.href.indexOf("biznob.com") + 10);

    fetch(baseUrl + "/wp-json/v1/get-related-post?postIds=" + postIds)

        .then( response => response.text() )    

        .then( (result) => {

            let zoxMainBodyWrap = document.querySelector("#zox-main-body-wrap"); 

            let node = new DOMParser().parseFromString(result, "text/html").body.firstElementChild;

           

            zoxMainBodyWrap.appendChild(node);

            

            setStickySidebar();

            fetching = false;

            //console.log("Finish initial fetch");

    });



    document.addEventListener( "scroll", (e) => {

        let postTitles = document.querySelectorAll('.zox-post-title');

        let postBodies = document.querySelectorAll('.zox-post-body');

        let videoEmbed = document.querySelector('.zox-video-embed-cont');

        postTitles.forEach( (title, i) => {

            if( i != (postTitles.length - 1)){

                if(title.getBoundingClientRect().top < 200 && title.getBoundingClientRect().top > -200){

                    history.replaceState(null, null, title.dataset.url);

                    if(videoEmbed && i > 0) videoEmbed.style.opacity='0'; 

                }else if(i > 0 && postBodies[i-1].getBoundingClientRect().bottom < 200 && postBodies[i-1].getBoundingClientRect().bottom > -200){

                    history.replaceState(null, null, postBodies[i-1].dataset.url);

                    if(videoEmbed && i == 1) videoEmbed.style.opacity='100'; 

                }

            }

        });



        let footer = document.querySelector("footer");



        if(footer.getBoundingClientRect().top < 4000 && fetching == false){

            //console.log("Start regular fetch");

            

            fetching = true;

            

            let postArticles = document.querySelectorAll("#zox-main-body-wrap article.post");

            let postIds = new Array();

            postArticles.forEach( post => {

                postIds.push( post.id.substring(5) );

            });

            postArticles[postArticles.length -1].style.display = "block";

            
            let baseUrl = window.location.href.substring(0, window.location.href.indexOf("biznob.com") + 10);

            fetch(baseUrl + "/wp-json/v1/get-related-post?postIds=" + postIds)

            .then( response => response.text() )    

            .then( (result) => {

                    let zoxMainBodyWrap = document.querySelector("#zox-main-body-wrap");        



                    let node = new DOMParser().parseFromString(result, "text/html").body.firstElementChild;

                    zoxMainBodyWrap.appendChild(node);

                    

                    setStickySidebar();

                    fetching = false;

                    //console.log("Finish regular fetch");

            });

        }

    });

});