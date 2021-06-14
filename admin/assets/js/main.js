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

    $(".product-aktual").hover(
        function () {
            $('.edit_aktual').show();
        },

        function () {
            $('.edit_aktual').hide();
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
    
    $(".product-rabat").hover(
        function () {
            $('.edit_rabat').show();
        },

        function () {
            $('.edit_rabat').hide();
        }
    )

    $(".product-poplatok").hover(
        function () {
            $('.edit_poplatok').show();
        },

        function () {
            $('.edit_poplatok').hide();
        }
    )

    $(".product-popis").hover(
        function () {
            $('.edit_popis').show();
        },

        function () {
            $('.edit_popis').hide();
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

    $('.akcia_sc').children(".edit-save").hover(
        function () {
            $('.save_text').text('Pridať');
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

    $(".edit_aktual").click(function () {
        $('.left').hide();
        $('.right').hide();
        let product_aktual_w = $('.product_aktual_span').width();
        product_aktual_w = product_aktual_w + 20;
        $('#product_aktual').show();
        $('.product_aktual_sc').css('display', 'flex');
        $('#product_aktual').width(product_aktual_w);
        $('.product_aktual_span').hide();
        $('.edit_aktual').addClass('edit_h_hide-small');
        $('.edit_aktual').removeClass('edit-small');
    })

    $(".p_aktual_close").click(function () {
        $('.left').show();
        $('.right').show();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_aktual').hide();
        $('.product_aktual_sc').hide();
        $('.product_aktual_span').show();
        $('#product_aktual').val(product_aktual);
    })
    $(".p_aktual_save").click(function () {
        let product_aktual_new = $('#product_aktual').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_aktual').hide();
        $('.product_aktual_sc').hide();
        $('.product_aktual_span').text(product_aktual_new);
        $('#product_aktual').attr('value', product_aktual_new);
        $('.product_aktual_span').show();
        $('.left').show();
        $('.right').show();
        $('.product-aktual').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-aktual').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-aktual').children(".saved-msg").animate({opacity: '0'});
            $('.product-aktual').children(".saved-msg").animate({height: '0px'});
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
        $('#product_odpo').css('width','40%');
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

    $(".edit_rabat").click(function () {
        $('.currency_rabat').hide();
        let product_rabat_w = $('.product_rabat_span').width();
        $('#product_rabat').css('width','40%');
        $('#product_rabat').show();
        $('.product_rabat_sc').css('display', 'flex'); 
        $('.product_rabat_span').hide();
        let product_rabat = $('.product_rabat_span').text();
        $('#product_rabat').val(product_rabat);
        $('.edit-small').addClass('edit_h_hide-small');
        $('.edit_h_hide-small').removeClass('edit-small');
        
    })

    $(".p_rabat_close").click(function () {
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_rabat').hide();
        $('.product_rabat_sc').hide();
        $('.currency_rabat').show();
        $('.product_rabat_span').show();
        $('#product_rabat').val(product_rabat);
    })
    $(".p_rabat_save").click(function () {
        let product_rabat_new = $('#product_rabat').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_rabat').hide();
        $('.product_rabat_sc').hide();
        $('.product_rabat_span').text(product_rabat_new);
        $('#product_rabat').attr('value', product_rabat_new);
        $('.currency_rabat').show();
        $('.product_rabat_span').show();
        $('.product-rabat').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-rabat').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-rabat').children(".saved-msg").animate({opacity: '0'});
            $('.product-rabat').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".edit_poplatok").click(function () {
        $('.currency_poplatok').hide();
        let product_poplatok_w = $('.product_poplatok_span').width();
        $('#product_poplatok').css('width','40%');
        $('#product_poplatok').show();
        $('.product_poplatok_sc').css('display', 'flex'); 
        $('.product_poplatok_span').hide();
        let product_poplatok = $('.product_poplatok_span').text();
        $('#product_poplatok').val(product_poplatok);
        $('.edit-small').addClass('edit_h_hide-small');
        $('.edit_h_hide-small').removeClass('edit-small');
        
    })

    $(".p_poplatok_close").click(function () {
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_poplatok').hide();
        $('.product_poplatok_sc').hide();
        $('.currency_poplatok').show();
        $('.product_poplatok_span').show();
        $('#product_poplatok').val(product_poplatok);
    })
    $(".p_poplatok_save").click(function () {
        let product_poplatok_new = $('#product_poplatok').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_poplatok').hide();
        $('.product_poplatok_sc').hide();
        $('.product_poplatok_span').text(product_poplatok_new);
        $('#product_poplatok').attr('value', product_poplatok_new);
        $('.currency_poplatok').show();
        $('.product_poplatok_span').show();
        $('.product-poplatok').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-poplatok').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-poplatok').children(".saved-msg").animate({opacity: '0'});
            $('.product-poplatok').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".edit_popis").click(function () {
        $('.currency_popis').hide();
        let product_popis_w = $('.product_popis_span').width();
        let product_popis_h = $('.product_popis_span').height();
        $('#product_popis').css('width',product_popis_w);
        $('#product_popis').css('height','80vh');
        $('#product_popis').show();
        $('.product_popis_sc').css('display', 'flex'); 
        $('.product_popis_span').hide();
        let product_popis = $('.product_popis_span').text();
        $('#product_popis').val(product_popis);
        $('.edit-small').addClass('edit_h_hide-small');
        $('.edit_h_hide-small').removeClass('edit-small');
        
    })

    $(".p_popis_close").click(function () {
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_popis').hide();
        $('.product_popis_sc').hide();
        $('.currency_popis').show();
        $('.product_popis_span').show();
        $('#product_popis').val(product_popis);
    })
    $(".p_popis_save").click(function () {
        let product_popis_new = $('#product_popis').val();
        $('.edit_h_hide-small').addClass('edit-small');
        $('.edit-small').removeClass('edit_h_hide-small');
        $('#product_popis').hide();
        $('.product_popis_sc').hide();
        $('.product_popis_span').text(product_popis_new);
        $('#product_popis').attr('value', product_popis_new);
        $('.currency_popis').show();
        $('.product_popis_span').show();
        $('.product-popis-div').children(".saved-msg").animate({opacity: '0.8'});
        $('.product-popis-div').children(".saved-msg").css('height', '20px');
        setTimeout(function(){
            $('.product-popis-div').children(".saved-msg").animate({opacity: '0'});
            $('.product-popis-div').children(".saved-msg").animate({height: '0px'});
          }, 2000);
    })

    $(".add-akcia-btn").click(function () {
        $('.error-akcia').hide();
        $('.info-akcia').show();
    })

    $(".add-btn-cena").click(function () {
        $('.akcia-decision').hide();
        $('.akcia-percenta').hide();
        $('.akcia-cena').show();
        $('.akcia-edit').show();
    })

    $(".add-btn-percenta").click(function () {
        $('.akcia-decision').hide();
        $('.akcia-cena').hide();
        $('.akcia-percenta').show();
        $('.akcia-edit').show();
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