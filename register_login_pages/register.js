var imagepath;

function submitForm() {
    //parse input to see any errors

    var passwordvalue = document.getElementById("password").value;
    var confirmpasswordvalue = document.getElementById("confirmpassword").value;

    if (passwordvalue != confirmpasswordvalue) {
        alert("Password did not match!");
        return null;
    }

    var file = document.getElementById("selectfile").files.length;

    if (file == 0) {
        alert("Please pick a profile picture!");
        return null;
    }

    document.getElementById("submit").click();
}

function updateImagePath(element) {
    var selectedfile = element.files[0];
    console.log(selectedfile);

    var reader = new FileReader();
    var profileelement = document.getElementById("profile-image");

    reader.onload = function (event) {
        profileelement.src = event.target.result;
    };

    reader.readAsDataURL(selectedfile);
}

function selectPicture() {
    document.getElementById("selectfile").click();
}

function phoneFormat() {
    var phonelement = document.getElementById("phonenumber");
    var value = phonelement.value;

    if (value[0] != "0") {
        alert("Your phone number must start with 0");
        phonelement.value = "";
    }
    if (value.length != 10 && value.length != 11) {
        alert("Your phone number must either be 10 or 11 digits!");
        phonelement.value = "";
    }
}

function emailVerifier() {
    var emailelement = document.getElementById("email");
    var matchedstring = emailelement.value.match(
        /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g
    );

    if (matchedstring == null) {
        alert("Incorrect email format! Please try again");
        emailelement.value = "";
    } else {
    }
}
