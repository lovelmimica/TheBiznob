<?php
session_start();

//Limit login attempts to 3
function check_attempted_login( $user, $username, $password ) {

    if ( get_transient( 'attempted_login' ) ) {

        $datas = get_transient( 'attempted_login' );



        if ( $datas['tried'] >= 3 ) {

            $until = get_option( '_transient_timeout_' . 'attempted_login' );

            $time = time_to_go( $until );



            return new WP_Error( 'too_many_tried',  sprintf( __( '<strong>ERROR</strong>: You have reached authentication limit, you will be able to try again in %1$s.' ) , $time ) );

        }

    }



    return $user;

}

add_filter( 'authenticate', 'check_attempted_login', 30, 3 ); 

function login_failed( $username ) {

    if ( get_transient( 'attempted_login' ) ) {

        $datas = get_transient( 'attempted_login' );

        $datas['tried']++;



        if ( $datas['tried'] <= 3 )

            set_transient( 'attempted_login', $datas , 300 );

    } else {

        $datas = array(

            'tried'     => 1

        );

        set_transient( 'attempted_login', $datas , 300 );

    }

}

add_action( 'wp_login_failed', 'login_failed', 10, 1 ); 



function time_to_go($timestamp){
    // converting the mysql timestamp to php time

    $periods = array(

        "second",

        "minute",

        "hour",

        "day",

        "week",

        "month",

        "year"

    );

    $lengths = array(

        "60",

        "60",

        "24",

        "7",

        "4.35",

        "12"

    );

    $current_timestamp = time();

    $difference = abs($current_timestamp - $timestamp);

    for ($i = 0; $difference >= $lengths[$i] && $i < count($lengths) - 1; $i ++) {

        $difference /= $lengths[$i];

    }

    $difference = round($difference);

    if (isset($difference)) {

        if ($difference != 1)

            $periods[$i] .= "s";

            $output = "$difference $periods[$i]";

            return $output;

    }

}

//Enqueue styles and scripts
function zox_child_enqueue_styles() {

    $parent_style = 'zox-custom-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'fontawesome-child', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css' );
    wp_enqueue_style( 'tinly-slider', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css' );
    wp_enqueue_style( 'zox-custom-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'zox_child_enqueue_styles' );

function enqueue_scripts(){
    wp_enqueue_script('core_js', get_stylesheet_directory_uri() . '/js/core.js');
    //wp_enqueue_script('breaking_news_slider_js', get_stylesheet_directory_uri() . '/js/breaking-news-slider.js');
    //wp_enqueue_script('affiliate_products_slider_js', get_stylesheet_directory_uri() . '/js/affiliate-products-slider.js');
    wp_enqueue_script('cookie_consent_popup_js', get_stylesheet_directory_uri() . '/js/cookies-consent-popup.js');
    wp_enqueue_script('sticky_sidebar_js', get_stylesheet_directory_uri() . '/js/sticky-sidebar.js');
    if( is_single() ) wp_enqueue_script('single_post_js', get_stylesheet_directory_uri() . '/js/single-post.js');
    wp_enqueue_script('my_account_js', get_stylesheet_directory_uri() . '/js/my-account.js');
    wp_enqueue_script('latest_news_toggler_js', get_stylesheet_directory_uri() . '/js/latest-news-toggler.js');
    if( is_front_page() || is_page('videos') ) wp_enqueue_script('video_section_js', get_stylesheet_directory_uri() . '/js/video-section.js');
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' ); 

//Feature: Quote of the Day
function add_quote_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'Quotes of the Day',
            'singular_name' => 'Qoute of the Day' 
        ),
        'menu_icon' => 'dashicons-format-quote',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
    );

    register_post_type( 'quote', $args );
}
add_action( 'init', 'add_quote_post_type' );

//Feature: General functions
function get_post_content_by_id($postID) {
    $content_post = get_post($postID);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}

