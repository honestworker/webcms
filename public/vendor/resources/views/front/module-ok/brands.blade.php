<section id="clients">
	<div class="clients">
    	<?php 
		use App\Http\Models\Front\Brands;
		$this->BrandsModel = new Brands();
		$brands = $this->BrandsModel->getBrands();
		$this->data['brands'] = $brands;
		foreach($brands as $brand){?>
				<div class="items"><img src="{{ asset('/public/admin/brands/'.$brand['image']) }}" alt="<?php echo $brand['title'];?>"></div>
		<?php }	?>
    </div>
</section>
