var color, printside, pagepersheet, layout, copies, size;

function setPrintingColor(setting) {
    color = setting;

    if (setting == "BW") {
        document.getElementById("BW").className = "grid-order a1 selected";
        document.getElementById("color").className = "grid-order a2";
    } else {
        document.getElementById("BW").className = "grid-order a1";
        document.getElementById("color").className = "grid-order a2 selected";
    }
}

function setPrintingSide(setting) {
    printside = setting;
    if (setting == "single") {
        document.getElementById("single").className = "grid-order b1 selected";
        document.getElementById("duplex").className = "grid-order b2";
    } else {
        document.getElementById("single").className = "grid-order b1";
        document.getElementById("duplex").className = "grid-order b2 selected";
    }
}

function setPagePerSheet(setting) {
    pagepersheet = setting;
    console.log(setting);
    if (setting == "1 in 1") {
        document.getElementById("1in1").className = "grid-order c1 selected";
        document.getElementById("2in1").className = "grid-order c2";
        document.getElementById("4in1").className = "grid-order c3";
        document.getElementById("6in1").className = "grid-order c4";
    } else if (setting == "2 in 1") {
        document.getElementById("1in1").className = "grid-order c1";
        document.getElementById("2in1").className = "grid-order c2 selected";
        document.getElementById("4in1").className = "grid-order c3";
        document.getElementById("6in1").className = "grid-order c4";
    } else if (setting == "4 in 1") {
        document.getElementById("1in1").className = "grid-order c1";
        document.getElementById("2in1").className = "grid-order c2";
        document.getElementById("4in1").className = "grid-order c3 selected";
        document.getElementById("6in1").className = "grid-order c4";
    } else {
        document.getElementById("1in1").className = "grid-order c1";
        document.getElementById("2in1").className = "grid-order c2";
        document.getElementById("4in1").className = "grid-order c3";
        document.getElementById("6in1").className = "grid-order c4 selected";
    }
}

function setPrintingLayout(setting) {
    layout = setting;
    if (setting == "portrait") {
        document.getElementById("portrait").className =
            "grid-order d1 selected";
        document.getElementById("landscape").className = "grid-order d2";
    } else {
        document.getElementById("portrait").className = "grid-order d1";
        document.getElementById("landscape").className =
            "grid-order d2 selected";
    }
}

function submit() {
    copies = document.getElementById("text-copies").value;
    size = document.getElementById("text-papersize").value;
    console.log(
        `${color} ${printside} ${pagepersheet} ${layout} ${copies} ${size}`
    );
}
