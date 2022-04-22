<?php

 

/*

 

Plugin Name: Market Data

 

Description: Plugin to fetch data on stocks, currencies, cryptocurrencie, and aggregate indices and economic variables. The data can be displayed on top bar, and on the Market Data archive page



Version: 0.1

 

Author: Lovel Mimica



*/



function md_enqueue_styles(){

    wp_enqueue_style( 'market-data-style', plugin_dir_url( __FILE__ ) . '/style.css');

}

add_action( 'wp_enqueue_scripts', 'md_enqueue_styles' );



function md_enqueue_scripts(){

    wp_enqueue_script('market_data_js', plugin_dir_url( __FILE__ ) . '/js/market-data.js');

}

add_action( 'wp_enqueue_scripts', 'md_enqueue_scripts' );



function md_add_type_attribute($tag, $handle, $src) {

    // if not Market Data script, do nothing and return original $tag

    if ( 'market_data_js' !== $handle ) {

        return $tag;

    }

    // change the script tag by adding type="module" and return it.

    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';

    return $tag;

}

add_filter('script_loader_tag', 'md_add_type_attribute' , 10, 3);



//Feature: Market Data Bar

function md_market_data_bar_item( $name, $value, $change ){

    $class = $change > 0 ? "fa-caret-up up" : "fa-caret-down down";

    if( $change == 0 ) $class = "";

    $change = abs( number_format( $change * 100, 2) ) . "%";

    $value = number_format( $value, 2 );



    return "<span class='market-data-item'><span class='name'>{$name}</span><span class='value'>{$value}</span><span class='change fas {$class}'>{$change}</span></span>";

}



function md_top_market_data_bar_shortcode(){  
    
    $url = get_permalink( get_page_by_path( 'market-data' )->ID );

    $output = "<section class='market-data-section'><a href='{$url}'><div class='market-data-items'>";



    $djia = get_page_by_title("DJIA", OBJECT, "market_data");

    $sp500 = get_page_by_title("S&amp;P 500", OBJECT, "market_data");

    $gdp = get_page_by_title("GDP p.c.", OBJECT, "market_data");

    $cpi = get_page_by_title("CPI", OBJECT, "market_data");

    $treasury_yield = get_page_by_title("U.S. 10 Yr", OBJECT, "market_data");

    $unemployment = get_page_by_title("Unemployment", OBJECT, "market_data");



    $output .= "<div class='market-data-bar-row'>";

    

    $output .= md_market_data_bar_item( $djia->post_title, get_field( 'current_price', $djia->ID ), get_field( 'change', $djia->ID ) );

    $output .= md_market_data_bar_item( $sp500->post_title, get_field( 'current_price', $sp500->ID ), get_field( 'change', $sp500->ID ) );

    $output .= md_market_data_bar_item( $gdp->post_title, get_field( 'current_price', $gdp->ID ), get_field( 'change', $gdp->ID ) );

    $output .= md_market_data_bar_item( $cpi->post_title, get_field( 'current_price', $cpi->ID ), get_field( 'change', $cpi->ID ) );

    $output .= md_market_data_bar_item( $treasury_yield->post_title, get_field( 'current_price', $treasury_yield->ID ), get_field( 'change', $treasury_yield->ID ) );

    $output .= md_market_data_bar_item( $unemployment->post_title, get_field( 'current_price', $unemployment->ID ), get_field( 'change', $unemployment->ID ) );



    $output .= "</div>";

    

    $output .= "</div></a></section>";



    return $output;

}

add_shortcode( "md_top_market_data_bar", "md_top_market_data_bar_shortcode" );



