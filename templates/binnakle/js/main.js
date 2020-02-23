
function loadDynamicContentModal() {    
    jQuery('#bootstrap-modal').modal({
        show : true
    });    
}
jQuery( document ).ready(function() {
    jQuery("a.dropdownover").click(function(event ) { 
        event.preventDefault();
        loadDynamicContentModal();
    });
    jQuery(".item-111 ul li a").click(function(event ) { 
        event.preventDefault();
        loadDynamicContentModal();
    });
    jQuery(".boton-presentacion").click(function(event ) { 
      event.preventDefault();
      loadDynamicContentModal();
  });
});


// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("goTop").style.display = "block";
  } else {
    document.getElementById("goTop").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

jQuery( document ).ready(function() {
    jQuery(".juego_theexpedition_open_submenu").click(function(event ) {         
        jQuery(".juego_mission0_submenu").css("display","none"); 
        console.log("juego_theexpedition_open_submenu");
        event.preventDefault();
        jQuery(this).siblings(".juego_theexpedition_submenu").toggle();
        //jQuery(".juego_theexpedition_submenu").css("display","block");        
    });    
    jQuery(".juego_mission0_open_submenu").click(function(event ) { 
        jQuery(".juego_theexpedition_submenu").css("display","none"); 
        console.log("juego_mission0_open_submenu");
        event.preventDefault();
        jQuery(this).siblings(".juego_mission0_submenu").toggle();
        //jQuery(".juego_mission0_submenu").css("display","block");        
    });

    jQuery('#bootstrap-modal').on('hidden.bs.modal', function (e) {
      jQuery('.iframe-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
      console.log("hidden.bs.modal");
    });

});