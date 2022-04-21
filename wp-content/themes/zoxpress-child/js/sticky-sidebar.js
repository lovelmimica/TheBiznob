setStickySidebar = () => {
        let sidebarContentArr = document.querySelectorAll(".sidebar-content");
        let sidebarArr = document.querySelectorAll(".sidebar");

        for(let i = 0; i < sidebarArr.length; i++){
            let sidebarContent =sidebarContentArr[i];
            let sidebar = sidebarArr[i];
        
            document.addEventListener('scroll', (event) => {
                sidebar.setAttribute("style", "");

                if(window.innerWidth > 1080){
                    if(sidebar.getBoundingClientRect().top < 110 && sidebar.getBoundingClientRect().bottom > 1055){
                        let sidebarContentTop =  110 - sidebar.getBoundingClientRect().top;
                        sidebarContent.style.top = sidebarContentTop + 'px';
                        //console.log("Moving sidebar, top=" + sidebarContentTop + 'px');
                    }else if(sidebar.getBoundingClientRect().top >= 110){
                        sidebarContent.style.top = '0px';
                        //console.log("Fixing sidebar top, top=0px");
                    }else if(sidebar.getBoundingClientRect().bottom <= 1055){
                        let sidebarContentTop = sidebar.getBoundingClientRect().height - sidebarContent.getBoundingClientRect().height;
                        sidebarContent.style.top = sidebarContentTop + 'px';
                        //console.log("Fixing sidebar bottom, top=" + sidebarContentTop + 'px');
                    }
                }
            });
        }
};

addLoadEventCallback(() => {
    setStickySidebar();
});