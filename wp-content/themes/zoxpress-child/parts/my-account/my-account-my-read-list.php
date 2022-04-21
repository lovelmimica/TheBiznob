<div class="my-read-list-posts">
<?php 
    $readlist = get_field( 'read_list', 'user_' . get_current_user_id() );
    if( is_array( $readlist )) {
        $i = 0;
        foreach( $readlist as $id ){
            echo do_shortcode("[post_card post_id='{$id}' /]" );
            if( $i % 2 == 0 ) echo "<span class='middle-border'></span>";
            $i++;
        }
    }else{
        echo "<p>Readlist is empty</p>";
    }
?>
</div>

