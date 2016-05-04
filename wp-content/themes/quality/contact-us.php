<?php
/*
Template Name: Contact Us
*/
get_header();
?>
<div class="page-seperator"></div>
<div class="container">
  <div class="row">
    <div class="qua_page_heading">
      <h1>Contact Us</h1>
      <div class="qua-separator"></div>
    </div>
  </div>
  <div class="page_content">
    <section class="contact-main">
      <div class="row contact-info">
        <div id="info" class="col-md-6 col-sm-6 qua_col_padding" style="padding: 0 15px">
          <div class="qua_page_heading">
            <h4>MỌI THÔNG TIN CHI TIẾT VUI LÒNG LIÊN HỆ:</h4>
            <div class="qua-separator" style="margin: 15px auto 0;"></div>
          </div>
          <div id="contact-detail">
            <div class="row contact-title">
              <span class="title"><i class="fa fa-building"></i> Company Name:</span>
              <span class="info" style="font-size: 17px;">Thien Ha Furniture Corporation<br></span>
            </div>
            <div class="row contact-title">
              <span class="title"><i class="fa fa-location-arrow"></i> Address:</span>
              <span class="info">112 Hoa Lan Str, Ward 2, Phu Nhuan Dist, HCM City, Vietnam<br></span>
            </div>
            <div class="row contact-title">
              <span class="title"><i class="fa fa-mobile-phone"></i> Tel:</span>
              <span class="info">0084-8-35178386<br></span>
            </div>
            <div class="row contact-title">
              <span class="title"><i class="fa fa-fax"></i> Fax:</span>
              <span class="info">0084-8-35173603<br></span>
            </div>
            <div class="row contact-title">
              <span class="title"><i class="fa fa-envelope-o"></i> Email:</span>
              <span class="info"><a href="mailto:contact@thienhafurniture .com">contact@thienhafurniture .com</a></span>
            </div>
            <div class="row contact-title">
              <span class="title"><i class="fa fa-skype"></i> Skype:</span>
              <span class="info">lenhung11<br></span>
            </div>
            <div class="row contact-title">
              <span class="title"><i class="fa fa-internet-explorer"></i> Website:</span>
              <span class="info"><a href="http://www.thienhafurniture.com.vn">http://www.thienhafurniture.com.vn</a><br></span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 qua_col_padding contact-form" style="padding: 0 15px">
          <div class="qua_page_heading">
            <h4>LIÊN HỆ:</h4>
            <div class="qua-separator" style="margin: 15px auto 0;"></div>
          </div>
          <?php
          echo do_shortcode ('[contact-form-7 id="50" title="Thiên Hà"]');
          ?>
        </div>
      </div>
      <div id="map" class="row">
        <div class="qua_page_heading">
          <h4>GOOGLE MAP:</h4>
          <div class="qua-separator" style="margin: 15px auto 0;"></div>
        </div>
        <?php
        echo do_shortcode ('[put_wpgm id=1]');
        ?>
      </div>
    </section>
    <div class="clear"></div>
  </div><!-- site-aligner -->
</div><!-- content -->
<?php get_footer(); ?>