//Feature: Video section
function fetch_video_data(){
    $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&order=date&channelId=UCRuQYkYlu7KVEVHxxtTO72g&maxResults=20&key=AIzaSyDrKrBIaT4x6X9wRQ1Des8sxfNGrxAudq0";
    $response = json_decode(file_get_contents( $url ));

    foreach( $response->items as $item ){ 
        if( $item->id->kind == "youtube#video" ){
            $id =  $item->id->videoId;
            
            if( null == get_posts( array( 'post_type' => 'video', 'meta_key' => 'video_id', 'meta_value' => $id ) )[0] ){
                $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$id}&key=AIzaSyDrKrBIaT4x6X9wRQ1Des8sxfNGrxAudq0";
                $response = json_decode(file_get_contents( $url ));
    
                $published_at = date_create_from_format( 'D, Y-M-d h:i:s', $response->items[0]->snippet->publishedAt );
                $title = $response->items[0]->snippet->title;
                $description = $response->items[0]->snippet->description;
                $image_url = $response->items[0]->snippet->thumbnails->high->url;
                
                $args = array(
                    'post_type' => 'video',
                    'post_title' => $title, 
                    'post_content' => $description,
                    'post_status' => 'publish'
                );
    
                $video_post_id = wp_insert_post( $args );
    
                update_field( 'video_id', $id, $video_post_id );
                update_field( 'published_at', $published_at, $video_post_id );
                update_field( 'image_url', $image_url, $video_post_id );
                
                wp_update_post( array(
                    'ID' => $video_post_id,
                    'post_date' => $published_at->format( 'Y-m-d H:i:s' ),
                    'post_date_gmt' => get_gmt_from_date( $published_at->format( 'Y-m-d H:i:s' ) )
                ));
            } 
        }
    }
}
//wp_clear_scheduled_hook( 'daily_fetch_video_data' );
if( !wp_next_scheduled( "daily_fetch_video_data" ) ){
    wp_schedule_event( time(), "daily", "daily_fetch_video_data" );
}
add_action( "daily_fetch_video_data", "fetch_video_data" );

function add_video_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'Videos',
            'singular_name' => 'Video' 
        ),
        'menu_icon' => 'dashicons-youtube',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'video', $args );
}
add_action( 'init', 'add_video_post_type' );

function video_card_shortcode( $atts ){
    $a = shortcode_atts( array(
        "class" => "",
        "id" => null
    ), $atts );
    
    if( $a['id'] == null ) return;
    $id = $a['id'];

    $title = get_the_title( $id );
    $description = get_post_content_by_id( $id );
    $video_id = get_field( 'video_id', $id );
    $published_at = get_field( 'published_at', $id );
    $thumbnail_url = get_field( 'image_url', $id );
    
    $date = get_the_date( 'D, Y-M-d H:i:s', $id );
    
    $date_int = strtotime( $date );

    $output = <<<"EOL"
            <article class='video-card {$a['class']}' data-videoid='{$video_id}' data-published='{$date_int}' data-played='false'>
                <h3 class='video-title'>{$title}</h3>
                <div class='iframe-wrapper' data-videoid='{$video_id}'>
                    <div id='video-{$video_id}' class='player-container'></div>
                    <div class='video-thumbnail'>
                        <img src='{$thumbnail_url}'>
                        <i class="fas fa-play-circle ctrl-play"></i>
                        <div class='display-ctrls'>
                            <i class="fas fa-times ctrl-close"></i>
                            <i class="fas fa-expand-arrows-alt ctrl-expand"></i>
                            <i class="fas fa-minus ctrl-minimize"></i>
                        </div>
                    </div>
                </div>
                <span class='video-date'>{$date}</span>
                <div class='video-description'>{$description}</div>
            </article>
        EOL;
        
    return $output;
}
add_shortcode( 'video_card', 'video_card_shortcode' );

//Feature: Breaking News section
function breaking_news_slider_shortcode(){
    $posts = get_posts( array( "numberposts" => 1, "tag" => 'breaking-news' ) );
    $post = $posts[0];

    $layout_type = rand(1, 5);
    //$layout_type = 1;

    $class = "layout-type-{$layout_type}";
    $permalink = get_the_permalink( $post->ID );
    $words = str_word_count( $post->post_content );
    $reading_time = round( $words / 200 );

    $user_id = get_current_user_id();

    if( $user_id != 0 ){
        $readlist = get_field( "read_list", "user_" . $user_id );
        $post_in_readlist = $readlist != null && in_array( $post->ID, $readlist ) ? true : false; 
    }else{
        $post_in_readlist = false;
    }

    $readlist_control_txt = $post_in_readlist ? "Remove from Readlist" : "Add to Readlist";
    $dashicon_class = $post_in_readlist ? "in-readlist fa-bookmark" : "fa-bookmark";

    $output = "<section class='breaking-news-section'>";
    $output .= "<div class='breaking-news-wrapper {$class}'>";
    if( $class == "layout-type-2" ) $output .= "<a class='post-link' href='{$permalink}'><h3 class='post-title'>$post->post_title</h3></a>";
    if( $class == "layout-type-5" ) $output .= 
        <<<"EOL"
            <a class='post-link' href='{$permalink}'><h3 class='post-title'>$post->post_title</h3></a>
        EOL;

    $output .= do_shortcode( "[post_card post_id={$post->ID} class='breaking-news' latest_posts_count=6/]" ); 
    $output .= "</div></section>";

    return $output;
}
add_shortcode( "breaking_news_slider", "breaking_news_slider_shortcode" );