function md_crypto_market_data_bar_shortcode(){  
    
    $url = get_permalink( get_page_by_path( 'market-data' )->ID );

    $output = "<section class='market-data-section'><a href='{$url}'><div class='market-data-items crypto-data-items'>";

    $stock_posts = get_posts( array( 'post_type' => 'market_data', 'meta_key' => 'market_data_type', 'meta_value' => 'stock', 'numberposts' => -1 ) );

    $currency_posts = get_posts( array( 'post_type' => 'market_data', 'meta_key' => 'market_data_type', 'meta_value' => 'currency', 'numberposts' => -1 ) );

    $cryptocurrency_posts = get_posts( array( 'post_type' => 'market_data', 'meta_key' => 'market_data_type', 'meta_value' => 'cryptocurrency', 'numberposts' => -1 ) );     

    $counts = array( count( $stock_posts ), count( $currency_posts ), count( $cryptocurrency_posts ) );



    for( $i = 0; $i < ( count( $cryptocurrency_posts ) - ( count( $cryptocurrency_posts ) % 6 ) ); $i++ ){

        if( $i % 6 == 0 ){



            $output .= "<div class='market-data-bar-row'>";



            $output .= md_market_data_bar_item( $cryptocurrency_posts[$i]->post_title, get_field( 'current_price', $cryptocurrency_posts[$i]->ID ), get_field( 'change', $cryptocurrency_posts[$i]->ID ) );

            $output .= md_market_data_bar_item( $cryptocurrency_posts[$i + 1]->post_title, get_field( 'current_price', $cryptocurrency_posts[$i + 1]->ID ), get_field( 'change', $cryptocurrency_posts[$i + 1]->ID ) );

            $output .= md_market_data_bar_item( $cryptocurrency_posts[$i + 2]->post_title, get_field( 'current_price', $cryptocurrency_posts[$i + 2]->ID ), get_field( 'change', $cryptocurrency_posts[$i + 2]->ID ) );

            $output .= md_market_data_bar_item( $cryptocurrency_posts[$i + 3]->post_title, get_field( 'current_price', $cryptocurrency_posts[$i + 3]->ID ), get_field( 'change', $cryptocurrency_posts[$i + 3]->ID ) );

            $output .= md_market_data_bar_item( $cryptocurrency_posts[$i + 4]->post_title, get_field( 'current_price', $cryptocurrency_posts[$i + 4]->ID ), get_field( 'change', $cryptocurrency_posts[$i + 4]->ID ) );

            $output .= md_market_data_bar_item( $cryptocurrency_posts[$i + 5]->post_title, get_field( 'current_price', $cryptocurrency_posts[$i + 5]->ID ), get_field( 'change', $cryptocurrency_posts[$i + 5]->ID ) );

        

            $output .= "</div>";

        }

    }

    $output .= "</div></a></section>";



    return $output;

}

add_shortcode( "md_crypto_market_data_bar", "md_crypto_market_data_bar_shortcode" );





function md_add_market_data_post_type(){

    $args = array(

        'labels' => array(

            'name' => 'Market Data' 

        ),

        'menu_icon' => 'dashicons-money-alt',

        'public' => true,

        'show_ui' => true,

        'show_in_menu' => true

    );



    register_post_type( 'market_data', $args );

}

add_action( 'init', 'md_add_market_data_post_type' );



function md_fetch_stock_data(){

    error_log("Start fetching stock data");



    $djia_parts_json = file_get_contents("https://finnhub.io/api/v1/index/constituents?symbol=^DJI&token=c5g7td2ad3id0d5npe1g");

    $djia_parts = json_decode( $djia_parts_json )->constituents;



    $sp500_parts_json = file_get_contents("https://finnhub.io/api/v1/index/constituents?symbol=^GSPC&token=c5g7td2ad3id0d5npe1g");

    $sp500_parts = json_decode( $sp500_parts_json )->constituents;



    $all_stocks = array_merge( $djia_parts, $sp500_parts );



    $i = 0;

    foreach( $all_stocks as $stock){

        //Until SP500 indice constituents API is updated with data on merger of Cabot Oil & Gas Corp. and Cimarex Energy, change the symbol for Cabot Oil & Gas Corp (COG) to Coterra Energy (CTRA) 

        if( $stock == "COG" ) $stock = "CTRA";

        $stock_post = get_page_by_title($stock, OBJECT, "market_data");

        $modified_date = $stock_post ? get_the_modified_date( 'Y-m-d H', $stock_post->ID ) : null;

        $today = (new DateTime())->format( 'Y-m-d H' );



        if( $modified_date != $today ){

            $success = false;

            while( !$success ){

                $stock_data_json = file_get_contents("https://finnhub.io/api/v1/quote?symbol={$stock}&token=c5g7td2ad3id0d5npe1g");

                if( $stock_data_json ){

                    $stock_data = json_decode( $stock_data_json );

                    $success = true;

                }else{

                    $success = false;

                    sleep(1);

                    error_log($i . ": Trying again...");

                }

            }



            $success = false;

            while( !$success ){

                $company_data_json = file_get_contents("https://finnhub.io/api/v1/stock/profile2?symbol={$stock}&token=c5g7td2ad3id0d5npe1g");

                if( $company_data_json ){

                    $company_data = json_decode( $company_data_json );

                    if( $company_data->name ) $success = true;

                    else{

                        $success = false;

                        sleep(1);

                        error_log($i . ": Trying again...");

                    }

                }else{

                    $success = false;

                    sleep(1);

                    error_log($i . ": Trying again...");

                }

            }

            $name = $company_data->name;

            $current_price = $stock_data->c;

            $last_price = $stock_data->pc;

            $change = number_format( ( $current_price - $last_price ) / $last_price, 4 );

            $market_cap = $company_data->marketCapitalization;



            if( $stock_post ){

                //Update existing post

                error_log($i . ": Updating existing post");

                $stock_id = $stock_post->ID;           

            }else{

                //Create new post

                error_log($i . ": Creating a new post");

                $args = array(

                    'post_title' => $stock,

                    'post_type' => 'market_data',

                    'post_status' => 'publish'

                );

                $stock_id = wp_insert_post( $args );

            }



            update_field( 'last_price', $last_price, $stock_id );

            update_field( 'current_price', $current_price, $stock_id );

            update_field( 'change', $change, $stock_id );

            update_field( 'full_name', $name, $stock_id );

            update_field( 'market_data_type', 'stock', $stock_id );

            update_field( 'market_cap', $market_cap, $stock_id );



            $last_modified = new DateTime();

            wp_update_post( array(

                'ID' => $stock_id,

                'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

                'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) )

            ));



            error_log($i . ": Succesfully processed: " . $name);

            

        }else error_log($i . ": Skipping " . $stock);

        $i++;

    }

}



