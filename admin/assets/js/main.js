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
            $('.edit_pc').fadeIn();
        },

        function () {
            $('.edit_pc').fadeOut();
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