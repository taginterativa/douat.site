$(function() {
    $(".states .item").click(function(){
        $(".states .item").each(function(){
            $(this).removeClass("active");
        });
        $(this).addClass("active");
        $(".white_column:eq(1)").removeClass("opacity");
    });
    $('body').on("click",".cities .item", function(){
        $(".cities .item").each(function(){
            $(this).removeClass("active");
        });
        $(this).addClass("active");
        $(".white_column:eq(2)").removeClass("opacity");
    });

    //Verifica tela
    var largura = $(window).width();
    if(largura < 1000) {
        $('body').addClass('mobile');
    }

	$('html').removeClass('no-js');

	var altura = $(document).height();
	$('.overlay').css(altura+'px');

	//$('[data-background-image]').css('background-image', dataBackgroundImage);
	//$('[data-img-src]').each(dataImgSrc);

    // controla rodape
    var altura_conteudo = $('.miolo-prod').height();
    var altura_janela = $(window).height();
    if(altura_conteudo < altura_janela) {
        $('.footer-container').addClass('fixed');
    }

	if ($('.fancybox').length) {
		$('.fancybox').fancybox({
			padding: 5,
			tpl: {
				error: '<p class="fancybox-error">O conteúdo solicitado não pode ser carregado.<br/>Por favor, tente novamente mais tarde.</p>',
				closeBtn: '<a title="Fechar" class="fancybox-item fancybox-close" href="javascript:;"></a>',
				next: '<a title="Próximo" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
				prev: '<a title="Anterior" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
			}
		});
	}

	$('.only-mobile.nav-malhas').flexslider({
		animation : 'slide',
        selector: '.slide-mobile > li',
		controlNav: false,
        touch: true
	});

    var mySwiper = $('.swiper-container').swiper({
        mode:'horizontal',
        loop: true,
        pagination: '.marcadores-home',
        createPagination: false,
        paginationClickable: true,
        autoplay: 10000,
        onSlideChangeStart: function(swiper, direction) {
            //console.log(swiper.activeIndex);
            var active = swiper.activeLoopIndex+1;
            $('.bg-home').removeClass('ativo');
            $('.home-'+active).addClass('ativo');
            if($('.swiper-slide[data-slide="'+active+'"]').hasClass('claro')) {
                $('.marcadores-home').addClass('claro');
                $('body').addClass('claro');
            } else {
                $('.marcadores-home').removeClass('claro');
                $('body').removeClass('claro');
            }
        }
    });
    var colorSlide = $('.color_slide').swiper({
        mode:'horizontal',
        loop: true,
        slidesPerView: 3
    });
    var colorSlide2 = $('.color_slide2').swiper({
        mode:'horizontal',
        loop: true,
        slidesPerView: 3
    });
    $('.seta-esq').click(function() {
        mySwiper.swipePrev();
    });
    $('.seta-dir').click(function() {
        mySwiper.swipeNext();
    });

    $('.color_slide_left').click(function() {
        colorSlide.swipePrev();
    });
    $('.color_slide_right').click(function() {
        colorSlide.swipeNext();
    });

    $('.color_slide2_left').click(function() {
        colorSlide2.swipePrev();
    });
    $('.color_slide2_right').click(function() {
        colorSlide2.swipeNext();
    });

    $('.icon-zoom').click(function() {
        var altura = $('.img-malha').data('altura');
        var media = (altura - 185) / 2;
        $('.img-malha').addClass('aberto');
        $('.overlay').fadeIn();
        $('.fechar-foto').fadeIn();
        $('.img-malha').css('top', '-130px');
        $('.img-malha').css('height', altura+'px');
        return false;
    });
    $('.bloco-estampas').click(function() {
        var bg = $(this).data('bg');
        $('.estampa-zoom').find('img').remove();
        $('.estampa-zoom').append('<img src="'+bg+'">');
        $('.estampa-zoom').show();
        $('.overlay').show();
        $('.estampa-zoom .fechar-foto').show();
        return false;
    });

    $('.fechar-foto').click(function() {
        $('.overlay').fadeOut();
        $('.fechar-foto').fadeOut();
        $('.img-malha').removeClass('aberto');
        $('.img-malha').css('top', 0);
        $('.img-malha').css('height', 185+'px');
        $('.float-malha').fadeOut();
        $('.estampa-zoom').hide();
        $('.estampa-zoom img').remove();
    });

    $('.open-ficha').click(function() {
        var img = $(this).data('ficha');
        $('.overlay').fadeIn();
        $('.fechar-foto').fadeIn();
        $('.float-malha').fadeIn();
        return false;
    });

    $('.select').customSelect();



	/**
	/* Versão alternativa para navegadores antigos que não suportam "placeholder".
	**/
	$('.lt-ie10 [placeholder]').focus(placeholderFocus).blur(placeholderBlur).trigger('blur');
	$('.lt-ie10 [placeholder]').parents('form').submit(placeholderSubmit);

	inputMasks();

	ajustaHome();
    ajustaMenu();
    var rtime = new Date(1, 1, 2000, 12,00,00);
    var timeout = false;
    var delta = 200;
    $(window).resize(function() {
        var largura = $(window).width();
        if(largura < 1000) {
            ajustaMobile();
        } else {
            retornaMobile();
        }
        ajustaHome();
        ajustaMenu();
    });


    $('.bt-default-conheca').click(function() {
        if($('body').hasClass('mobile')) {
            window.location = "#secundary";
        } else {
           $.fn.fullpage.moveTo($(this).data("index"));
        }
        return false;
    });

    $('.bt-scroll').click(function() {
        if($('body').hasClass('mobile')) {
            window.location = "#secundary";
        } else {
           $.fn.fullpage.moveTo($(this).data("index"));
        }
    });


    //Menu home
    $('.nav-malhas a').mouseenter(function() {
    	$(this).parent().addClass('ativo');
    });
    $('.nav-malhas a').mouseleave(function() {
    	$(this).parent().removeClass('ativo');
    });
    $('.nav-malhas .fake-nav').mouseenter(function() {
    	var node = $(this).data('node');
    	$('.nav-malhas li.node-'+node).addClass('ativo');
    });
    $('.nav-malhas .fake-nav').mouseleave(function() {
    	var node = $(this).data('node');
    	$('.nav-malhas li.node-'+node).removeClass('ativo');
    });
    $('.fake-nav').click(function() {
    	var url = $(this).data('url');
    	window.location = url;
    });

    //Menu Geral
    if(!$('body').hasClass('mobile')) {
        $('.nav-header li a').mouseenter(function() {
        	$(this).parent().addClass('ativo');
        });
        $('.nav-header li a').mouseleave(function() {
        	$(this).parent().removeClass('ativo');
        });
        $('.header-container .fake-nav').mouseenter(function() {
        	var node = $(this).data('node');
        	$('.nav-header li.node-'+node).addClass('ativo');
        	if($('.nav-header li.node-'+node).hasClass('parent')) {
        		$('.nav-header li.node-'+node).find('ul').addClass('ativo');
        		$('.nav-header li:not(.ativo)').addClass('hide');
        	}
        });
        $('.header-container .fake-nav').mouseleave(function() {
        	var node = $(this).data('node');
        	if(!$('.nav-header li.node-'+node).hasClass('parent')) {
    	    	$('.nav-header li').removeClass('hide');
    	    	$('.nav-header li ul').removeClass('ativo');
    	    	$('.nav-header li.node-'+node).removeClass('ativo');
    	    }
        });

        $('.header-container nav li ul').mouseenter(function() {
        	$(this).addClass('ativo');
        	$(this).parent().addClass('ativo');
        });
        $('.header-container nav li ul').mouseleave(function() {
        	$(this).removeClass('ativo');
        	$(this).parent().removeClass('ativo');
        	$('.nav-header li').removeClass('hide');
        	$('.nav-header li ul').removeClass('ativo');
        });
        $('.nav-header').mouseleave(function() {
        	$('.nav-header .ativo').removeClass('ativo');
        	$('.nav-header li').removeClass('hide');
        });
    }
    $('.nav-header li a span').click(function() {
        var url = $(this).data('url');
        window.location = url;
        return false;
    });

    // Mobile
    $('.mobile .nav-header .parent a').click(function() {
        if($(this).parent().find('ul').size() > 0) {
            if(!$(this).parent().hasClass('ativo')) {
                $(this).parent().toggleClass('ativo');
                $(this).parent().find('ul').toggleClass('ativo');
                $('.nav-header li:not(.ativo)').toggleClass('hide');
            } else {
                $(this).parent().toggleClass('ativo');
                $(this).parent().find('ul').toggleClass('ativo');
                $('.nav-header li').removeClass('hide');
            }
            return false;
        }
    });
    $('.mobile .header-container .fake-nav').click(function() {
        var node = $(this).data('node');
        if($('.nav-header li.node-'+node).hasClass('parent')) {
            if(!$('.nav-header li.node-'+node).hasClass('ativo')) {
                $('.nav-header li.node-'+node).addClass('ativo');
                $('.nav-header li.node-'+node).find('ul').addClass('ativo');
                $('.nav-header li:not(.ativo)').addClass('hide');
            } else {
                $('.nav-header li.node-'+node).removeClass('ativo');
                $('.nav-header li.node-'+node).find('ul').removeClass('ativo');
                $('.nav-header li:not(.ativo)').removeClass('hide');
            }
        }
    });
    $('.mobile .filtros-links a').click(function() {
        if($(this).hasClass('ativo')) {
            $('.mobile .filtros-links a').fadeIn();
            return false;
        } else {
            $('.mobile .filtros-links a.ativo').removeClass('ativo');
            $(this).addClass('ativo');
            $('.filtros-links').prepend(this);
            $('.mobile .filtros-links a:not(.ativo)').hide();
        }
    });

    $('.overlay').click(function() {
        $('.bt-menu').removeClass('aberto');
        $('.overlay').fadeOut();
        $('.header-container nav').fadeOut();
        $('.overlay').fadeOut();
        $('.fechar-foto').fadeOut();
        $('.img-malha').removeClass('aberto');
        $('.img-malha').css('top', 0);
        $('.img-malha').css('height', 185+'px');
        $('.float-malha').fadeOut();
        $('.estampa-zoom').fadeOut();
    });
    $('.bt-menu').click(function() {
    	if($(this).hasClass('aberto')) {
    		$(this).removeClass('aberto');
    		$('.overlay').fadeOut();
    		$('.header-container nav').fadeOut();
    	} else {
    		$(this).addClass('aberto');
    		$('.overlay').show();
    		$('.header-container nav').fadeIn();
    	}
    	return false;
    });

    $('.selectbox .label').click(function() {
    	$(this).parent().find('.opc-selectbox').slideToggle();
    	return false;
    });
    $('.opc-selectbox a').click(function() {
    	var place = $(this).html();
    	var valor = $(this).data('value');
    	var alvo = $(this).parent().data('input');
    	$('#'+alvo).val(valor);
    	$(this).parent().slideUp();
    	$(this).parent().parent().find('.label').html(place);
    	return false;
    });

    $('.lista-blocos li').mouseenter(function() {
    	$(this).addClass('ativo');
    	$('.lista-blocos li:not(.ativo)').addClass('opacity');
    });
    $('.lista-blocos li').mouseleave(function() {
    	$(this).removeClass('ativo');
    	$('.lista-blocos li').removeClass('opacity');
    });

    $(".form-default").validate();

    $('.troca-malha').mouseenter(function() {
    	var bg = $(this).data('bg');
    	$('.bg-malhas').removeClass('ativo');
    	$('.malha-'+bg).addClass('ativo');
        if(bg == 4) {
            $('.secundary').addClass('malha-praia');
            $('.logo').addClass('malha-praia');
            $('.bt-menu').addClass('malha-praia');
        }
    });
    $('.troca-malha').mouseleave(function() {
    	$('.bg-malhas').removeClass('ativo');
    	$('.malha').addClass('ativo');
        $('.secundary').removeClass('malha-praia');
        $('.logo').removeClass('malha-praia');
        $('.bt-menu').removeClass('malha-praia');
    });

});

