
 $(document).ready(function(){
    $(".box").hide();
});
      $(document).ready(function(){
      $(".slide-toggle").click(function(){
          $(".box").animate({
              width: "toggle"
          });
      });
  });
  