import { tns } from "./node_modules/tiny-slider/src/tiny-slider.js";

var marketDataSlider = tns({

    container: ".crypto-data-items",

    items: 1,

    slideBy: "page",

    autoplay: true,

    autoplayTimeout: 10000

});

let marketDataSliderItems = document.querySelectorAll(".market-data-section .market-data-items > div");
marketDataSliderItems.forEach(item => item.style.opacity = "1");

function compareByName(first, second){

    let name1 = first.querySelector(".unit-fullname").textContent;

    let name2 = second.querySelector(".unit-fullname").textContent;



    if(name1 > name2) return 1;

    else if(name2 > name1) return -1;

    else return 0;

}



function compareByValue(first, second){

    let value1 = parseFloat(first.querySelector(".unit-value").textContent.replace(/,/g, ''));

    let value2 = parseFloat(second.querySelector(".unit-value").textContent.replace(/,/g, ''));

    

    if(value1 > value2) return -1;

    else if(value2 > value1) return 1;

    else return 0;

}



function compareByChange(first, second){

    let change1 = first.querySelector(".unit-change").textContent;

    let change2 = second.querySelector(".unit-change").textContent;

    

    if(change1 > change2) return -1;

    else if(change2 > change1) return 1;

    else return 0;

}



function compareBySortValue(first, second){

    let sortVal1 = parseInt(first.dataset.sortval);

    let sortVal2 = parseInt(second.dataset.sortval);

    

    if(sortVal1 > sortVal2) return -1;

    else if(sortVal2 > sortVal1) return 1;

    else return 0;

}



let rbCryptoSort = document.querySelectorAll('.sort-form-crypto input');

rbCryptoSort.forEach(rb => {

    rb.addEventListener('change', (e) => {

        let cryptoList = document.querySelectorAll('.crypto-wrapper .unit-list-item');

        let sortedCryptoList = Array.from(cryptoList);

        

        let cryptoListParent = document.querySelector('.crypto-wrapper');

        

        let compareFunction;

        

        if(e.target.value == 'alphabetical') compareFunction = compareByName;

        else if(e.target.value == 'popular') compareFunction = compareBySortValue;

        else if(e.target.value == 'change') compareFunction = compareByChange;

        else if(e.target.value == 'value') compareFunction = compareByValue;

        

        sortedCryptoList.sort(compareFunction);

        

        for(let i = 0; i < cryptoList.length; i++){

            let clone = sortedCryptoList[i].cloneNode(true);

            

            cryptoListParent.insertBefore(clone, cryptoList[i]);

            cryptoListParent.removeChild(cryptoList[i]);

        }

    });

});



let rbStocksSort = document.querySelectorAll('.sort-form-stocks input');

rbStocksSort.forEach(rb => {

    rb.addEventListener('change', (e) => {

        let nodeList = document.querySelectorAll('.stock-wrapper .unit-list-item');

        let sortedNodeList = Array.from(nodeList);

        

        let nodeListParent = document.querySelector('.stock-wrapper');

        

        let compareFunction;

        

        if(e.target.value == 'alphabetical') compareFunction = compareByName;

        else if(e.target.value == 'market-cap') compareFunction = compareBySortValue;

        else if(e.target.value == 'change') compareFunction = compareByChange;

        else if(e.target.value == 'value') compareFunction = compareByValue;

        

        sortedNodeList.sort(compareFunction);

        

        for(let i = 0; i < nodeList.length; i++){

            let clone = sortedNodeList[i].cloneNode(true);

            

            nodeListParent.insertBefore(clone, nodeList[i]);

            nodeListParent.removeChild(nodeList[i]);

        }

    });

});



function addLoadEventCallback(func) {

    var oldonload = window.onload;

    if (typeof window.onload != 'function') {

      window.onload = func;

    } else {

      window.onload = function() {

        if (oldonload) {

          oldonload();

        }

        func();

      }

    }

}



addLoadEventCallback( () => {

    let cryptoSortByPopularity = document.querySelector('#md_crypto_sort_popular');
    
    if(cryptoSortByPopularity) cryptoSortByPopularity.click();


    let stocksSortByPopularity = document.querySelector('#md_stock_sort_market-cap');

    if(stocksSortByPopularity) stocksSortByPopularity.click();

});



let cryptoSearchBox = document.querySelector(".sort-form-crypto input[name='search']");
if(cryptoSearchBox){
    cryptoSearchBox.addEventListener('keyup', (e) => {

        let cryptoList = document.querySelectorAll('.crypto-wrapper .unit-list-item');
    
        
    
        cryptoList.forEach( el => {
    
            let name = el.querySelector('.name');
    
            if(name.innerText.includes(e.target.value)){
    
                el.style.display = 'grid';
    
            }else{
    
                el.style.display = 'none';
    
            }
    
        });
    
    });
}




let stockSearchBox = document.querySelector(".sort-form-stocks input[name='search']");
if(stockSearchBox){
    stockSearchBox.addEventListener('keyup', (e) => {

        let stockList = document.querySelectorAll('.stock-wrapper .unit-list-item');
    
        
    
        stockList.forEach( el => {
    
            let name = el.querySelector('.name');
    
            if(name.innerText.includes(e.target.value)){
    
                el.style.display = 'grid';
    
            }else{
    
                el.style.display = 'none';
    
            }
    
        });
    
    });
}




