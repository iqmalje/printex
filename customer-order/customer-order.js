var dropdownshown = false;
var totalpage = 0;

function showDropdown() {
    if (!dropdownshown) {
        document.getElementById("dropdownmenu").className = "dropdownmenu show";
    } else document.getElementById("dropdownmenu").className = "dropdownmenu";

    dropdownshown = !dropdownshown;
}

function selectFile() {
    document.getElementById("selectedfile").click();
}

function openSettingsPage() {
    document.getElementById("settingsubmit").click();
}

function setFileDetails(element) {
    var selectedfile = element.files[0];

    document.getElementById("filename").innerHTML = selectedfile.name;
    console.log(selectedfile);

    var reader = new FileReader();

    reader.onloadend = function () {
        var count = reader.result.match(/\/Type[\s]*\/Page[^s]/g).length;
        console.log("Number of Pages:", count);
        document.getElementById("totalpage").value = count;
        document.getElementById("totalpages").innerHTML = count;
        document.getElementById("uploadfile").innerHTML = selectedfile.name;
        document.getElementById("uploadfile").style.color = "black";

        var totalprice = count * 0.1;
        document.getElementById("totalprice").innerHTML = totalprice.toFixed(2);
        var totalprice_servicefee = totalprice + 0.2;
        document.getElementById(
            "totalpricefee"
        ).innerHTML = `RM${totalprice_servicefee.toFixed(2)}`;
        document.getElementById("price").value = totalprice_servicefee;
    };

    reader.readAsBinaryString(selectedfile);
}

/*
    <td class="title-order">Printing color:</td>
                                <td class="details-order" id="filecolor">Black & White</td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing side:</td>
                                <td class="details-order" id="fileside">Single</td>
                            </tr>
                            <tr>
                                <td class="title-order">Pages per sheet:</td>
                                <td class="details-order" id="filepagepersheet">1 in 1</td>
                            </tr>
                            <tr>
                                <td class="title-order">Printing layout:</td>
                                <td class="details-order" id="filelayout">Portrait</td>
                            </tr>
                            <tr>
                                <td class="title-order">Copies:</td>
                                <td class="details-order" id="filecopies">x 1</td>
                            </tr>
                            <tr>
                                <td class="title-order">Paper size</td>
                                <td class="details-order" id="filesize">A4</td>
*/

function setPrintingColor(setting) {
    color = setting;

    if (setting == "BW") {
        document.getElementById("BW").className = "grid-order a1 selected";
        document.getElementById("color").className = "grid-order a2";
        document.getElementById("filecolor").innerHTML = "Black & White";
    } else {
        document.getElementById("BW").className = "grid-order a1";
        document.getElementById("color").className = "grid-order a2 selected";
        document.getElementById("filecolor").innerHTML = "Color";
    }

    document.getElementById("selectcolor").value = setting;
}

function setPrintingSide(setting) {
    printside = setting;
    if (setting == "single") {
        document.getElementById("single").className = "grid-order b1 selected";
        document.getElementById("duplex").className = "grid-order b2";
        document.getElementById("fileside").innerHTML = "Single";
    } else {
        document.getElementById("single").className = "grid-order b1";
        document.getElementById("duplex").className = "grid-order b2 selected";
        document.getElementById("fileside").innerHTML = "Duplex";
    }
    document.getElementById("selectside").value = setting;
}

function setPagePerSheet(setting) {
    pagepersheet = setting;
    console.log(setting);
    if (setting == "1 in 1") {
        document.getElementById("1in1").className = "grid-order c1 selected";
        document.getElementById("2in1").className = "grid-order c2";
        document.getElementById("4in1").className = "grid-order c3";
        document.getElementById("6in1").className = "grid-order c4";
        document.getElementById("filepagepersheet").innerHTML = "1 in 1";
    } else if (setting == "2 in 1") {
        document.getElementById("1in1").className = "grid-order c1";
        document.getElementById("2in1").className = "grid-order c2 selected";
        document.getElementById("4in1").className = "grid-order c3";
        document.getElementById("6in1").className = "grid-order c4";
        document.getElementById("filepagepersheet").innerHTML = "2 in 1";
    } else if (setting == "4 in 1") {
        document.getElementById("1in1").className = "grid-order c1";
        document.getElementById("2in1").className = "grid-order c2";
        document.getElementById("4in1").className = "grid-order c3 selected";
        document.getElementById("6in1").className = "grid-order c4";
        document.getElementById("filepagepersheet").innerHTML = "4 in 1";
    } else {
        document.getElementById("1in1").className = "grid-order c1";
        document.getElementById("2in1").className = "grid-order c2";
        document.getElementById("4in1").className = "grid-order c3";
        document.getElementById("6in1").className = "grid-order c4 selected";
        document.getElementById("filepagepersheet").innerHTML = "6 in 1";
    }
    document.getElementById("selectpagepersheet").value = setting;
}

function setPrintingLayout(setting) {
    layout = setting;
    if (setting == "portrait") {
        document.getElementById("portrait").className =
            "grid-order d1 selected";
        document.getElementById("landscape").className = "grid-order d2";
        document.getElementById("filelayout").innerHTML = "Portrait";
    } else {
        document.getElementById("portrait").className = "grid-order d1";
        document.getElementById("landscape").className =
            "grid-order d2 selected";
        document.getElementById("filelayout").innerHTML = "Landscape";
    }
    document.getElementById("selectlayout").value = setting;
}

function setCopies(element) {
    console.log(element.value);
    document.getElementById("filecopies").innerHTML = `x ${element.value}`;
    document.getElementById("selectcopies").value = element.value;
}

function setPaperSize(element) {
    document.getElementById("filesize").innerHTML = element.value;
    document.getElementById("selectsize").value = element.value;
}

function submit() {
    document.getElementById("remark").value =
        document.getElementById("text-remark").value;

    document.getElementById("submit").click();
}

function redirectToSPLIST() {
    window.location.href =
        "http://localhost/printex/SPlist_pages/SPlist-order.php";
}
