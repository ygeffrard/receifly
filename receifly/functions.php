<?php
add_action( 'after_setup_theme', 'receifly_setup' );
function receifly_setup()
{
load_theme_textdomain( 'receifly', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'receifly' ) )
);
}
add_action( 'wp_enqueue_scripts', 'receifly_load_scripts' );
function receifly_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'receifly_enqueue_comment_reply_script' );
function receifly_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'receifly_title' );
function receifly_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'receifly_filter_wp_title' );
function receifly_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'receifly_widgets_init' );
function receifly_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'receifly' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function receifly_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'receifly_comments_number' );
function receifly_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

/****
 * Form Submission 
 ***/
/*if (isset($_POST['submitReceipt'])){
    print_r($_POST);
    die;
}*/


function my_run_only_once() {
    if ( get_option( 'my_run_only_once_01' ) != 'completed' ) {
        update_option( 'my_run_only_once_01', 'completed' );
    }
}
add_action( 'admin_init', 'my_run_only_once' );

function receipt_filename($dir, $name, $ext){
    $purchaseDate = date("m-d-y",strtotime($_POST['purchaseDate']));
    $merchantName = replaceSpaceWithDash(ucwords($_POST['merchantName']));
    return $purchaseDate.'_'.$merchantName.$ext;
}

function receipt_directory($upload) {
    $purchaseYear = date("Y",strtotime($_POST['purchaseDate']));
    $category = $_POST['categoryName'];
    $receipt_directory_name = "Receipts";

    $upload['subdir'] = '/'.$receipt_directory_name.'/'.$purchaseYear.'/'.$category;
    $upload['path']   = $upload['basedir'] . $upload['subdir'];
    $upload['url']    = $upload['baseurl'] . $upload['subdir'];
  
    return $upload;
}

function replaceSpaceWithDash($text) { 
    $text = htmlentities($text); 
    $text = str_replace(get_html_translation_table(), "-", $text);
    $text = str_replace(" ", "-", $text);
    $text = preg_replace("/[-]+/i", "-", $text);
    return $text;
}

global $wpdb;
$table_name = $wpdb->prefix.'receipts';
//Create table if it doesn't exist
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    //table not in database. Create new table
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        receipt_id INTEGER NOT NULL AUTO_INCREMENT,
        receiptImage TEXT NOT NULL,
        merchantName TEXT NOT NULL,
        purchaseDate DATE NOT NULL,
        categoryName TEXT NOT NULL,
        purchaseAmount DECIMAL(19,2) NOT NULL,
        reason TEXT NOT NULL,
        PRIMARY KEY (receipt_id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
//Add entry if table exist
else{
    $receiptURL;
    if (isset($_FILES['receiptImage']['name']) )  {
        //print_r($_FILES);
        
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        $uploadedfile = $_FILES['receiptImage'];
        $upload_overrides = array( 'test_form' => false , 'unique_filename_callback' => 'receipt_filename');
        add_filter('upload_dir', 'receipt_directory');
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        remove_filter('upload_dir', 'receipt_directory');
        
        $receiptURL = $movefile['url'];

        if ( $movefile && ! isset( $movefile['error'] ) ) {
            echo '<h1 style="color:green">File Was Uploaded Successfully</h1><br>'.$receiptURL.'</br>';
            echo '<a href="'.$receiptURL .'">View File</a>';
            //var_dump( $movefile );
        }else{
            echo $movefile['error'];
        }     
    }

     if (isset($_POST['submitReceipt'])){
        $data_array = array (
            'receiptImage' => $receiptURL,
            'merchantName' => ucwords($_POST['merchantName']),
            'purchaseDate' => $_POST['purchaseDate'],
            'categoryName' => ucwords($_POST['categoryName']),
            'purchaseAmount' => $_POST['purchaseAmount'],
            'reason' => $_POST['reason']
        );

        $rowResult = $wpdb->insert($table_name, $data_array, $format=NULL);

        if($rowResult == 1){
            echo '<h1>Form Submitted Successfully!</h1>'; 
        }else{
            echo '<h1>Form Filed Submission!</h1>'; 
        }
        die;
    } 

}


/*function receipt_create_db() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   
    $table_name = $wpdb->prefix . 'receipts';
    $sql = "CREATE TABLE $table_name (
    receipt_id INTEGER NOT NULL AUTO_INCREMENT,
    merchant_name TEXT NOT NULL,
    purchase_date DATE NOT NULL,
    category_name TEXT NOT NULL,
    reason TEXT NOT NULL,
    PRIMARY KEY (receipt_id)
    ) $charset_collate;";
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'receipt_create_db' );*/