//Feature: Category Section
function category_section_shortcode( $atts ){
    $a = shortcode_atts( array(
        "category" => null
    ), $atts );

    if( $a["category"] == null ) return;

    $category = get_category_by_slug( $a["category"] );
    $category_link = get_category_link( $category );

    $subcategories = get_categories( array( "parent" => $category->term_id ) );

    $navbar = "<a class='category-link' href={$category_link}><b>$category->name</b></a>";

    foreach( $subcategories as $subcategory ){
        $subcategory_link = get_category_link( $subcategory );
        $navbar .= "<a href={$subcategory_link}>{$subcategory->name}</a>";  
    }
    
    $output = <<<"EOD"
            <section class='category-section'>
            <header class='category-section-head'>
                <nav class='subcategory-navigation'>
                    {$navbar}
                </nav>
            </header>
            <div class='category-section-body'>
        EOD;

    $args = array(
        "category" => $category->term_id,
        "numberposts" => 5
    );
    
    $posts = get_posts( $args );
    if( count($posts) == 0 ) return;
    
    foreach( $posts as $post ){
        $output .= do_shortcode("[post_card post_id=" . $post->ID . "/]");
    }

    $output .= "</div></section>";

    return $output;
}
add_shortcode( "category_section", "category_section_shortcode" );

//Feature: Post card shortcode
// function add_watermark_to_image( $html ){
//     $html .= "<img class='watermark' src='http://www.biznob.com/wp-content/uploads/2021/11/biznob-logo-e1636331077805.png'/>";

//     return $html;
// }
// add_filter( 'post_thumbnail_html', 'add_watermark_to_image' );

function post_card_shortcode( $atts ){
    $a = shortcode_atts( array(
        "post_id" => null,
        "class" => "",
        "latest_posts_count" => 0,
        "excerpt_length" => null 
    ), $atts );
    if( $a['post_id'] == null ) return;
    
    $post = get_post( $a['post_id'] );
    if($post == null ) return;

    if( isset($_SESSION["displayed-posts"]) ) array_push( $_SESSION["displayed-posts"], $post->ID );

    $class = $a["class"];
    $permalink = get_permalink( $post->ID );
    $thumbnail = get_the_post_thumbnail( $post->ID );

    $user_id = get_current_user_id();

    if( $user_id != 0 ){
        $readlist = get_field( "read_list", "user_" . $user_id );
        $post_in_readlist = $readlist != null && in_array( $post->ID, $readlist ) ? true : false; 
    }else{
        $post_in_readlist = false;
    }

    /*$category_id = wp_get_post_categories( $post->ID )[0];
    $category_link = get_category_link( $category_id );
    $category_name = get_cat_name( $category_id );*/

    $author_object = get_userdata( $post->post_author );
    $author_display_name = $author_object->data->display_name;
    $author_archive_url = get_author_posts_url( $author_object->data->ID );

    $words = str_word_count( $post->post_content );
    $reading_time = round( $words / 200 );

    $readlist_control_txt = $post_in_readlist ? "Remove from Readlist" : "Add to Readlist";
    $dashicon_class = $post_in_readlist ? "in-readlist fa-bookmark" : "fa-bookmark";

    $excerpt = $a["excerpt_length"] > 0 ? substr( get_the_excerpt( $post->ID ), 0, $a["excerpt_length"] ) . "..." : get_the_excerpt( $post->ID );


    if( $a['latest_posts_count'] > 0 ){
        $latest_posts_div = "<h2 class='latest-posts-title'>Latest Posts</h3>";
        $latest_posts_div .= "<ul class='latest-posts-list'>";
        $latest_posts = get_posts( array( 'numberposts' => $a['latest_posts_count'], 'exclude' => $_SESSION["displayed-posts"] ) );
        $i = 0;
        foreach( $latest_posts as $latest_post ){
            $latest_post_permalink = get_permalink( $latest_post->ID );
            $latest_post_age = human_time_diff( strtotime($latest_post->post_date) );
            $latest_posts_div .= "<li class='latest-post'><a href='{$latest_post_permalink}'><h3 class='post-title'>{$latest_post->post_title}</h3></a><span class='published-before'>{$latest_post_age} ago</span></li>";
            if( $i == 2) $latest_posts_div .= "<span class='middle-border'></span>";

            array_push( $_SESSION["displayed-posts"], $latest_post->ID );

            $i++;
        }
        $latest_posts_div .= "</ul>";
    }else $latest_posts_div = "";
    

    $output = <<<"EOL"
            <article class='post-card {$class} post-{$post->ID}'>
                <a class='post-link image-box' href="{$permalink}">
                    {$thumbnail}
                </a>
                <div class='content-box'>
                    <a class='post-link title-box' href="{$permalink}">
                        <h3 class='post-title'>{$post->post_title}</h3>
                    </a>                   
                    <div class='post-data-box'>
                        <span class="post-author">By <a class='author-link' href={$author_archive_url}>{$author_display_name}</a>,&nbsp;</span>
                        <span class="far fa-clock reading-time">{$reading_time} min read</span>
                        <button class="readlist-control fas {$dashicon_class}" title='{$readlist_control_txt}' data-user="{$user_id}" data-post="{$post->ID}" data-inreadlist="{$post_in_readlist}"></button>
                    </div>
                    <p class='post-excerpt'>{$excerpt}&nbsp;&nbsp;<a href={$permalink} class='read-more-link'>Read more<span class="fas fa-angle-right"></span></a></p>
                    {$latest_posts_div}
                </div>    
            </article>
    EOL;
    return $output;
}
add_shortcode( "post_card", "post_card_shortcode" );