function md_fetch_currency_data(){

    error_log("Start fetching currency exchange rates");

    $forex_arr = array( 'EUR', 'JPY', 'CNY', 'CHF', 'GBP', 'RUB' );

    //$crypto_arr = array( 'BTC', 'ETH', 'LTC', 'ADA', 'DOT', 'BCH', 'XRP', 'USDT', 'XLM', 'USDC', 'BNB', 'AVAX' );

    

    $crypto_arr = array( 

        'BTC', 

        'ETH', 

        'LTC', 

        'ADA', 

        'DOT', 

        'BCH', 

        'XRP', 

        'USDT', 

        'XLM', 

        'AVAX', 

        // 'CRO', 

        'BNB', 

        'USDC', 

        'SOL', 

        // 'LINK', 

        // 'GRT', 

        'DOGE', 

        // 'BNB', 

        // 'UNI', 

        // 'MATIC', 

        // 'WBTC', 

        // 'THETA', 

        // 'ETC', 

        // 'VET', 

        // 'FIL', 

        // 'XMR',

        // 'EOS',

        // 'AAVE',

        // 'CVC',

        // 'BAND'

     );



    $currency_arr = array_merge( $forex_arr, $crypto_arr );



    $i = 0;

    foreach( $currency_arr as $currency ){

        $currency_post = get_page_by_title( $currency, OBJECT, "market_data" );

        $modified_date = $currency_post ? get_the_modified_date( 'Y-m-d H', $currency_post->ID ) : null;

        $today = (new DateTime())->format( 'Y-m-d H' );



        if( $modified_date != $today){            

            $success = false;

            while( !$success ){

                $currency_data_json = file_get_contents("https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency={$currency}&to_currency=USD&apikey=37TBZDYA240G1OMR");

                if( $currency_data_json ){

                    $currency_data = json_decode( $currency_data_json );

                    if( $currency_data->Note ){

                        $success = false;

                        sleep(1);

                        error_log($i . ": Trying again...");

                    }else{

                        $currency_data_arr = get_object_vars( $currency_data->{"Realtime Currency Exchange Rate"} );

                        $success = true;

                    }

                }else{

                    $success = false;

                    sleep(1);

                    error_log($i . ": Trying again...");

                }

            }

            

            $name = $currency_data_arr['2. From_Currency Name'];

            $current_price = $currency_data_arr['5. Exchange Rate'];

            $type = in_array( $currency, $forex_arr ) ? "currency" : "cryptocurrency";

            $popularity = count( $currency_arr ) - $i;



            if( $currency_post ){

                //Update existing post

                error_log($i . ": Updating existing currency post " . $current_price);

                $currency_id = $currency_post->ID;

                $last_price = get_field( 'current_price', $currency_id );

                if( !$last_price ) $last_price = $current_price;

                $change = number_format( ( $current_price - $last_price ) / $last_price, 4 );           

            }else{

                //Create new post

                error_log($i . ": Creating a new currency post");

                $args = array(

                    'post_title' => $currency,

                    'post_type' => 'market_data',

                    'post_status' => 'publish'

                );

                $last_price = $current_price;

                $change = 0;

                $currency_id = wp_insert_post( $args );

            }



            update_field( 'last_price', $last_price, $currency_id );

            update_field( 'current_price', $current_price, $currency_id );

            update_field( 'change', $change, $currency_id );

            if( $name ) update_field( 'full_name', $name, $currency_id );

            update_field( 'market_data_type', $type, $currency_id );

            update_field( 'popularity', $popularity, $currency_id );



            $last_modified = new DateTime();

            wp_update_post( array(

                'ID' => $currency_id,

                'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

                'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) )

            ));



            error_log($i . ": Succesfully processed: " . $name);

            

        }else error_log($i . ": Skipping " . $currency);

        $i++;

    }

}



