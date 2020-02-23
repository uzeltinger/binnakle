<style>
.demo-gallery>ul {
      margin-bottom: 0;
    }

    .demo-gallery>ul>li {
      float: left;
      margin-bottom: 15px;
      margin-right: 20px;
      width: 200px;
    }

    .demo-gallery>ul>li a {
      border: 3px solid #FFF;
      border-radius: 3px;
      display: block;
      overflow: hidden;
      position: relative;
      float: left;
    }

    .demo-gallery>ul>li a>img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      height: 100%;
      width: 100%;
    }

    .demo-gallery>ul>li a:hover>img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }

    .demo-gallery>ul>li a:hover .demo-gallery-poster>img {
      opacity: 1;
    }

    .demo-gallery>ul>li a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }

    .demo-gallery>ul>li a .demo-gallery-poster>img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }

    .demo-gallery>ul>li a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }

    .demo-gallery .justified-gallery>a>img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      height: 100%;
      width: 100%;
    }

    .demo-gallery .justified-gallery>a:hover>img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }

    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster>img {
      opacity: 1;
    }

    .demo-gallery .justified-gallery>a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }

    .demo-gallery .justified-gallery>a .demo-gallery-poster>img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }

    .demo-gallery .justified-gallery>a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }

    .demo-gallery .video .demo-gallery-poster img {
      height: 48px;
      margin-left: -24px;
      margin-top: -24px;
      opacity: 0.8;
      width: 48px;
    }

    .externalLink {
    width: 100px;
    height: 100px;
    position: absolute;
    left: 50%;
    top: 50%;
    margin-left: -42px;
    margin-top: -30px;
    z-index: 1080;
    cursor: pointer;
}
.externalLink {
    background: url('/images/link-binnakle-100.png');
}
   </style> 





<link href="./media/lightGallery/dist/css/lightgallery.css" rel="stylesheet">


<section class="page noticias">
<div class="demo-gallery mrb35 container">
    <div id="videos" class="row">


    <?php
            foreach ($this->items as $i => $article) :
                if ($this->items[$i]->state == 0) :
//$articleLink = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language));
                endif;
                $modalLink = "";
                $modalLinkVideo = "";
                $modalLinkExterno = "";
                $modalLinkPdf = "";
                $urls = json_decode($article->urls);
                $images  = json_decode($article->images);
                if (isset($images->image_intro) && !empty($images->image_intro)) :
                    $articleImage = '<img src="'.htmlspecialchars($images->image_intro).'" />';
                    $modalLink = JURI::base().htmlspecialchars($images->image_intro);
                    $class = "image";
                endif;                
                if ($urls && (!empty($urls->urla))) :
                    //$urls->urla, $urls->urlatext, $urls->targeta
                    $modalLinkVideo = $urls->urla;
                    $class = "video";
                endif;
                
                if ($urls && (!empty($urls->urlb))) :
                    $modalLinkExterno = $urls->urlb;
                    $class = "externo";
                endif;
                
                if ($urls && (!empty($urls->urlc))) :
                    $modalLinkPdf = $urls->urlc;
                    $class = "pdf";
                endif;               
    
                if (isset($images->image_fulltext) && !empty($images->image_fulltext)) :
                    $modalLink = JURI::base().htmlspecialchars($images->image_fulltext);
                    $class = "image";
                endif; ?>                       


<?php if ($modalLinkPdf != "") { ?>
    <div class="col-12 col-sm-6 col-md-4" data-iframe="true" data-src="<?php echo $modalLinkPdf ?>">
        <div class="noticia">
            <div class="contenido">
                <a href="">
                    <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_intro); ?>">
                </a>
            </div>
            <div class="epigrafe">
                <?php echo $article->title; ?>
            </div>
        </div>
    </div>
<?php } else if ($modalLinkExterno != "") { ?>
    
    <div class="col-12 col-sm-6 col-md-4" data-iframe="false" data-externalLink="<?php echo $modalLinkExterno ?>" data-src="<?php echo htmlspecialchars($images->image_intro); ?>" data-sub-html="<h4><?php echo $article->title; ?></p>">
        <div class="noticia">
            <div class="contenido">
                <a class="external-link" href="<?php echo $modalLinkExterno ?>" target="blank_">
                    <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_intro); ?>">               
                </a>
            </div>
            <div class="epigrafe">
                <?php echo $article->title; ?>
            </div>
        </div>
    </div>
<!--
    <div class="col-12 col-sm-6 col-md-4" data-iframe="true" data-src="<?php echo $modalLinkExterno ?>">
        <div class="noticia">
            <div class="contenido">
                <a href="">
                    <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_intro); ?>">
                </a>
            </div>
            <div class="epigrafe">
                <?php echo $article->title; ?>
            </div>
        </div>
    </div>
-->
<?php } else if ($modalLinkVideo != "") { ?>

    <div class="col-12 col-sm-6 col-md-4" data-poster="<?php echo htmlspecialchars($images->image_intro); ?>" data-src="<?php echo $modalLinkVideo ?>" data-sub-html="<h4><?php echo $article->title; ?></h4>">
        <div class="noticia">
            <div class="contenido">
                <a href="">
                    <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_intro); ?>">
                </a>
            </div>
            <div class="epigrafe">
                <?php echo $article->title; ?>
            </div>    
        </div>
    </div>
<?php } else if ($modalLink != "") { ?>
    <div class="col-12 col-sm-6 col-md-4" data-src="<?php echo $modalLink; ?>" data-sub-html="<h4><?php echo $article->title; ?></p>">
        <div class="noticia">
            <div class="contenido">
                <a href="">
                    <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_intro); ?>">
                </a>
            </div>
            <div class="epigrafe">
                <?php echo $article->title; ?>
            </div>
        </div>
    </div>
<?php } ?>
                   
<?php
endforeach;
?>
         
    </div>
</div>
</section>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#videos').lightGallery({
      loadYoutubeThumbnail: true,
      youtubeThumbSize: 'default',
    iframeMaxWidth: '80%'});    
    });
        
    jQuery(".external-link").click(function(event ) {  
        event.preventDefault();
        var link = jQuery(event.currentTarget).attr("href");
        console.log("link",link);
        window.open(link, '_blank');
        jQuery('#videos').closeGallery();
    });
</script>


<script src="./media/lightGallery/dist/js/lightgallery-all.js"></script>
<script src="./media/lightGallery/lib/jquery.mousewheel.min.js"></script>