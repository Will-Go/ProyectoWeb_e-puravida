$(document).ready(function(){
    // $('#galeria .card').hide();
    $('.album .card').hover(
        function() {
       

            $(this).stop().animate({
              top: '-=7px' 
            }, {
              duration: 300,
              step: function(now, fx) {
                $(this).css('transform', 'translateY(' + now + 'px)');
              }
            });
          },
          function() {
          

            $(this).stop().animate({
              top: '0' 
            }, {
              duration: 300,
              step: function(now, fx) {
                $(this).css('transform', 'translateY(' + now + 'px)');
              }
            });
        }
    );

});
