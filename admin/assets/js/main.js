$(document).ready(function () {
    $('.download-btn').hover(

        function () {
            $(this).children('.edit_k').fadeIn("fast");
        },

        function () {
            $(this).children('.edit_k').fadeOut();
        }
    );
    $(".prod-srch").keyup(function () {
        let ikonka = $('.hladacik');
        if ($(this).val() != null || $(this).val() != "") {
            ikonka.removeClass('fa-search');
            ikonka.addClass('fa-times');
        }
        if ($(this).val() == null || $(this).val() == "") {
            ikonka.removeClass('fa-times');
            ikonka.addClass('fa-search');
        }
    });
    $(".hladacik").click(function () {
        $('.prod-srch').val('');
        console.log('clicked');
    });

    $(".product-name-heading").hover(
        function () {
            $('.edit_h').fadeIn();
        },

        function () {
            $('.edit_h').fadeOut();
        }
    )
    $(".product-code").hover(
        function () {
            $('.edit_pc').show();
        },

        function () {
            $('.edit_pc').hide();
        }
    )
    $(".product-kod").hover(
        function () {
            $('.edit_kod').show();
        },

        function () {
            $('.edit_kod').hide();
        }
    )

    $(".product-dost").hover(
        function () {
            $('.edit_dost').show();
        },

        function () {
            $('.edit_dost').hide();
        }
    )
    $(".product-cena").hover(
        function () {
            $('.edit_cena').show();
        },

        function () {
            $('.edit_cena').hide();
        }
    )

    $(".product-odpo").hover(
        function () {
            $('.edit_odpo').show();
        },

        function () {
            $('.edit_odpo').hide();
        }
    )

    $(".edit-close").hover(
        function () {
            $('.close_text').text('Zavrieť');
        },

        function () {
            $('.close_text').text('');
        }
    )

    $(".edit-save").hover(
        function () {
            $('.save_text').text('Uložiť');
        },

        function () {
            $('.save_text').text('');
        }
    )
    
    $(".edit_h").click(function () {
        let product_name_w = $('.p_name_heading').width();
        $('#product_name').show();
        $('.product_name_sc').css('display', 'flex');
        $('#product_name').width(product_name_w);
        $('.p_name_heading').hide();
        let product_name = $('.p_name_heading').text();
        $('#product_name').val(product_name);
        $('.edit_h').addClass('edit_h_hide');
        $('.edit_h').removeClass('edit_h');
    })

    $(".p_name_close").click(function () {
        $('.edit_h_hide').addClass('edit_h');
        $('.edit_h').removeClass('edit_h_hide');
        $('#product_name').hide();
        $('.product_name_sc').hide();
        $('.p_name_heading').show();
        $('#product_name').val(product_name);
    })
    $(".p_name_save").click(function () {
        let product_name_new = $('#product_name').val();
        $('.edit_h_hide').addClass('edit_h');
        $('.edit_h').removeClass('edit_h_hide');
        $('#product_name').hide();
        $('.product_name_sc').hide();
        $('.p_name_heading').text(product_name_new);
        $('#product_name').attr('value', product_name_new);
        $('.p_name_heading').show();
        $('.product-name-heading').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-name-heading').children(".saved-msg").css('height', '30px');
        setTimeout(function(){
            $('.product-name-heading').children(".saved-msg").animate({opacity: '0'});
            $('.product-name-heading').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".edit_pc").click(function () {
        let product_code_w = $('.product_code_span').width();
        $('#product_code').show();
        $('.product_code_sc').css('display', 'flex');
        $('#product_code').width(product_code_w);
        $('.product_code_span').hide();
        let product_code = $('.product_code_span').text();
        $('#product_code').val(product_code);
        $('.edit_pc').addClass('edit_h_hide-small');
        $('.edit_pc').removeClass('edit-small');
    })

    $(".p_code_close").click(function () {
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_code').hide();
        $('.product_code_sc').hide();
        $('.product_code_span').show();
        $('#product_code').val(product_code);
    })
    $(".p_code_save").click(function () {
        let product_code_new = $('#product_code').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_code').hide();
        $('.product_code_sc').hide();
        $('.product_code_span').text(product_code_new);
        $('#product_code').attr('value', product_code_new);
        $('.product_code_span').show();
        $('.product-code').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-code').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-code').children(".saved-msg").animate({opacity: '0'});
            $('.product-code').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".edit_kod").click(function () {
        let product_kod_w = $('.product_kod_span').width();
        $('#product_kod').show();
        $('.product_kod_sc').css('display', 'flex');
        $('#product_kod').width(product_kod_w);
        $('.product_kod_span').hide();
        let product_kod = $('.product_kod_span').text();
        $('#product_kod').val(product_kod);
        $('.edit_kod').addClass('edit_h_hide-small');
        $('.edit_kod').removeClass('edit-small');
    })

    $(".p_kod_close").click(function () {
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_kod').hide();
        $('.product_kod_sc').hide();
        $('.product_kod_span').show();
        $('#product_kod').val(product_kod);
    })
    $(".p_kod_save").click(function () {
        let product_kod_new = $('#product_kod').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_kod').hide();
        $('.product_kod_sc').hide();
        $('.product_kod_span').text(product_kod_new);
        $('#product_kod').attr('value', product_kod_new);
        $('.product_kod_span').show();
        $('.product-kod').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-kod').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-kod').children(".saved-msg").animate({opacity: '0'});
            $('.product-kod').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".edit_dost").click(function () {
        $('.left').hide();
        $('.right').hide();
        let product_dost_w = $('.product_dost_span').width();
        product_dost_w = product_dost_w + 20;
        $('#product_dost').show();
        $('.product_dost_sc').css('display', 'flex');
        $('#product_dost').width(product_dost_w);
        $('.product_dost_span').hide();
        let product_dost = $('.product_dost_span').text();
        $('#product_dost').val(product_dost);
        $('.edit_dost').addClass('edit_h_hide-small');
        $('.edit_dost').removeClass('edit-small');
    })

    $(".p_dost_close").click(function () {
        $('.left').show();
        $('.right').show();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_dost').hide();
        $('.product_dost_sc').hide();
        $('.product_dost_span').show();
        $('#product_dost').val(product_dost);
    })
    $(".p_dost_save").click(function () {
        let product_dost_new = $('#product_dost').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_dost').hide();
        $('.product_dost_sc').hide();
        $('.product_dost_span').text(product_dost_new);
        $('#product_dost').attr('value', product_dost_new);
        $('.product_dost_span').show();
        $('.left').show();
        $('.right').show();
        $('.product-dost').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-dost').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-dost').children(".saved-msg").animate({opacity: '0'});
            $('.product-dost').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".edit_cena").click(function () {
        $('.currency_cena').hide();
        let product_cena_w = $('.product_cena_span').width();
        $('#product_cena').width(product_cena_w);
        $('#product_cena').show();
        $('.product_cena_sc').css('display', 'flex'); 
        $('.product_cena_span').hide();
        let product_cena = $('.product_cena_span').text();
        $('#product_cena').val(product_cena);
        $('.edit-small').addClass('edit_h_hide-small');
        $('.edit_h_hide-small').removeClass('edit-small');
        
    })

    $(".p_cena_close").click(function () {
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_cena').hide();
        $('.product_cena_sc').hide();
        $('.currency_cena').show();
        $('.product_cena_span').show();
        $('#product_cena').val(product_cena);
    })
    $(".p_cena_save").click(function () {
        let product_cena_new = $('#product_cena').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_cena').hide();
        $('.product_cena_sc').hide();
        $('.product_cena_span').text(product_cena_new);
        $('#product_cena').attr('value', product_cena_new);
        $('.currency_cena').show();
        $('.product_cena_span').show();
        $('.product-cena').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-cena').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-cena').children(".saved-msg").animate({opacity: '0'});
            $('.product-cena').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".edit_odpo").click(function () {
        $('.currency_odpo').hide();
        let product_odpo_w = $('.product_odpo_span').width();
        $('#product_odpo').width(product_odpo_w);
        $('#product_odpo').show();
        $('.product_odpo_sc').css('display', 'flex'); 
        $('.product_odpo_span').hide();
        let product_odpo = $('.product_odpo_span').text();
        $('#product_odpo').val(product_odpo);
        $('.edit-small').addClass('edit_h_hide-small');
        $('.edit_h_hide-small').removeClass('edit-small');
        
    })

    $(".p_odpo_close").click(function () {
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_odpo').hide();
        $('.product_odpo_sc').hide();
        $('.currency_odpo').show();
        $('.product_odpo_span').show();
        $('#product_odpo').val(product_odpo);
    })
    $(".p_odpo_save").click(function () {
        let product_odpo_new = $('#product_odpo').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_odpo').hide();
        $('.product_odpo_sc').hide();
        $('.product_odpo_span').text(product_odpo_new);
        $('#product_odpo').attr('value', product_odpo_new);
        $('.currency_odpo').show();
        $('.product_odpo_span').show();
        $('.product-odpo').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-odpo').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-odpo').children(".saved-msg").animate({opacity: '0'});
            $('.product-odpo').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    });
    function updateURLParameter(url, param, paramVal) {
        var TheAnchor = null;
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var additionalURL = tempArray[1];
        var temp = "";

        if (additionalURL) {
            var tmpAnchor = additionalURL.split("#");
            var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];
            if (TheAnchor)
                additionalURL = TheParams;

            tempArray = additionalURL.split("&");

            for (var i = 0; i < tempArray.length; i++) {
                if (tempArray[i].split('=')[0] != param) {
                    newAdditionalURL += temp + tempArray[i];
                    temp = "&";
                }
            }
        }
        else {
            var tmpAnchor = baseURL.split("#");
            var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];

            if (TheParams)
                baseURL = TheParams;
        }

        if (TheAnchor)
            paramVal += "#" + TheAnchor;

        var rows_txt = temp + "" + param + "=" + paramVal;
        window.location = baseURL + "?" + newAdditionalURL + rows_txt;
    }