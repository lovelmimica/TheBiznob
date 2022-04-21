addLoadEventCallback( () => {
    console.log("Hello from cookie popup js");
    let consented = sessionStorage.getItem("cookieConsent");
    if(!consented){
        console.log("Show modal");
        let cookieConsentPopup = document.querySelector(".cookies-popup");
        cookieConsentPopup.style.bottom = "0";

        let closeButton = document.querySelector(".close-cookies-popup");

        closeButton.addEventListener("click", e => {
            sessionStorage.setItem("cookieConsent", true);
            cookieConsentPopup.style.bottom = "-100px";
        });

    }
});