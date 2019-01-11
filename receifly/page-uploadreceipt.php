<?php /* Template Name: Upload Receipt */ ?>
<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h1 class="text-center entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
</header>
<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>
    <?php if($_POST['submit']){

        } else {

        }
    ?>
    <form class="form-upload-receipt" name="formUploadReceipt" enctype="multipart/form-data" method="POST">

        <div class="form-group">
            <input type="file" class="form-control-file" id="receiptImage" name="receiptImage" required>
            <label for="receiptImage">Upload Receipt</label>
        </div>
            
        <div class="form-label-group">
            <input type="text" id="merchantName" name="merchantName" class="form-control" placeholder="Enter Merchant Name" required>
            <label for="merchantName">Enter Merchant Name</label>
        </div>
        
        <div class="form-label-group">
            <input type="date" id="purchaseDate" name="purchaseDate" class="form-control" placeholder="Enter Date" autofocus="" value="<?php echo date("Y-m-d");?>" required>
            <label for="purchaseDate">Enter Date</label>
        </div>

        <div class="form-label-group">
            <select class="form-control" id="categoryName" name="categoryName">
                <option value="Advertising">Advertising</option>
                <option value="Contract Labor">Contract Labor</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Equipment">Equipment</option>
                <option value="Income">Equipment</option>
                <option value="Legal Services">Legal Services</option>
                <option value="Licenses and Regulatory">Licenses and Regulatory</option>
                <option value="Meals">Meals</option>
                <option value="Miscellaneous">Miscellaneous</option>
                <option value="Rent">Rent</option>
                <option value="Repair and Maintenance">Repair and Maintenance</option>
                <option value="Services">Services</option>
                <option value="Supplies">Supplies</option>
                <option value="Transportation">Transportation</option>
                <option value="Utilities">Utilities</option>
                <option value="Void">Void</option>
            </select>
            <label for="categoryName">Select Category</label>
        </div>

        <div class="form-label-group">
            <input type="number" step="0.01" min=0 id="purchaseAmount" name="purchaseAmount" class="form-control two-decimal" placeholder="Enter Amount" pattern="^\d*(\.\d{0,2})?$" autofocus="" value="0.00" required>
            <label for="purchaseAmount">Enter Amount</label>
        </div>

        <div class="form-label-group">
            <input type="text" id="reason" name="reason" class="form-control" placeholder="Enter Reason" autofocus="">
            <label for="reason">Enter Reason</label>
        </div>
        
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" id="submitReceipt" name="submitReceipt">Submit</button>
    
    </form>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>
</article>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>