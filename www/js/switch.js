
function reloadImage(){
	$('img').each(function(){
		$(this).hide();
	});
	$('.portchannel').each(function(){
		$(this).find('.images .'+$(this).find('.nav .active a').text()).show();
 	});
 	$('.ethernet').each(function(){
		$(this).find('.images .'+$(this).find('.nav .active a').text()).show();
 	});
	$('[class^="Port-Channel"]').each(function(){
		$(this).find('img').show();
	})
}





$(document).ready(function() {

	
	reloadImage();
	$('.nav li').click(function(){
    	$(this).addClass('active').siblings().removeClass('active');
    	reloadImage();
	});
	var moveLeft = 20;
        var moveDown = 10;
	$( ".portchannel .images" )
		.mouseenter(function() {
			$('.'+$(this).attr('id')).show();
		})
		.mouseleave(function() {
			$('.'+$(this).attr('id')).hide();
		}
  	);
	
	$( ".portchannel .images" )
		.hover(function(e) {
			$('.'+$(this).attr('id')).show();
		}, function() {
          $('.'+$(this).attr('id')).hide();
        });
        $(".portchannel .images").mousemove(function(e) {
          $('.'+$(this).attr('id')).css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });
	
/*
	
	$(function() {
        var moveLeft = 20;
        var moveDown = 10;
        
        
        
        $('.portchannel').hover(function(e) {
	        
          $('.'+$(this).attr('id')).show();
        }, function() {
          $('.'+$(this).attr('id')).hide();
        });
        
        $('.portchannel').mousemove(function(e) {
          $("."+$(this).attr('id')).css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });
        
      });	
*/
	
	
});