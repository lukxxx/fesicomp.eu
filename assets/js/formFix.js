function OpravaTel(obj) {
    var pole = obj.value.replace(/\D/g, ''),
        char = {4:' ',7:' '};
    obj.value = '';
    for (var i = 0; i < pole.length; i++) {
        obj.value += (char[i]||'') + pole[i];
    }
}