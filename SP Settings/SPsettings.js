function formatter(id) {
    var element = document.getElementById(id);

    var elementvalue = parseFloat(element.value).toFixed(2);

    element.value = elementvalue;
}
