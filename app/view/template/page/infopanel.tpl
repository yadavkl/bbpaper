<div class="panel panel-primary">
<div class="panel-body" style="background:url('view/images/1.jpg'); color: white">
<section id="carousel">    				
	<div class="container">	
        
        <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="10000">
				<!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <?php $i=0; foreach($customer as $speak){ ?>
				<li data-target="#fade-quote-carousel" data-slide-to="<?php echo $i++; ?>" ></li>
                <?php } ?>
            </ol>
            
            <!-- Carousel items -->
            <div class="carousel-inner">
                
				<?php $i=0; foreach($customer as $speak){ ?>   
                <div class="item <?php if( $i == 0){ $i++;?> active<?php } ?>">                     
				    <img src="view/images/<?php echo $speak['image']; ?>" class="profile-circle">
				    <i><?php echo $speak['comment']; ?></i>
                </div>  
				<?php } ?>
				                    
            </div>	
            
			</div>	
        
		</div>

    </section>
    </div>
</div>