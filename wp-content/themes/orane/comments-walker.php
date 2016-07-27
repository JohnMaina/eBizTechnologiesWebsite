<?php  

/** COMMENTS WALKER CLASS*/

class Orane_Comments_Walker extends Walker_Comment {

    

    // init classwide variables

    var $tree_type = 'comment';

    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );



    /** CONSTRUCTOR

     * You'll have to use this if you plan to get to the top of the comments list, as

     * start_lvl() only goes as high as 1 deep nested comments */

    function __construct() { ?>



        

        

    <?php }

    

    /** START_LVL 

     * Starts the list before the CHILD elements are added. Unlike most of the walkers,

     * the start_lvl function means the start of a nested comment. It applies to the first

     * new level under the comments that are not replies. Also, it appear that, by default,

     * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */

    function start_lvl( &$output, $depth = 0, $args = array() ) {       

        $GLOBALS['comment_depth'] = $depth + 1; ?>



                

    <?php }



    /** END_LVL 

     * Ends the children list of after the elements are added. */

    function end_lvl( &$output, $depth = 0, $args = array() ) {

        $GLOBALS['comment_depth'] = $depth + 1; ?>



       

        

    <?php }

    

    /** START_EL */

    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {

        $depth++;

        $GLOBALS['comment_depth'] = $depth;

        $GLOBALS['comment'] = $comment; 

        $is_reply = $comment->comment_parent;



        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>



        <?php if($is_reply != 0){ ?>

            <div class="col-md-10 col-md-offset-2">

            <div class="comment-reply">

        <?php } ?>

        

        <div class="comment">

            <div id="comment-body-<?php comment_ID() ?>" class="comment-body">

                

                <?php if($is_reply != 0){ ?>

                    <div class="col-md-2">

                <?php }else{ ?>

                    <div class="col-md-2">

                <?php } ?>



                    <?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>



                </div><!-- /.comment-author -->

                

                <?php if($is_reply != 0){ ?>

                    <div class="col-md-10 comment-box">

                <?php }else{ ?>

                    <div class="col-md-10 comment-box">

                <?php } ?>    



                    <h4>
                    <?php  
                        //check if url
                        if(filter_var(get_comment_author_link(), FILTER_VALIDATE_URL)){ 
                           $author_link =  esc_url(get_comment_author_link());
                        }else{
                            //not a url, just your name
                            $author_link = get_comment_author_link();
                        }

                    ?>


                    <?php echo  $author_link; ?>

                    

                    <div class="rp-btn"><i class="fa fa-reply fa"></i>    

                    <?php $reply_args = array(

                        'add_below' => '', 

                        'depth' => $depth,

                        'max_depth' => $args['max_depth'] );

    

                    comment_reply_link( array_merge( $args, $reply_args ) );  ?>

                    </div>



                    </h4>

                    <p>

                        <?php if( !$comment->comment_approved ) : ?>

                        <em class="comment-awaiting-moderation"><?php _e("Your comment is awaiting moderation.", "orane"); ?></em>

                        

                        <?php else: comment_text(); ?>

                        <?php endif; ?>

                    </p>

                    

                    <div class="comment-arrow"></div>



                    <span class="post-date"> <a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>"><?php comment_date(); ?> at <?php comment_time(); ?></a> <?php edit_comment_link( '(Edit)' ); ?> </span>

                    

                </div><!-- /.comment-meta -->



                </div>











            </div><!-- /.comment-body -->



        <?php if($is_reply != 0){ ?>

            </div>

            </div>

        <?php } ?>





    <?php }



    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

        

        

        

    <?php }

    



    function __destruct() { ?>

    

    



    <?php }

}



?>