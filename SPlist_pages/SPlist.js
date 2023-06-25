function selectSP(SPID) {
    alert(SPID);
    document.getElementById("deliveryDate").value =
        document.getElementById("dateselect").value;
    document.getElementById("deliveryTime").value =
        document.getElementById("timeselect").value;

    document.getElementById("selectedSP").value = SPID;
    document.getElementById("submit").click();
}

function selectTypeOfDelivery(item) {
    if (item == "walkin") {
        document.getElementById("walkin").style.backgroundColor = "#1957ab";
        document.getElementById("deliver").style.backgroundColor = "#f0efef";
        document.getElementById("walkin").style.color = "white";
        document.getElementById("deliver").style.color = "#808080";
    } else {
        document.getElementById("walkin").style.backgroundColor = "#f0efef";
        document.getElementById("deliver").style.backgroundColor = "#1957ab";
        document.getElementById("walkin").style.color = "#808080";
        document.getElementById("deliver").style.color = "white";
    }
    document.getElementById("typeOfDelivery").value = item;
}