function ajustaMobile() {
    $('body').addClass('mobile');
    $('.only-mobile.nav-malhas').flexslider({
        animation : 'slide',
        selector: '.slide-mobile > li',
        controlNav: false,
        touch: true
    });
}

function retornaMobile() {
    $('body').removeClass('mobile');
}

function ajustaMenu() {
    if(!$('body').hasClass('mobile')) {
        var altura_tela = $(window).height();
        var top_menu = altura_tela / 2 - 200;
        $('.header-container nav').css('top',top_menu+'px');
        top_menu = top_menu + 139;
        $('.header-container nav li ul').css('top',top_menu+'px');
    }
}
function ajustaHome() {
	var altura_tela = $(window).height();
	var pos_conteudo = altura_tela*0.33;
    var pos_metade = altura_tela / 2;
    var pos_quarto = altura_tela / 4;
    if($('body').hasClass('mobile')) {
        pos_conteudo = pos_metade - pos_quarto;
    }
	$('.control-home').height(altura_tela);
	$('.content-home').css('padding-top',pos_conteudo+'px');
    $('.setas').css('top', pos_conteudo+'px');
    if($('body').hasClass('mobile')) {
        pos_conteudo = pos_metade - pos_quarto;
    }
    $('.secundary').height(altura_tela);
	$('.secundary .limiter-secundary').css('padding-top',pos_conteudo+'px');
}

