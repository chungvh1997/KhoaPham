<?php

if($this->uri->segment(1) == "home" || $this->uri->segment(1) =='' ){
		$class ="pt-5";
		$mauto="ml-auto";
}else{
		$class ="pt-2";
		$mauto="m-auto";
}

?>

<nav class="navbar navbar-expand-lg position-relative <?= $class ?> ">
				<a class="navbar-brand position-absolute header-logo" title="LOGO VINCITY" href="<?= base_url() ?>">
					<img alt="LOGO VINCITY"  src="images/logo.png">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
			  
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				  <ul class="navbar-nav <?= $mauto ?> navbar-while">
                  <?php 
				
					foreach ($this->menu as $key => $value) { 
						if( $this->uri->segment(1) == $value['Link']){
							$active = "active";
						}else{
							$active = "";
						}
				?>
				<li class="nav-item ml-3 mr-3 <?= $active ?>">
					<a class="nav-link text-x pl-0 pr-0" href="<?=base_url().$value['Link']?>" title="<?=$value['Name'] ?>"><?=$value['Name'] ?></a> 
				</li>
				<?php }  ?>	
					
				  </ul>
				
				</div>
		</nav>