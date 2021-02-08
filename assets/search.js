$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        $( "#book" ).slideDown("slow");
        $('.result').css({display: 'block'});
        
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
            $('.result').css({display: 'none'});
        }
    });
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