function md_calculate_djia(){

    error_log("Starting DJIA calculation");

    $djia_parts_json = file_get_contents("https://finnhub.io/api/v1/index/constituents?symbol=^DJI&token=c5g7td2ad3id0d5npe1g");

    $djia_parts = json_decode( $djia_parts_json )->constituents;

    

    $i = 0;

    $price_sum = 0;

    $today = (new DateTime())->format( 'Y-m-d' );



    foreach( $djia_parts as $stock){

        if( $stock == "COG" ) $stock = "CTRA";

        $stock_post = get_page_by_title( $stock, OBJECT, 'market_data' );

        $modified_date = $stock_post ? get_the_modified_date( 'Y-m-d', $stock_post ) : null;

        if( $modified_date != $today ){

            error_log("Stock " . $stock . " needs update");

            return;

        } 



        $price = get_field( 'current_price', $stock_post->ID );

        $price_sum += $price;

        $i++;

    }

    //$dow_divisor = 0.15188516925198;

    $dow_divisor = 0.15198707565833;

    

    $djia = $price_sum / $dow_divisor;



    $djia_post = get_page_by_title("DJIA", OBJECT, "market_data");



    if( $djia_post ){

        //Update existing DJIA post

        $id = $djia_post->ID;



        $last_value = get_field( 'current_price', $id );

        $change = number_format( ( $djia - $last_value ) / $last_value, 4 );

    }else{

        //Create new DJIA post

        $args = array(

            'post_title' => "DJIA",

            'post_type' => 'market_data',

            'post_status' => 'publish'

        );

        $id = wp_insert_post( $args );

        

        $last_value = $djia;

        $change = 0;

    }



    update_field( 'last_price', $last_value, $id );

    update_field( 'current_price', $djia, $id );

    update_field( 'change', $change, $id );

    update_field( 'full_name', "Dow Jones Industrial Average", $id );

    update_field( 'market_data_type', 'aggregate', $id );

    

    $last_modified = new DateTime();

    wp_update_post( array(

        'ID' => $id,

        'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

        'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) )

    ));

    error_log("DJIA calculated");

}



function md_update_market_data(){

    // $market_data = get_posts( array( 'post_type' => 'market_data', 'numberposts' => -1 ) );

    // $i = 0;

    // $today = (new DateTime())->format( 'Y-m-d H' );



    // foreach( $market_data as $post ){

    //     $modified_date = get_the_modified_date( 'Y-m-d H', $post );

    //     if( $today == $modified_date ) error_log($i . ": Stock " . $post->post_title . " is updated OK");

    //     else  error_log($i . ": Stock " . $post->post_title . " is updated earlier, and needs to do it again");

    //     error_log($i . ": " . $post->post_title . " " . get_field("current_price", $post->ID) );

    //     error_log($i . ": " . $post->post_title . " market cap: " . get_field( 'market_capitalization', $post->ID ));

    //     $i++;

    // }

    md_fetch_stock_data();

    md_fetch_currency_data();

    md_calculate_djia();

}



//wp_clear_scheduled_hook( 'hourly_update_market_data' );

if( !wp_next_scheduled( "hourly_update_market_data" ) ){

    wp_schedule_event( time(), "hourly", "hourly_update_market_data" );

}

