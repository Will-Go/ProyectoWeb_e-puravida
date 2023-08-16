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
              top: '0' 
            }, {
              duration: 300,
              step: function(now, fx) {
                $(this).css('transform', 'translateY(' + now + 'px)');
              }
            });
        }
    );

    $('#paquetes-fila-1 .btn').hover(
      function() {
        $(this).animate({ fontSize: '20px' }, 300);
      },
      function() {
        $(this).animate({ fontSize: '16px' }, 300);
      }
    );

});