//Feature: Modified read more link
function custom_excerpt_more($more) {
    global $post;
    return '...';
   }
add_filter('excerpt_more', 'custom_excerpt_more');

//Feature: People Profile Fields display on Single Post page
function format_amount( $amount, $precision = 2 ){
    if( $amount < 1000000 ) return $amount;
    else if( $amount < 1000000000 ) return number_format( $amount / 1000000, $precision ) . "M";
    else return number_format( $amount / 1000000000, $precision ) . "B";
}

function people_fields_shortcode( $atts ){
    $a = shortcode_atts( array(
        'id' => null
    ), $atts );
    
    if( $a['id'] == null ) return;
    
    $id = $a['id'];

    $full_name = get_field( 'full_name', $id );
    $net_worth = get_field( 'net_worth', $id );
    $forbes_position = get_field( 'position_on_forbes_list', $id );
    $age = get_field( 'age', $id );
    $wealth_source = get_field( 'source_of_wealth', $id );
    $residence = get_field( 'residence', $id );
    $citizenship = get_field( 'citizenship', $id );

    if( $full_name == null && $net_worth == null && $forbes_position == null && $age == null && $wealth_source == null && $residence == null && $citizenship == null ) return;
    $formated_net_worth = format_amount( $net_worth );
    $output = "<div class='people-fields-wrapper'>";
    
    if( $full_name ) $output .= "<p class='full-name'>{$full_name}</p>";
    if( $net_worth ) $output .= "<p class='net-worth'><strong>Net Worth: </strong>USD {$formated_net_worth}</p><hr>";
    if( $forbes_position ) $output .= "<p class='forbes-position'><strong>#{$forbes_position}</strong> on Forbes Billionaires List</p><hr>";
    if( $age ) $output .= "<p class='personal-stat'><strong>Age: </strong>{$age}</p><hr>";
    if( $wealth_source ) $output .= "<p class='personal-stat'><strong>Source of Wealth: </strong>{$wealth_source}</p><hr>";
    if( $residence ) $output .= "<p class='personal-stat'><strong>Residence: </strong>{$residence}</p><hr>";
    if( $citizenship ) $output .= "<p class='personal-stat'><strong>Citizenship: </strong>{$citizenship}</p><hr>";

    $output .= "</div>";

    return $output;
}
add_shortcode( 'people_fields', 'people_fields_shortcode' );


//Feature: Infinite scroll on Single Post page

function get_related_post( $request ){
    $last_ids = explode( ",", $request["postIds"] );

    $next_post = get_posts( array( "numberposts"  => 1, "exclude" => $last_ids ) )[0];
    
    $args = array(
        "id" => $next_post->ID
    );
    
    return get_template_part( 'parts/post/post', 'next', $args ); 
}

function register_get_related_post_route(){
    $args = array(
        "methods" => "GET",
        "callback" => "get_related_post"
    );
    register_rest_route( "v1", "/get-related-post", $args );
}
add_action( "rest_api_init", "register_get_related_post_route" );

//Feature: Contact form shortcode
function contact_form_shortcode( $atts ){
    $a = shortcode_atts( array(
        "email" => null
    ), $atts );
    if( $a['email'] == null ) return;

    $receiver_email = $a['email'];
    $action = get_home_url() . "/wp-json/v1/send-email";
    $output = <<<EOL
        <form class="contact-form" method="POST" action="{$action}">
            <input type="hidden" name="receiver-email" value="{$receiver_email}">
            <span class="input-wrapper">
                <label for="input-full-name">Full Name</label>
                <input id="input-full-name" type="text" name="full-name" placeholder="John Smith"> 
            </span>
            <span class="input-wrapper">
                <label for="input-email">Email<span class="asterisk">*</span></label>
                <input id="input-email" type="email" name="sender-email" placeholder="john.smith@email.com" required>
            </span>
            <span class="input-wrapper">
                <label for="input-subject">Subject</label>
                <input id="input-subject" type="text" name="subject" placeholder="Inquiry" required>
            </span>
            <span class="input-wrapper">   
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="12" placeholder="Your message..." required></textarea>
            </span>
            <input type="submit" value="Send">
        </form>
    EOL;
    return $output;
}
add_shortcode( "contact_form", "contact_form_shortcode" );