add_action( 'hourly_update_market_data', 'md_update_market_data' );



function md_fetch_sp500(){

    error_log("Starting SP500 fetch");



    $success = false;

    while( !$success ){

        $sp500_json = file_get_contents( "https://eodhistoricaldata.com/api/search/%20GSPC.INDX%20?api_token=61b7612c528b11.67335175" );

        $sp500_obj = json_decode( $sp500_json );

        if( $sp500_json && $sp500_obj[0]->previousClose ){

            $sp500 = $sp500_obj[0]->previousClose;

            $success = true;

        }else{

            $success = false;

            sleep(1);

            error_log("S&P 500 fetch: Trying again...");

        }

    }    



    $sp500_post = get_page_by_title("S&amp;P 500", OBJECT, "market_data");



    if( $sp500_post ){

        //Update existing SP500 post

        $id = $sp500_post->ID;



        $last_value = get_field( 'current_price', $id );

        $change = number_format( ( $sp500 - $last_value ) / $last_value, 4 );

    }else{

        //Create new SP500 post

        $args = array(

            'post_title' => "S&amp;P 500",

            'post_type' => 'market_data',

            'post_status' => 'publish'

        );

        $id = wp_insert_post( $args );

        

        $last_value = $sp500;

        $change = 0;

    }

    update_field( 'last_price', $last_value, $id );

    update_field( 'current_price', $sp500, $id );

    update_field( 'change', $change, $id );

    update_field( 'full_name', "Standard and Poor's 500", $id );

    update_field( 'market_data_type', 'aggregate', $id );

    

    $last_modified = new DateTime();

    wp_update_post( array(

        'ID' => $id,

        'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

        'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) )

    ));

    error_log("SP500 updated");

}



function md_fetch_gdp(){

    error_log("Starting GDP p.c. fetch");



    $success = false;

    while( !$success ){

        $gdp_json = file_get_contents( "https://www.alphavantage.co/query?function=REAL_GDP_PER_CAPITA&apikey=37TBZDYA240G1OMR" );

        $gdp_obj = json_decode( $gdp_json );

        if( $gdp_json && $gdp_obj->data[0]->value ){

            $gdp = $gdp_obj->data[0]->value;

            $last_value = $gdp_obj->data[1]->value;

            $change = number_format( ( $gdp - $last_value ) / $last_value, 4 );

            $full_name = $gdp_obj->name;

            $content = json_encode( $gdp_obj->data );



            $success = true;

        }else{

            $success = false;

            sleep(1);

            error_log("GDP p.c. fetch: Trying again...");

        }

    }    



    $gdp_post = get_page_by_title("GDP p.c.", OBJECT, "market_data");



    if( $gdp_post ){

        //Update existing GDP post

        $id = $gdp_post->ID;

    }else{

        //Create new GDP post

        $args = array(

            'post_title' => "GDP p.c.",

            'post_type' => 'market_data',

            'post_status' => 'publish'

        );

        $id = wp_insert_post( $args );

    }



    update_field( 'last_price', $last_value, $id );

    update_field( 'current_price', $gdp, $id );

    update_field( 'change', $change, $id );

    update_field( 'full_name', $full_name, $id );

    update_field( 'market_data_type', 'aggregate', $id );

    

    $last_modified = new DateTime();

    wp_update_post( array(

        'ID' => $id,

        'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

        'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) ),

        'post_content' => $content

    ));

    error_log("GDP p.c. updated");

}



function md_fetch_cpi(){

    error_log("Starting CPI fetch");



    $success = false;

    while( !$success ){

        $cpi_json = file_get_contents( "https://www.alphavantage.co/query?function=CPI&interval=monthly&apikey=37TBZDYA240G1OMR" );

        $cpi_obj = json_decode( $cpi_json );

        if( $cpi_json && $cpi_obj->data[0]->value ){

            $cpi = $cpi_obj->data[0]->value;

            $last_value = $cpi_obj->data[1]->value;

            $change = number_format( ( $cpi - $last_value ) / $last_value, 4 );

            $full_name = $cpi_obj->name;

            $content = json_encode( $cpi_obj->data );

            

            $success = true;

        }else{

            $success = false;

            sleep(1);

            error_log("CPI fetch: Trying again...");

        }

    }    



    $cpi_post = get_page_by_title("CPI", OBJECT, "market_data");



    if( $cpi_post ){

        //Update existing CPI post

        $id = $cpi_post->ID;

    }else{

        //Create new CPI post

        $args = array(

            'post_title' => "CPI",

            'post_type' => 'market_data',

            'post_status' => 'publish'

        );

        $id = wp_insert_post( $args );

    }



    update_field( 'last_price', $last_value, $id );

    update_field( 'current_price', $cpi, $id );

    update_field( 'change', $change, $id );

    update_field( 'full_name', $full_name, $id );

    update_field( 'market_data_type', 'aggregate', $id );

    

    $last_modified = new DateTime();

    wp_update_post( array(

        'ID' => $id,

        'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

        'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) ),

        'post_content' => $content

    ));

    error_log("CPI updated");

}



