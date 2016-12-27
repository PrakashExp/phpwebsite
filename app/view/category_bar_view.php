<div class="col-sm-3">
  <div class="left-sidebar">
    <h2>Các loại hoa</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
        <?php foreach ($CategoryList as $item): ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><a href="shop.php?category=<?php echo strtolower(stripUnicode($item['CategoryName']));?>"><?php echo $item['CategoryName'];?></a> </h4>
            		</div>
            	</div>
        <?php endforeach;?>
		</div><!--/category-productsr-->	 
		
		<div class="shipping text-center"><!--shipping-->
			<img src="images/home/shipping.jpg" alt="" />
		</div><!--/shipping-->
	</div>
</div>
