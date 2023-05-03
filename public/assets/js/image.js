function previewImage(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = document.getElementById("preview");
            preview.src = e.target.result;
            document.getElementById("preview-container").style.display = "block";
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewMobileImage(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = document.getElementById("mobile_preview");
            preview.src = e.target.result;
            document.getElementById("mobile-preview-container").style.display = "block";
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewSample1(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = document.getElementById("sample1_preview");
            preview.src = e.target.result;
            document.getElementById("sample1-preview-container").style.display = "block";
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewSample2(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = document.getElementById("sample2_preview");
            preview.src = e.target.result;
            document.getElementById("sample2-preview-container").style.display = "block";
        }
        reader.readAsDataURL(input.files[0]);
    }
}