function md_fetch_treasury_yield(){

    error_log("Starting U.S. 10 Yr fetch");



    $success = false;

    while( !$success ){

        $ty_json = file_get_contents( "https://www.alphavantage.co/query?function=TREASURY_YIELD&interval=monthly&maturity=10year&apikey=37TBZDYA240G1OMR" );

        $ty_obj = json_decode( $ty_json );

        if( $ty_json && $ty_obj->data[0]->value ){

            $ty = $ty_obj->data[0]->value;

            $last_value = $ty_obj->data[1]->value;

            $change = number_format( ( $ty - $last_value ) / $last_value, 4 );

            $full_name = $ty_obj->name;

            $content = json_encode( $ty_obj->data );   

            

            $success = true;

        }else{

            $success = false;

            sleep(1);

            error_log("U.S. 10 Yr fetch: Trying again...");

        }

    }    



    $ty_post = get_page_by_title("U.S. 10 Yr", OBJECT, "market_data");



    if( $ty_post ){

        //Update existing U.S. 10 Yr post

        $id = $ty_post->ID;

    }else{

        //Create new U.S. 10 Yr post

        $args = array(

            'post_title' => "U.S. 10 Yr",

            'post_type' => 'market_data',

            'post_status' => 'publish'

        );

        $id = wp_insert_post( $args );

    }



    update_field( 'last_price', $last_value, $id );

    update_field( 'current_price', $ty, $id );

    update_field( 'change', $change, $id );

    update_field( 'full_name', $full_name, $id );

    update_field( 'market_data_type', 'aggregate', $id );

    

    $last_modified = new DateTime();

    wp_update_post( array(

        'ID' => $id,

        'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

        'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) ),

        'post_content' => $content

    ));

    error_log("U.S. 10 Yr updated");

}



function md_fetch_unemployment(){

    error_log("Starting unemployment fetch");



    $success = false;

    while( !$success ){

        $unemployment_json = file_get_contents( "https://www.alphavantage.co/query?function=UNEMPLOYMENT&apikey=37TBZDYA240G1OMR" );

        $unemployment_obj = json_decode( $unemployment_json );

        if( $unemployment_json && $unemployment_obj->data[0]->value ){

            $unemployment = $unemployment_obj->data[0]->value;

            $last_value = $unemployment_obj->data[1]->value;

            $change = number_format( ( $unemployment - $last_value ) / $last_value, 4 );

            $full_name = $unemployment_obj->name;

            $content = json_encode( $unemployment_obj->data ); 

            

            $success = true;

        }else{

            $success = false;

            sleep(1);

            error_log("Unemployment fetch: Trying again...");

        }

    }    



    $unemployment_post = get_page_by_title("Unemployment", OBJECT, "market_data");



    if( $unemployment_post ){

        //Update existing unemployment post

        $id = $unemployment_post->ID;

    }else{

        //Create new unemployment post

        $args = array(

            'post_title' => "Unemployment",

            'post_type' => 'market_data',

            'post_status' => 'publish'

        );

        $id = wp_insert_post( $args );

    }



    update_field( 'last_price', $last_value, $id );

    update_field( 'current_price', $unemployment, $id );

    update_field( 'change', $change, $id );

    update_field( 'full_name', $full_name, $id );

    update_field( 'market_data_type', 'aggregate', $id );

    

    $last_modified = new DateTime();

    wp_update_post( array(

        'ID' => $id,

        'post_date' => $last_modified->format( 'Y-m-d H:i:s' ),

        'post_date_gmt' => get_gmt_from_date( $last_modified->format( 'Y-m-d H:i:s' ) ),

        'post_content' => $content

    ));

    error_log("Unemployment updated");

}