function send_email( $request ){
    $to = $request['receiver-email'];
    $subject = $request['subject'];
    $message = $request['message'];
    $from = $request['email'];

    $headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: ' . $from . "\r\n";

	$result = mail($to,$subject,$message,$headers);

	if ($result) return 1;
	else return 0;
}

function register_send_email_route(){
    $args = array(
        "methods" => "POST",
        "callback" => "send_email"
    );
    register_rest_route( "v1", "/send-email", $args );
}
add_action( "rest_api_init", "register_send_email_route" );

//Feature: Subscription form shortcode
function user_data_and_subscriptions_form_shortcode( $atts ){
    /*$a = shortcode_atts( array(
        "user_id" => null
    ), $atts );
    $action = $a["user_id"] == null ? "http://localhost/dev.biznob.com/wp-json/v1/create-subscriber" : "http://localhost/dev.biznob.com/wp-json/v1/update-subscriber";
    $output = "<form class='subscription-form' method='POST' action='{$action}'>";
    if( $a["user_id"] == null ) $output .= "<input type='email' name='subscriber-email' placeholder='Email address'>";
    $output .= "<div class='category-checkbox-group'>";    

    $categories = get_categories();

    foreach( $categories as $category ){
        if( $category->parent === 0 ){
            $output .= "<div class='category-checkbox-wrapper'><input type='checkbox' name='category' id='category-{$category->term_id}' value='{$category->term_id}'><label for='category-{$category->term_id}'>{$category->name}</label></div>";
        }
    }
    $submit_value = $a["user_id"] == null ? "Subscribe" : "Update";

    $output .= "</div><input type='submit' value='{$submit_value}'></form>";
    */
    $a = shortcode_atts( array(
        "class" => ""
    ), $atts );

    $class = $a['class'];
    $submit_text = $class == 'my-account-user-data-form' ?  "Update" : "Subscribe";

    $output = <<<"EOL"
        <!-- Begin Mailchimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
            /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
            We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
        </style>
        <div id="mc_embed_signup">
        <form action="https://Biznob.us5.list-manage.com/subscribe/post?u=cd8f442fb088947a5ce19c7e3&amp;id=41c494529c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate {$class}" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
        <div class="mc-field-group email-wrapper">
            <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
        </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="john.smith@email.com">
        </div>
        <div class="mc-field-group">
            <label for="mce-FNAME">First Name </label>
            <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="John">
        </div>
        <div class="mc-field-group">
            <label for="mce-LNAME">Last Name </label>
            <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Smith">
        </div>
        <div class="mc-field-group password-wrapper">
            <label for="mce-PASSWORD">Password </label>
            <input type="password" value="" name="PASSWORD" class="" id="mce-PASSWORD">
        </div>
        <div class="mc-field-group password-wrapper">
            <label for="mce-REPEAT_PASSWORD">Repeat Password </label>
            <input type="password" value="" name="REPEAT_PASSWORD" class="" id="mce-PASSWORD">
        </div>
        <div class="mc-field-group input-group content-categories">
        <label><b>Subscription Categories</b></label>
            <ul>
        <li><label class="switch" for="mce-group[31361]-31361-0"><input type="checkbox" value="1" name="group[31361][1]" id="mce-group[31361]-31361-0" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-0">News US</label></li>
        <li><label class="switch" for="mce-group[31361]-31361-1"><input type="checkbox" value="2" name="group[31361][2]" id="mce-group[31361]-31361-1" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-1">Business</label></li>
        <li><label class="switch" for="mce-group[31361]-31361-2"><input type="checkbox" value="4" name="group[31361][4]" id="mce-group[31361]-31361-2" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-2">Politics</label></li>
        <li><label class="switch" for="mce-group[31361]-31361-3"><input type="checkbox" value="8" name="group[31361][8]" id="mce-group[31361]-31361-3" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-3">Markets</label></li>
        <li><label class="switch" for="mce-group[31361]-31361-4"><input type="checkbox" value="16" name="group[31361][16]" id="mce-group[31361]-31361-4" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-4">Lifestyle</label></li>
        <li><label class="switch" for="mce-group[31361]-31361-5"><input type="checkbox" value="32" name="group[31361][32]" id="mce-group[31361]-31361-5" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-5">Tech</label></li>
        <li><label class="switch" for="mce-group[31361]-31361-6"><input type="checkbox" value="64" name="group[31361][64]" id="mce-group[31361]-31361-6" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-6">Finance</label></li>
        <li><label class="switch" for="mce-group[31361]-31361-7"><input type="checkbox" value="128" name="group[31361][128]" id="mce-group[31361]-31361-7" checked><span class="slider round"></span></label><label class='category-name' for="mce-group[31361]-31361-7">Education</label></li>
        </ul>
        </div>
            <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_cd8f442fb088947a5ce19c7e3_41c494529c" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="{$submit_text}" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
        </div>
        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var \$mcj = jQuery.noConflict(true);</script>
        <!--End mc_embed_signup-->
    EOL;
    
    return $output;
    
}
add_shortcode( "user_data_and_subscriptions_form", "user_data_and_subscriptions_form_shortcode" );

