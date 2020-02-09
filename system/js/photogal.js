$(document).ready(function(){

	$(".wrapper").find("img:not(:first)").hide();
	actual = $(".wrapper img:visible").index()+1;
	elementos = $(".wrapper").find("img").length;
	$('.anterior').addClass('disabled');
	contarElementos(actual);
	leyendaRetratos();
	leyendaIncial();
	var divI =$("<div/>");
	divI.addClass("leyendita");
	$(".leyendita").prependTo(".owl-nav");
});

$('#navigation > ul > li > a').click(function() {
    var checkElement = $(this).next();
    $('#navigation li').removeClass('active');
    $(this).closest('li').addClass('active');	
    $(this).closest('ul ul').slideUp('normal');
    
    if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
      $(this).closest('li').removeClass('active');
      checkElement.slideUp('normal');
      $('#navigation ul ul ul').slideUp('normal');
    }
    
    if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
      $('#navigation ul ul:visible').slideUp('normal');
      checkElement.slideDown('normal');
    }
    
    if (checkElement.is('ul')) {
      return false;
    } else {
      return true;	
    }		
  });
  
  $('#navigation > ul >li > ul > li > a').click(function(){
  	var subElement = $(this).next();
  	
  	if((subElement.is('ul')) && (subElement.is(':visible'))) {
      
      subElement.slideUp('normal');
    }
    
    if((subElement.is('ul')) && (!subElement.is(':visible'))) {
      
      subElement.slideDown('normal');
    }
  });

  var resaltar = $('#navigation span');
  $(resaltar).mouseover(function(){
    $(this).css("background", "#A6EDD2");
  }); 
  $(resaltar).mouseout(function(){
    $(this).css("background", "#fff");
  });

$(".fa-th").on("click",function(){
	if($(".fa-th").hasClass('activo')){
		$('.wrapper').hide();
		$('.wrapperP').show();
		$(".fa-th").removeClass('activo');
	}else {
		$('#gallery .wrapperP').hide();
		$('#gallery .wrapper').show();
		$(".fa-th").addClass('activo');
	}
});

$(".owl-carousel").hover(function(){
	$(".owl-nav").css("display","block");
	$(".leyendita").css("opacity","1");
	leyendaIncial();
}, function(){
	$(".owl-nav").css("display","none");
	$(".leyendita").css("opacity","0");
});

$(".leermas").toggle(
		function(){
			$(this).html("- Ocultar descripción de proyecto");
			$(".descripcion").show();
		},
		function(){
			$(this).html("+ Mostrar descripción de proyecto");
			$(".descripcion").hide();
		});


$(".icon-info").on("click", function(){
	$(".leyenda").toggle();
	});

$(".leyret").on("click", function(){
	$(".leyendaRetratos").toggle();
	});

$('.wrapperP a').on("click",function(){
	nactual = $('.wrapperP a').index(this)+1;
		$(".fa-th").addClass('activo');
		$('.wrapperP').hide();
		$('.wrapper').show();
		if(actual<=nactual){
			ir = nactual-actual;
			$(".wrapper img").slice(0,ir).fadeOut().appendTo($(".wrapper"));
			$(".wrapper img").first().fadeIn();
			actual = nactual
			galeriaCargarPágina(actual);
			leyendaRetratos();
			leyendaIncial();
		}
		if (actual>nactual){
			ir = elementos + nactual - actual;
			$(".wrapper img").slice(0,ir).fadeOut().appendTo($(".wrapper"));
			$(".wrapper img").first().fadeIn();
			actual = nactual
			galeriaCargarPágina(actual);
			leyendaRetratos();
			leyendaIncial();
		}
});

function leyendaRetratos(){
	var fotoLeyenda = $(".wrapper img").first().attr("alt");
	$(".leyendaRetratos").html(fotoLeyenda);
}
function leyendaIncial(){
	var leyendasI = $(".owl-stage .active img").first().attr("title");
	$(".leyendita").html(leyendasI);
}
function galeriaAnterior(){
	if(actual < 2) return;
	$(".fa-th").addClass('activo');
	$(".wrapperP").hide();
	$(".wrapper").show();
	$(".wrapper img:visible").fadeOut();
	$(".wrapper img").last().prependTo($(".wrapper")).fadeIn();
	galeriaCargarPágina(actual - 1);
	leyendaRetratos();
	leyendaIncial();

}
function galeriaSiguiente(){
	if(actual > elementos-1) return;
	$(".fa-th").addClass('activo');
	$(".wrapperP").hide();
	$(".wrapper").show();
	$(".wrapper img:visible").fadeOut().appendTo($(".wrapper"));
	$(".wrapper img").first().fadeIn();
	galeriaCargarPágina(actual + 1);
	leyendaRetratos();
	leyendaIncial();
}
function contarElementos(n){
	$('.contar').html(n +'/'+elementos);
}
function galeriaCargarPágina(n){
	actual = n;
	if(n > 1){
		$('.anterior').removeClass('disabled');
	}else{
		$('.anterior').addClass('disabled');
	}
	if(n < elementos){
		$('.siguiente').removeClass('disabled');
	}else{
		$('.siguiente').addClass('disabled');
	}
	contarElementos(actual);
}