function md_fetch_aggregate_market_data(){

    md_fetch_sp500();

    md_fetch_gdp();

    md_fetch_cpi();

    md_fetch_treasury_yield();

    md_fetch_unemployment();

}



//wp_clear_scheduled_hook( 'twicedaily_fetch_aggregate_market_data' );

if( !wp_next_scheduled( "twicedaily_fetch_aggregate_market_data" ) ){

    wp_schedule_event( time(), "twicedaily", "twicedaily_fetch_aggregate_market_data" );

}

add_action( 'twicedaily_fetch_aggregate_market_data', 'md_fetch_aggregate_market_data' );



//Feature: Market Data archive page content shortcode

function md_market_data_aggregate( $title, $echo = true ){

    $post = get_page_by_title( $title, OBJECT, "market_data" );

    $name = $post->post_title;

    $full_name = get_field( 'full_name', $post->ID );

    $value = get_field( 'current_price', $post->ID );

    $change = get_field( 'change', $post->ID );



    $class = $change > 0 ? "fa-caret-up up" : "fa-caret-down down";

    if( $change == 0 ) $class = "";

    $change = abs( number_format( $change * 100, 2) ) . "%";

    $value = number_format( $value, 2 );

    

    if( $echo ){

        echo "<div class='market-data-aggregate-item'><h2 class='market-data-title'>{$name}</h2>";

        echo "<h6 class='market-data-fullname'>{$full_name}</h6>";

        echo "<p class='market-data-value'>{$value}";

        echo "<span class='change fas {$class}'>{$change}</span></p></div>";   

    }else{

        $output = "<div class='market-data-aggregate-item'><h2 class='market-data-title'>{$name}</h2>";

        $output .= "<h6 class='market-data-fullname'>{$full_name}</h6>";

        $output .= "<p class='market-data-value'>{$value}";

        $output .= "<span class='change fas {$class}'>{$change}</span></p></div>";

        

        return $output;

    }                        

}



function md_market_data_unit_list_item( $unit, $value_decimals = 4 ){

    $name = $unit->post_title;

    $value = get_field( 'current_price', $unit->ID );

    $change = get_field( 'change', $unit->ID );

    $full_name = get_field( 'full_name', $unit->ID );



    $class = $change > 0 ? "fa-caret-up up" : "fa-caret-down down";

    if( $change == 0 ) $class = "";

    $change = abs( number_format( $change * 100, 2) ) . "%";

    $value = number_format( $value, $value_decimals );

    

    if( get_field( 'market_data_type', $unit->ID ) == 'stock' ) $sort_value = get_field( 'market_cap', $unit->ID );

    else if( get_field( 'market_data_type', $unit->ID ) == 'cryptocurrency' ) $sort_value = get_field( 'popularity', $unit->ID );

    else $sort_value = "";

    $li_string = <<<"EOL"

            <div class='unit-list-item' data-sortval='{$sort_value}'>

                <p class='name'><span class='unit-fullname'>{$full_name}</span>

                <span class='unit-title'>({$name})</span></p>

                <p class='value'><span class='unit-value'>{$value}</span>

                <span class='unit-change fas {$class}'>{$change}</span></p>

            </div>

        EOL;

    echo $li_string;

}