function create_subscriber( $request ){
    error_log( "Creating subscriber" );
    //TODO: Implement function
}

function register_create_subscriber_route(){
    $args = array(
        "methods" => "POST",
        "callback" => "create_subscriber"
    );
    register_rest_route( "v1", "/create-subscriber", $args );
}
add_action( "rest_api_init", "register_create_subscriber_route" );

//Feature: Affiliate products
function add_affiliate_product_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'Affiliate Products',
            'singular_name' => "Affiliate Product"
        ),
        'menu_icon' => 'dashicons-products',
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'excerpt', 'thumbnail' ),
        'taxonomies' => array( 'post_tag' )
    );

    register_post_type( 'affiliate-product', $args );
}
add_action( 'init', 'add_affiliate_product_post_type' );

function affiliate_product_shortcode( $atts ){
    $a = shortcode_atts( array(
        "product_id" => null,
        "class" => ""
    ), $atts );
    if( $a['product_id'] == null ) return;

    $product = get_post( $a['product_id'] );
    $affiliate_link = get_field( 'affiliate_link', $product->ID );
    $thumbnail = get_the_post_thumbnail( $product->ID );
    $regular_price = get_field( 'regular_price', $product->ID );
    $discounted_price = get_field( 'discounted_price', $product->ID );
    $tags = get_the_tags( $product->ID );
    $class = $a['class'];

    $output = <<<"EOL"
        <article class='post-card affiliate-product-card {$class}'>
            <a class='post-link image-box' href="{$affiliate_link}">
                {$thumbnail}
            </a>
            <a class='post-link title-box' href="{$affiliate_link}">
                <h3 class='post-title'>{$product->post_title}</h3>
            </a>
            <div class='price-wrapper'>
                <del class='regular-price'>{$regular_price}$</del>
                <em class='discounted-price'>{$discounted_price}$</em>
            </div>
            <p class='post-excerpt'>{$product->post_excerpt}</p>
        </article>
    EOL;

    return $output;
    ?>
    <article class='affiliate-product-card'>
        <a href="<?php echo $affiliate_link ?>">
            <?php echo $thumbnail ?>
            <h3><?php echo $product->post_title ?></h3>
        </a>
        <div class='price-wrapper'>
            <del class='regular-price'><?php echo $regular_price ?>$</del>
            <em class='discounted-price'><?php echo $discounted_price ?>$</em>
        </div>
        <p><?php echo $product->post_excerpt ?></p>
    </article>
    
    <?php
}
add_shortcode( 'affiliate_product', 'affiliate_product_shortcode');

