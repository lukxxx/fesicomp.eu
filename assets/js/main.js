$(".add-c").submit(function (e) {
    e.preventDefault();
    var a_quant = $(this).children('.add-quant').val();
    var a_p_code = $(this).children('.add-pc').val();
    var go_to = root_url + '/addcart?quantity=' + a_quant + '&p_code=' + a_p_code;
    location.href = go_to;
});