function md_market_data_archive_content_shortcode(){ ?>

    <section class='market-data-content-section'>    

        <div class='aggregates-wrapper'>

            <div class='market-data-aggregate'>

                <?php 

                    md_market_data_aggregate( "GDP p.c." );

                ?>

            </div>

            <div class='middle-border'></div>

            <div class='market-data-aggregate'>

                <?php 

                    md_market_data_aggregate( "CPI" );

                ?>

            </div>

            <div class='middle-border'></div>

            <div class='market-data-aggregate'>

                <?php

                    md_market_data_aggregate( "U.S. 10 Yr" ); 

                ?>

            </div>

            <div class='market-data-aggregate'>

                <?php

                    md_market_data_aggregate( "S&amp;P 500" );  

                ?>

            </div>

            <div class='middle-border'></div>

            <div class='market-data-aggregate'>

                <?php

                    md_market_data_aggregate( "DJIA" );   

                ?>

            </div>

            <div class='middle-border'></div>

            <div class='market-data-aggregate'>

                <?php

                    md_market_data_aggregate( "Unemployment" );    

                ?>

            </div>

        </div>

        <h2 class='unit-list-title'>Currencies</h2>

        <div class='currencies-wrapper'><?php

            $units = get_posts( array( 'post_type' => 'market_data', 'meta_key' => 'market_data_type', 'meta_value' => 'currency', 'numberposts' => 6 ) );

            $i = 0;

            foreach( $units as $unit ){

                md_market_data_unit_list_item( $unit );

                if( $i < count( $units ) - 1  ) echo "<div class='middle-border'></div>";

                $i++;

            }

            

            ?>

        </div>

        <h2 class='unit-list-title'>Cryptocurrencies</h2>

        <div class='sort-form-wrapper'>

            <form class='sort-form sort-form-crypto'>

                <b>Sort by </b>

                <label for='md_crypto_sort_alphabetical'><input type='radio' name='sort' id='md_crypto_sort_alphabetical' value='alphabetical'>Name</label>

                <label for='md_crypto_sort_popular'><input type='radio' name='sort' id='md_crypto_sort_popular' value='popular'>Popularity</label>

                <label for='md_crypto_sort_change'><input type='radio' name='sort' id='md_crypto_sort_change' value='change'>Change</label>

                <label for='md_crypto_sort_value'><input type='radio' name='sort' id='md_crypto_sort_value' value='value'>Value</label>

                <input type='text' name='search' placeholder='Search by name'>

            </form>

        </div>

        <div class='crypto-wrapper'><?php

            $units = get_posts( array( 'post_type' => 'market_data', 'meta_key' => 'market_data_type', 'meta_value' => 'cryptocurrency', 'numberposts' => -1 ) );

            $i = 0;

            foreach( $units as $unit ){

                md_market_data_unit_list_item( $unit, 2 );

                $i++;

            }

        ?></div>

        <h2 class='unit-list-title'>Stocks</h2>

        <div class='sort-form-wrapper'>

            <form class='sort-form sort-form-stocks'>

                <b>Sort by </b>

                <label for='md_stock_sort_alphabetical'><input type='radio' name='sort' id='md_stock_sort_alphabetical' value='alphabetical'>Name</label>

                <label for='md_stock_sort_market-cap'><input type='radio' name='sort' id='md_stock_sort_market-cap' value='market-cap'>Market Cap</label>

                <label for='md_stock_sort_change'><input type='radio' name='sort' id='md_stock_sort_change' value='change'>Change</label>

                <label for='md_stock_sort_value'><input type='radio' name='sort' id='md_stock_sort_value' value='value'>Value</label>

                <input type='text' name='search' placeholder='Search by name'>

            </form>

        </div>

        <div class='stock-wrapper'><?php

            $units = get_posts( array( 'post_type' => 'market_data', 'meta_key' => 'market_data_type', 'meta_value' => 'stock', 'numberposts' => -1 ) );

            $i = 0;

            foreach( $units as $unit ){

                md_market_data_unit_list_item( $unit, 2 );

                $i++;

            }

        ?></div>

    </section>    

<?php }

add_shortcode( 'md_market_data_archive_content', 'md_market_data_archive_content_shortcode' );



function md_sidebar_aggregates_shortcode(){

    $djia = get_page_by_title("DJIA", OBJECT, "market_data");

    $sp500 = get_page_by_title("S&amp;P 500", OBJECT, "market_data");

    $gdp = get_page_by_title("GDP p.c.", OBJECT, "market_data");

    $treasury_yield = get_page_by_title("U.S. 10 Yr", OBJECT, "market_data");

    $url = get_permalink( get_page_by_path( 'market-data' )->ID );

    $output = "<a href='{$url}'><div class='sidebar-aggregates'>";

    $output .= md_market_data_aggregate( "GDP p.c.", false );

    $output .= "<div class='middle-border'></div>";

    $output .= md_market_data_aggregate( "U.S. 10 Yr", false );

    $output .= "<div class='middle-border'></div>";

    $output .= md_market_data_aggregate( "S&amp;P 500", false );  

    $output .= "<div class='middle-border'></div>";

    $output .= md_market_data_aggregate( "DJIA", false );   

    $output .= "</div></a>";

    

    return $output;

}

add_shortcode( 'md_sidebar_aggregates', 'md_sidebar_aggregates_shortcode' );