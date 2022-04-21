import { tns } from "./node_modules/tiny-slider/src/tiny-slider.js";
console.log("Hello from ap slider");
var affiliateProductsSlider = tns({
    container: ".affiliate-products-slider",
    items: 4,
    slideBy: "page",
    autoplay: false,
    autoplayTimeout: 2000
});

addLoadEventCallback( () => {
    let controlLeft = document.querySelector(".affiliate-products-slider-wrapper .control-left");
    let controlRight = document.querySelector(".affiliate-products-slider-wrapper .control-right");
    console.log(controlLeft);

    controlLeft.addEventListener("click", () => {
        let buttonPrev = document.querySelector(".affiliate-products-section button[data-controls='prev']");
        buttonPrev.click();
    });

    controlRight.addEventListener("click", () => {
        let buttonNext = document.querySelector(".affiliate-products-section button[data-controls='next']");
        buttonNext.click();
    });
});