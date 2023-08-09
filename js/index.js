$(document).ready(function(){
    $('#Paquetes .card').hover(
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
              top: '0' // Move back up by 50px using the 'top' property
            }, {
              duration: 300,
              step: function(now, fx) {
                $(this).css('transform', 'translateY(' + now + 'px)');
              }
            });
        }
    );

});