function inputMasks() {
	$('input.tel').focus(function () {
		$(this).mask('(99) 9999-9999?9', {
			completed: function () {
				$(this).mask('(99) 99999-9999');
			}
		})
	});
	$('input.cep').mask('99999-999');
    if($('html').hasClass('lt-ie10')) {
        $('input.data').focus(function() {
            $('input.data').mask('99/99/9999');
        });
    } else {
        $('input.data').mask('99/99/9999');
    }

}

function dataBackgroundImage() {
	var data = $(this).attr('data-background-image');
	$(this).removeAttr('data-background-image');

	return ['url(', data, ')'].join('');
}

function dataImgSrc() {
	var img_src = $(this).attr('data-img-src'),
		img_alt = $(this).text();

	$(this).html(['<img src="', img_src, '" alt="', img_alt, '"/>'].join(''));
}

function navClick() {
	$(this).closest('nav').find('.active').removeClass('active');
	$(this).addClass('active');
}

function placeholderFocus() {
	var input = $(this);
	if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');

		if (input.hasClass('password'))
			input.attr('type', 'password').removeClass('password');
	}
}

function placeholderBlur() {
	var input = $(this);
	if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));

		if (input.attr('type') == 'password')
			input.attr('type', 'text').addClass('password');
	}
}

function placeholderSubmit() {
	$(this).find('[placeholder]').each(placeholderEach);
}

