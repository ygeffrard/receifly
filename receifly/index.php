<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
      
    <form class="form-signin">

        <div class="form-group">
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
            <label for="exampleFormControlFile1">Upload Receipt</label>
        </div>
            
        <div class="form-label-group">
            <input type="text" id="merchantName" class="form-control" placeholder="Enter Merchant Name" required="">
            <label for="merchantName">Enter Merchant Name</label>
        </div>
        
        <div class="form-label-group">
            <input type="date" id="purchaseDate" class="form-control" placeholder="Enter Date" required="" autofocus="">
            <label for="purchaseDate">Enter Date</label>
        </div>

        <div class="form-label-group">
            <select class="form-control" id="category" name="category" required="">
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
            <label for="category">Select Category</label>
        </div>

        <div class="form-label-group">
            <input type="text" id="reason" class="form-control" placeholder="Enter Reason" required="" autofocus="">
            <label for="reason">Enter Reason</label>
        </div>
        
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Submit</button>
    
    </form>

<?php comments_template(); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>