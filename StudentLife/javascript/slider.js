function slider () {
    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;
    slider.oninput = function() {
        output.innerHTML = this.value;
    }
    $('.star').hover(function(){
        $(this).prevAll().andSelf().removeClass('fa-star-o').addClass('fa-star');
      });
      
      $('.star').mouseout(function(){
        $(this).prevAll().andSelf().removeClass('fa-star').addClass('fa-star-o');
      });
      
      $('.star').click(function(){
                 alert($(this).prevAll().length+1);
      });

}
