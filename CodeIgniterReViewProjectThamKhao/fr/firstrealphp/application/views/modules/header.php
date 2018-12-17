<header>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-right top-header-info">
                      <a href="<?= base_url() ?>"><i class="fas fa-search"></i></a>
                      <div id="line-top"></div>
                      <a href="<?= base_url() ?>"><i class="fas fa-phone mr-2"></i></a>
                      <a href="<?= base_url() ?>">0931.777.122</a>
                    </div>
                  </div>
            
                  <div class="row text-center">
                   <!--  <div class="col-md-3 col-sm-4 logo-header">
                      <img alt="LOGO VINCITY" src="images/logo.png">
                    </div> -->
                    <div class="col-8 col-sm-8 col-md-12 col-lg-12 col-xl-12 ">
                      <div class="div-top-navbar">
                          <?php $this->load->view('modules/menu'); ?>
                      </div>       
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 info-header-top">
                      <nav  aria-label="breadcrumb" id="breadcrumb">  
                        <ol class="breadcrumb breadcrumb-dot justify-content-center">
            <?php if( $this->uri->segment(1) !='search' ){
                $link =$metas->Link;
              }else{
                 $link ="";
                } ?>
                          <li class="breadcrumb-item "><a href="<?=base_url() ?>" >Trang chủ</a></li>
                          <li class="breadcrumb-item"><a href="<?=base_url().$link ?>" ><?=$metas->Name ?>- VinCity</a></li>
                       
                        </ol>
                      </nav>
                      <h1 class="display-4"><?=$metas->Name ?> </h1>
                      <h2> <?php if (array_key_exists("Slogan",$metas)){
                              echo $metas->Slogan;
                            }else{
                              echo "VINCITY";
                            } ?> </h2>
                      
                      <div class="line-header-top m-auto">
                      </div>
                    </div> 
                  </div>
                </div>
 </header>