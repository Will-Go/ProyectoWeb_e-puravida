$(document).ready(function(){

    $('.album .card').hover(
      function() {
        $(this).animate({ fontSize: '20px' }, 300);
    
        $(this).stop().animate({
          transform: 'translateY(-7px)'
        }, 300);
      },
      function() {
        $(this).animate({ fontSize: '16px' }, 300);
    
        $(this).stop().animate({
          transform: 'translateY(0)'
        }, 300);
      }
    );
    
    // $('#galeria .card').hide();
    // $('.album .card').hover(
    //     function() {
    //         $(this).animate({ fontSize: '20px' }, 300);
  
    //         $(this).stop().animate({
    //           top: '-=7px' 
    //         }, {
    //           duration: 300,
    //           step: function(now, fx) {
    //             $(this).css('transform', 'translateY(' + now + 'px)');
    //           }
    //         });
  
    //       },
    //       function() {
          
    //         $(this).animate({ fontSize: '16px' }, 300);
  
    //         $(this).stop().animate({
    //           top: '0' 
    //         }, {
    //           duration: 300,
    //           step: function(now, fx) {
    //             $(this).css('transform', 'translateY(' + now + 'px)');
    //           }
    //         });
    //     }
    // );
  
    // $('.album .btn').hover(
    //   function() {
        
    //   },
    //   function() {
    //     $(this).animate({ fontSize: '16px' }, 300);
    //   }
    // );
  
  });
  