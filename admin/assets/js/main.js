$(document).ready(function () {
    $('.download-btn').hover(

        function () {
            $(this).children('.edit_k').fadeIn("fast");
        },

        function () {
            $(this).children('.edit_k').fadeOut();
        }
    );
    $(".prod-srch").keyup( function () {
        let ikonka = $('.hladacik');
        if($(this).val() != null || $(this).val() != ""){
            ikonka.removeClass('fa-search');
            ikonka.addClass('fa-times');
        }
        if($(this).val() == null || $(this).val() == ""){
            ikonka.removeClass('fa-times');
            ikonka.addClass('fa-search');
        }
    });
    $(".hladacik").click( function () {
        $('.prod-srch').val('');  
        console.log('clicked');
    });
});
function updateURLParameter(url, param, paramVal)
{
    var TheAnchor = null;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";

    if (additionalURL) 
    {
        var tmpAnchor = additionalURL.split("#");
        var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];
        if(TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i=0; i<tempArray.length; i++)
        {
            if(tempArray[i].split('=')[0] != param)
            {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }        
    }
    else
    {
        var tmpAnchor = baseURL.split("#");
        var TheParams = tmpAnchor[0];
            TheAnchor  = tmpAnchor[1];

        if(TheParams)
            baseURL = TheParams;
    }

    if(TheAnchor)
        paramVal += "#" + TheAnchor;

    var rows_txt = temp + "" + param + "=" + paramVal;
    window.location = baseURL + "?" + newAdditionalURL + rows_txt;
}