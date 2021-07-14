$(document).ready(function(){
    // CONFIG VARIABLE TO DETERMINE IF DEVELOPMENT ENVIROMENT IS LOCAL OR NOT 
    let root_url = "/fesicomp.eu"; //ON SERVER FILE THIS NEEDS TO BE EMPTY STRING
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };
    $('.search-box input[type="text"]').on("keyup input", debounce(function(){
        $( "#book" ).slideDown("slow");
        $('.result').css({display: 'block'});
        
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        console.log(root_url);
        if(inputVal.length){
            $.get(root_url+"/srengine", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
            $('.result').css({display: 'none'});
        }
    }, 500));
    $(document).mouseup(function(e) 
    {
    var container = $(".result");
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
    });
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});