<div class="row text-content-news ">
 <?php foreach ($listnews as $key => $value) { ?>
 
  <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    <div class="card">
      <img class="card-img-top" src="<?=base_url().$this->urllinkImg.$value['Thumb'] ?>" alt="Card image">
      <div class="card-body">
       <i class="far fa-clock"></i>
       <small><?= date("d",$value['Date_create']) ?> tháng <?= date("m",$value['Date_create']) ?> , <?= date("Y",$value['Date_create']) ?> </small>
       <h5 class="card-title"><a title="<?=$value['Name'] ?>" href="<?=base_url().$value['Link'] ?>"><?=$value['Name'] ?></a></h5>
       <p class="card-text">
        <a href=""><i class="fab fa-facebook-f"></i></a>
        <a href=""><i class="fab fa-google-plus-g"></i></a>
        <a href=""><i class="fas fa-link"></i></a>
      </p>
    </div>
  </div>
    </div>
    <?php } ?>
</div>
<div class="row justify-content-center btn-more mb-4">
  <a title="<?=$cataloglink[0] ?>" class="a-btn-viewmore mt-5 " href="<?=base_url().$cataloglink[1] ?>">XEM THÊM</a>
</div>