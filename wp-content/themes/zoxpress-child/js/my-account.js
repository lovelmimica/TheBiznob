
addLoadEventCallback( () => {

    let tabLinks = document.querySelectorAll(".my-account-navigation .tab-link");

    tabLinks.forEach( link => {

        link.addEventListener("click", (event) => {

            let tabLink = event.target;

            let contentContainer = document.querySelectorAll(".content-container");

            

            contentContainer.forEach( container => {

                if(container.dataset.content == tabLink.dataset.content) {

                    container.style.display = "block";

                    tabLink.classList.add("active");

                    window.localStorage.setItem('activeTab', tabLink.dataset.content);

                }

                else {

                    let relatedTabLink = document.querySelector(".tab-link[data-content='" + container.dataset.content + "']");

                    container.style.display = "none";

                    relatedTabLink.classList.remove("active");

                }

                sessionStorage.setItem("activeTabAccountPage", tabLink.dataset.content);

            });

        });

    });

    if(tabLinks.length > 0 && sessionStorage.getItem("activeTabAccountPage")) document.querySelector(".my-account-navigation .tab-link[data-content='" + sessionStorage.getItem("activeTabAccountPage") + "']").click();
    
    let activeTab = window.localStorage.getItem('activeTab');

    let activeTabLink = document.querySelector('.tab-link[data-content="' + activeTab + '"]');

    if(activeTabLink) activeTabLink.click();



    let addToReadlistBtns = document.querySelectorAll(".readlist-control");

    addToReadlistBtns.forEach( btn => {

        btn.addEventListener('click', (event) => {

            let user_id = event.target.dataset.user;

            let post_id = event.target.dataset.post;

            let in_readlist = event.target.dataset.inreadlist;



            if(event.target.dataset.user == 0){
                let baseUrl = window.location.href.substring(0, window.location.href.indexOf("biznob.com") + 10);
                window.location.href = baseUrl + "/login";

                return;

            }else{

                let data = {

                    user_id: user_id,

                    post_id: post_id,

                    in_readlist: in_readlist

                };

                let baseUrl = window.location.href.substring(0, window.location.href.indexOf("biznob.com") + 10);
                let url = baseUrl + "/wp-json/v1/update-readlist";

                fetch(url, {

                    method: "POST",

                    headers: { "Content-Type": "application/json" },

                    body: JSON.stringify(data)

                }).then(response => response.json())

                .then(result => {

                    if(result.status == 200 && result.action == "add"){

                        event.target.dataset.inreadlist = "1";

                        event.target.classList.add("in-readlist");

                    }else if(result.status == 200 && result.action == "remove"){

                        event.target.dataset.inreadlist = "";

                        event.target.classList.remove("in-readlist");

                        let baseUrl = window.location.href.substring(0, window.location.href.indexOf("biznob.com") + 10);

                        if(window.location.href == baseUrl + "/my-account/"){

                            let removedPostCard = document.querySelector(".post-" + post_id);

                            //removedPostCard.style.display = "none";

                        }

                    }

                });

            }

        });

    });

});