<!DOCTYPE html>
<html lang="en">
<head>
<?php

 if($this->uri->segment(1) == "home" || $this->uri->segment(1) =='' || $this->uri->segment(1) =='search' ){
	 $images = base_url().$this->urllinkImg.$this->metaAll->Logo;
     $url = base_url();
        $keywords =$this->metaAll->Description ;
        $description = $this->metaAll->Keywords ;
        $name = $this->metaAll->Name;
 }else{
	$images = base_url().$this->urllinkImg.$metas->Thumb;
    $url = base_url().$metas->Link;
    $name = $metas->Name;
    $keywords =$metas->Description ;
    $description = $metas->Keywords ;
 }
?>
<base href="<?php echo base_url(); ?>public/"></base>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title><?=$this->metaAll->Title ?></title>
<link rel='shortcut icon' href='<?=base_url().$this->urllinkImg.$this->metaAll->Favicon ?>'>
<meta name='title' content='<?=$name ?>' />
<meta name='description' content='<?=$description  ?>'/>

<meta name='keywords' content='<?=$keywords  ?>'
/>
<meta name='tags' content='<?= $keywords ?>'
/>
<meta name='author' content='TT Co., Ltd' />
<meta name='medium' content='image' />
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1,user-scalable=no' />
<meta name='robots' content='index,follow' />
<meta http-equiv='pragma' content='no-cache'>
<meta content='DOCUMENT' name='RESOURCE-TYPE' />
<meta http-equiv='content-language' content='vi' />
<meta name='copyright' content='2018' />
<meta property='og:type' content='website' />
<meta property='og:url' content='<?=$url ?>' />
<meta property='og:title' content='<?=$name ?>' />
<meta property='og:description' content='<?=$description ?>'/>

<meta property='og:image' content='<?= $images ?>' />
<meta property='og:full_image' content='<?= $images ?>' />
<meta property='twitter:card' content='<?=$name ?>' />
<meta property='twitter:url' content='<?=$url ?>' />
<meta property='twitter:title' content='<?=$name ?>' />
<meta property='twitter:description' content='<?=$description ?>'/>
<meta property='twitter:image' content='<?= $images ?>' />
<meta content='Ho Chi Minh' name='geo.placename' />
<meta content='VN-SG' name='geo.region' />
<meta name='apple-mobile-web-app-capable' content='yes' />
<meta name='apple-mobile-web-app-title' content='<?=$name ?>' />
<meta name='apple-mobile-web-app-status-bar-style' content='black' />
<meta name='apple-touch-icon' content='<?= $images ?>' />
<meta name='HandheldFriendly' content='true' />
<meta name='mobile-web-app-capable' content='yes' />
<meta name='distribution' content='Global' />
<meta name='og:site_name' content='FIRST REAL Co., Ltd' />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
      <link rel="stylesheet" href="lib/swiper/swiper.min.css">
      <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="css/header.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="css/footer.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="css/mobile.css" />
    
      <script src="lib/swiper/swiper.min.js"></script>
    <script src="lib/fullpage/fullpage.js"></script>
    <script src="lib/typed/typed.js"></script>
    <script src="lib/validation/jquery.validate.js"></script> 
    <script src="lib/validation/additional-methods.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        PATH ='<?php echo base_url() ?>';
    </script>
</head>

<body>
<?php

 if($this->uri->segment(1) == "home" || $this->uri->segment(1) =='' ){
	
 }else{
    $this->load->view('modules/header');
 }
?>
  
     <?php
                    if (isset($this->folder)) {
                        $file = (!isset($this->file) || $this->file == '') ? 'default' : $this->file;
                        $this->load->view('compoments/' . $this->folder . '/' . $file);
                    }
        ?>
    
    <?php 

 if($this->uri->segment(1) == "home" || $this->uri->segment(1) =='' ){
  
 }else{
    $this->load->view('modules/footer');
 }
     ?>
      
    <script src="js/main.js"></script> 
</body>
</html>