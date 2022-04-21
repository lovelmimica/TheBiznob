console.log("Hello from latest news toggler");
addLoadEventCallback( () => {

    let togglers = document.querySelectorAll(".latest-news-toggler");

    let usNewsToggler = document.querySelector(".show-us-news");

    let worldNewsToggler = document.querySelector(".show-world-news");

    togglers.forEach( toggler => {

        toggler.addEventListener( 'click', event => {

            let usNewsWrapper = document.querySelector(".us-news-wrapper");

            let worldNewsWrapper = document.querySelector(".world-news-wrapper");


            if(event.target.classList.contains("show-us-news")){

                console.log("Show US news");

                worldNewsToggler.classList.remove("active");

                usNewsToggler.classList.add("active");

                worldNewsWrapper.style.opacity = "0";

                delay(500)

                    .then( ()  => worldNewsWrapper.style.display = "none" )

                    .then( () => usNewsWrapper.style.display = "flex" )

                    .then( () => delay(300).then( () => usNewsWrapper.style.opacity = "1" ));

                sessionStorage.setItem("activeTabLatestNews", "us");

            }else if(event.target.classList.contains("show-world-news")){

                console.log("Show World news");

                usNewsToggler.classList.remove("active");

                worldNewsToggler.classList.add("active");

                usNewsWrapper.style.opacity = "0";

                delay(500)

                    .then( ()  => usNewsWrapper.style.display = "none" )

                    .then( () => worldNewsWrapper.style.display = "flex" )

                    .then( () => delay(300).then( () => worldNewsWrapper.style.opacity = "1" ));

                sessionStorage.setItem("activeTabLatestNews", "world");
            }


        });

    });

    if(sessionStorage.getItem("activeTabLatestNews") && usNewsToggler && worldNewsToggler) sessionStorage.getItem("activeTabLatestNews") == 'world' ? worldNewsToggler.click() : usNewsToggler.click();

});