//Feature: Cookie management form shortcode
function cookie_management_form_shortcode( $atts ){
    $a = shortcode_atts( array(
        "product_id" => null
    ), $atts );

    $home_url = get_home_url();
    
    $output = <<<"EOL"
        <form class="cookie-management-form" method="POST" action="{$home_url}/wp-json/v1/set-cookie-preferences">
            <div class="checkbox-wrapper"><input type="checkbox" name="accept-all-cookies" id="accept-all-cookies"><label for="accept-all-cookies">Accept All</label></div>
            <hr>
            <div class="checkbox-wrapper">
                <input type="checkbox" name="accept-cookie-type" id="necessary-cookies">
                <p class="cookie-description"><label for="necessary-cookies">Necessary Cookies</label> are necessary for our services to function properly and securely. They cannot be switched off in our systems. You can set your browser to block or alert you about these cookies, but some parts of the Services will not work.</p>
            </div>
            <div class="checkbox-wrapper">
                <input type="checkbox" name="accept-cookie-type" id="functional-cookies">
                <p class="cookie-description"><label for="functional-cookies">Functional Cookies</label> enable us to provide enhanced functionality and personalization by remembering your preferences or settings when you return to our Services. Without these cookies, certain features may not function properly.</p>
            </div>
            <div class="checkbox-wrapper">
                <input type="checkbox" name="accept-cookie-type" id="performance-cookies">
                <p class="cookie-description"><label for="performance-cookies">Performance Cookies</label> allow us to count visits and traffic sources so we can measure and improve the performance of our Services. They help us to know which parts of the Services are the most and least popular and see how visitors use our Services. We use third-party cookies, such as Google Analytics, to help with performance and analytics.</p>
            </div>
            <div class="checkbox-wrapper">
                <input type="checkbox" name="accept-cookie-type" id="advertising-cookies">
                <p class="cookie-description"><label for="advertising-cookies">Advertising Cookies</label> help deliver advertisements, make them more relevant and meaningful to users, and track the efficiency of advertising campaigns. We and our third-party advertising partners may use these cookies to build a profile of your interests and deliver relevant advertising on our Services, or on other sites or services. If you disable these Cookies, you may still see contextual advertising or ads based on information we have about you.</p>
            </div>
            <div class="checkbox-wrapper">
                <input type="checkbox" name="accept-cookie-type" id="social-media-cookies">
                <p class="cookie-description"><label for="social-media-cookies">Social Media Cookies</label> are set by social media platforms on the Services to enable you to share content with your friends and networks. Social media platforms have the ability to track your online activity outside of the Services. This may impact the content and messages you see on other services you visit.</p>
            </div>
            <input type="submit" value="Save" />            
        </form>
    EOL;

    return $output;
}
add_shortcode( "cookie_management_form", "cookie_management_form_shortcode" );

function set_cookie_preferences(){
    error_log( "Updating cookie preferences" );
    //TODO: Implement function
}

function register_set_cookie_preferences_route(){
    $args = array(
        "methods" => "POST",
        "callback" => "set_cookie_preferences"
    );
    register_rest_route( "v1", "/set-cookie-preferences", $args );
}
add_action( "rest_api_init", "register_set_cookie_preferences_route" );

// Feature: My Account page (and related features)
function check_login(){
    if( !is_user_logged_in() && is_page("my-account") ){
        wp_redirect( get_permalink( get_page_by_path( 'login' ) ) );
        exit;
    }
    
    if( is_user_logged_in() && ( is_page('registration') || is_page( 'login' ) ) ){
        wp_redirect( get_permalink( get_page_by_path( 'my-account' ) ) );
        exit;
    }
}
add_action("wp", "check_login");

function login_form_shortcode(){
    return wp_login_form( array( 'echo' => false, 'redirect' => get_permalink( get_page_by_path( 'my-account' ) ) ) );
}
add_shortcode("login_form", "login_form_shortcode");

function user_info_form_shortcode( $atts ){
    $a = shortcode_atts( array(
        "is_registration" => false,
        "message" => null
    ), $atts );
    
    $user_id = $a["is_registration"] ? 0 : get_current_user_id(); 

    $home_url = get_home_url();

    $first_name_value = $a["is_registration"] ? "" : get_user_meta( $user_id, 'first_name', true );
    $last_name_value = $a["is_registration"] ? "" : get_user_meta( $user_id, 'last_name', true );

    $return_str = <<<"EOL"
        <form class="user-info-form" method="POST" action="{$home_url}/wp-json/v1/update-user-data">
            <input type="hidden" name="user_id" value="{$user_id}"/>
            <div class="input-wrapper">
                <label>First name</label>
                <input type="text" name="first_name" placeholder="John" value="{$first_name_value}"/>
            </div>
            <div class="input-wrapper">
                <label>Last name</label>
                <input type="text" name="last_name" placeholder="Smith" value="{$last_name_value}"/>
            </div>
    EOL;

    if( $a["is_registration"]){
        $return_str .= <<<"EOL"
            <div class="input-wrapper">
                <label>Email<span class="asterisk">*</span></label>
                <input type="email" name="email" placeholder="john.smith@email.com" required/>
            </div>            
        EOL;
    }
    $message = isset( $_GET['message'] ) ? $_GET['message'] : "";
    $messageClass = isset( $_GET['success'] ) && $_GET['success'] == true ? "success" : "error";
    $submit_value = $a["is_registration"] ? "Register" : "Update";

    $return_str .= <<<"EOL"
                <div class="input-wrapper">
                    <label>Passsword</label>
                    <input type="password" name="password" placeholder="*************"/>
                </div>
                <div class="input-wrapper">
                    <label>Repeat password</label>
                    <input type="password" name="repeat-password" placeholder="*************"/>
                </div>
                <input type="submit" value="{$submit_value}"/>
                <p class='message {$messageClass}'>{$message}</p>
            </form>
        EOL;

    return $return_str;
}
add_shortcode('user_info_form', 'user_info_form_shortcode');