function placeholderEach() {
	var input = $(this);
	if (input.val() == input.attr('placeholder'))
		input.val('');
}

function setCookie(name, value, days) {
	var date = new Date();
	date.setDate(date.getDate() + days);

	var cookie = escape(value) + ((days==null) ? '' : '; expires=' + date.toUTCString());
	document.cookie = name + '=' + cookie;
}

function getCookie(name) {
	var cookie = document.cookie;
	var start = cookie.indexOf(" " + name + "=");

	if (start == -1) {
		start = cookie.indexOf(name + "=");
	}

	if (start == -1) {
		cookie = null;
	} else {
		start = cookie.indexOf("=", start) + 1;

		var end = cookie.indexOf(";", start);

		if (end == -1) {
			end = cookie.length;
		}

		cookie = unescape(cookie.substring(start, end));
	}

	return cookie;
}

 function trocaLabelcidade(cidade) {
    var place = $(this).html();
    var alvo = 'cidade';
    $('#'+alvo).val(cidade);
    $('#cidades').slideUp();
    $('#cidades').parent().find('.label').html(cidade);
}

//REPRESENTANTES
$(document).ready(function(){
    $('.page-representantes #estado').change(function(){
        console.log('aaaa');
        $.ajax({
            type: "GET",
            url: baseUrl + "representantes/get_cidades/" + $('#estado').val() ,
            dataType: "JSON"
        })
            .done(function( data ) {
                var html = '<option value="">Selecione</option>';

                $(data).each(function(i, item){
                    html += '<option value="'+item.nome+'">'+item.nome+'</option>';
                    //html += '<a href="#" onClick="trocaLabelcidade(\''+item.nome+'\'); return false;" data-value="' + item.nome + '">' + item.nome + '</a>';
                });

                $("#cidade").html(html);
            });
    });

});


//Trabalhe conosco
$(document).ready(function(){
    $('.page-trabalhe #estado').change(function(){
        $.ajax({
            type: "GET",
            url: baseUrl + "trabalhe-conosco/ajax/" + $('#estado').val() ,
            dataType: "JSON"
        })
            .done(function( data ) {
                var html = '<option value="">Selecione</option>';

                $(data).each(function(i, item){
                    html += '<option value="'+item.nome+'">'+item.nome+'</option>';
                    //html += '<a href="#"  onClick="trocaLabelcidade(\''+item.nome+'\'); return false;" data-value="' + item.nome + '">' + item.nome + '</a>';
                });

                $("#cidade").html(html);
            });
    });
});

