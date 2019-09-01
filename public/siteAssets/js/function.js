

$(document).ready(function() {
    $('.owl-carouselsa3').owlCarousel({
        rtl:true,
        loop:true,
        items:1,
        nav:true,
        autoplay:true,
        autoplayTimeout:2500,
        autoplayHoverPause:true,
            navText: [
              "<i class='icon-arrowhead-thin-outline-to-the-left'></i>",
              "<i class='icon-arrow-point-to-right2'></i>"
              ],
    });
});

$(document).ready(function(){
  $(".btn-menu").click(function() {
      $(".menu-side").css({'left':'0'});
      $(".btn-menu-close").css({'left':'0px'});
      $(".btn-menu").css({'display':'none'});
      $(".back-menu").css({'display':'block'});
  });
});
  $(".btnmenu").click(function() {
      $(".body").addClass('active');
      $(".menu_sidebar").addClass('active');
      $(".body_bg").css({'display':'block'});
  });

  $(".body_bg").click(function() {
      $(".menu_sidebar").removeClass('active');
      $(".body").removeClass('active');
      $(".colse").css({'display':'none'});
      $(".body_bg").css({'display':'none'});
      $(".btnmenu").css({'display':'block'});
  });
    $(".btn-menu").click(function() {
      $(".menu-side").css({'left':'0'});
      $(".btn-menu-close").css({'left':'0px'});
      $(".btn-menu").css({'display':'none'});
      $(".back-menu").css({'display':'block'});
  });
  function closeMenu() {
    $(".menu-side").css({'left':'-350px'});
    $(".btn-menu-close").css({'left':'-10px'});
    $(".btn-menu").css({'display':'block'});
    $(".back-menu").css({'display':'none'});
  }
  $(".btn-menu-close").click(function() {
    closeMenu();
  }); 
  $(".back-menu").click(function() {
    closeMenu();
  }); 

  $( ".menu-sidebar li:not(.nohide)" ).click(function() {
    $( this ).children('.submen').toggle( "fast", function() {});
    closeMenu();
  });
  $( ".menu-sidebar li.nohide" ).click(function() {
    $( this ).children('.submen').toggle( "fast", function() {});
  });