function update_user_data( $request ){
    $user_id = $request['user_id'];
    $first_name = $request['first_name'];
    $last_name = $request['last_name'];
    if( $user_id == 0 ) $email = $request['email'];
    $password = $request['password'];
    $repeat_password = $request['repeat-password'];

    $response = new stdClass();

    if( $password != $repeat_password ){
        $response->code = 400;
        $response->message = "Password and repeated password are not equal.";

        wp_redirect( get_permalink( get_page_by_path( 'registration' ) ) . "?message=Password and repeated password are not equal.", 300 );
        exit;
        //return $response;
    }
 
    if( $user_id == 0 ){
        if( username_exists( $email ) ){
            $response->code = 400;
            $response->message = "Username " . $email . " already exists";
            
            wp_redirect( get_permalink( get_page_by_path( 'registration' ) ) . "?message=Username " . $email . " allready exists", 300 );
            exit;
            //return $response;
        }

        if( $password == "" || $password == null ){
            $response->code = 400;
            $response->message = "Password is missing.";

            wp_redirect( get_permalink( get_page_by_path( 'registration' ) ) . "?message=Password is missing.", 300 );
            exit;
            //return $response;
        }

        $create_user = wp_create_user( $email, $password, $email );
        $update_user = wp_update_user( array( 'ID' => $create_user, 'first_name' => $first_name, 'last_name' => $last_name ) );

        if( $create_user == $update_user ){
            $response->code = 200;
            $response->message = "User " . $email . " created"; 

            wp_clear_auth_cookie();
            wp_set_current_user ( $create_user );
            wp_set_auth_cookie  ( $create_user );

            wp_redirect( get_permalink( get_page_by_path( 'my-account' ) ), 300 );
            exit;

            //return $response;
        }
    }else{
        $update_user = wp_update_user( array( 'ID' => $user_id, 'first_name' => $first_name, 'last_name' => $last_name ) );
        if( $password != null && $password != "" ) $set_password = wp_set_password( $password, $user_id );

        if( $user_id == $update_user ){
            $response->code = 200;
            $response->message = "User updated"; 

            wp_redirect( get_permalink( get_page_by_path( 'my-account' ) ) . "?message=User updated.&success=1", 300 );
            exit;
            //return $response;
        }
    }

    $response->code = 500;
    $response->message = "Internal server error during user create/update.";

    wp_redirect( get_permalink( get_page_by_path( 'registration' ) ) . "?message=Internal server error during user create/update.", 300 );
    exit;
    // return $response;
}

function register_update_user_data_route( $request ){
    $args = array( 
        "methods" => "POST",
        "callback" => "update_user_data"
    );
    register_rest_route( "v1", "/update-user-data", $args );
}
add_action( "rest_api_init", "register_update_user_data_route" );

function update_readlist( $request ){
    $user_id = $request['user_id'];
    $post_id = $request['post_id'];
    $post_in_readlist = $request['in_readlist'];

    $response = new stdCLass();
    $readlist = get_field( "read_list", "user_" . $user_id );
    if( !$readlist ) $readlist = array();

    if( $post_in_readlist ){
        $index = array_search( $post_id, $readlist );
        unset($readlist[$index]);
        $response->action = "remove";
    }else{
        array_push( $readlist, $post_id );
        $response->action = "add";
    }
    $result = update_field( "read_list", $readlist, "user_" . $user_id );
    if($result == true) $response->status = "200";
    else $response->status = "500";

    return $response;
}

function register_update_readlist_route( $atts ){
    $args = array(
        "methods" => "POST, GET",
        "callback" => "update_readlist"
    );
    register_rest_route( "v1", "/update-readlist", $args );
}
add_action( "rest_api_init", "register_update_readlist_route" );

//Feature: Page section shortcode
function page_section_shortcode( $atts, $content ){
    $a = shortcode_atts( array(
        "class" => "",
        "shortode_in_content" => false
    ), $atts );

    $class = $a['class'];
    $content = $a['shortode_in_content'] ? do_shortcode( $content ) : $content;
    

    return "<section class='page-section {$class}'>{$content}</section>";
}

add_shortcode( "page_section", "page_section_shortcode" );

//Feature: Change profile nav menu label for logged-in users
function dynamic_label_change( $items, $args ) { 
    if ( is_user_logged_in() && ( $args->theme_location == 'main-menu' || $args->theme_location == 'mobile-menu' ) ){ 
        $items = str_replace("Sign In", "Profile", $items); 
    }
     
    return $items; 
} 
add_filter( 'wp_nav_menu_items', 'dynamic_label_change', 10, 2 ); 
?>