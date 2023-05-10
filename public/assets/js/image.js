function previewImage(event) {
    const file = event.target.files[0];
    const errorElement = document.getElementById("main-image-error");
    const errorTipe = document.getElementById("tipe-main-image");
    const errorSize = document.getElementById("size-main-image");
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    const Width = 1920;
    const Height = 1080;

    var input = event.target;
    if (!allowedTypes.includes(file.type)) {
        errorTipe.textContent = "Silakan upload file dengan ekstensi .jpeg/.jpg/.png";
        event.target.value = null;
        document.getElementById("preview-container").style.display = "none";
        errorTipe.style.display = "block";
    }
    else if (file.size > 5000000) {
        errorElement.textContent = "File size is too large. Maximum file size is 5 MB.";
        event.target.value = null; // Reset the file input
        var reader = new FileReader();
        document.getElementById("preview-container").style.display = "none";
        errorElement.style.display = "block";
    }
    else if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.onload = function () {
                if (img.width > Width || img.height > Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 1920 x 1080.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else if (img.width < Width || img.height < Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 1920 x 1080.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else {
                    var preview = document.getElementById("preview");
                    preview.src = e.target.result;
                    document.getElementById("preview-container").style.display = "block";
                    errorElement.style.display = "none";
                    errorTipe.style.display = "none";
                    errorSize.style.display = "none";
                }
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}


function previewMobileImage(event) {
    const file = event.target.files[0];
    const errorElement = document.getElementById("mobile-image-error");
    const errorTipe = document.getElementById("tipe-mobile-image");
    const errorSize = document.getElementById("size-mobile-image");
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    const Width = 360;
    const Height = 640;
    var input = event.target;

    if (!allowedTypes.includes(file.type)) {
        errorTipe.textContent = "Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png";
        event.target.value = null;
        document.getElementById("mobile-preview-container").style.display = "none";
        errorTipe.style.display = "block";
    }
    else if (file.size > 5000000) {
        errorElement.textContent = "File size is too large. Maximum file size is 5 MB.";
        event.target.value = null; // Reset the file input
        var reader = new FileReader();
        document.getElementById("mobile-preview-container").style.display = "none";
        errorElement.style.display = "block";
    } else if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.onload = function () {
                if (img.width > Width || img.height > Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 360 x 640.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("mobile-preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else if (img.width < Width || img.height < Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 360 x 640.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("mobile_preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else { 
                    var preview = document.getElementById("mobile_preview");
                    preview.src = e.target.result;
                    document.getElementById("mobile-preview-container").style.display = "block";
                    errorElement.style.display = "none";
                    errorTipe.style.display = "none";
                    errorSize.style.display = "none";
                }
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewSample1(event) {
    const file = event.target.files[0];
    const errorElement = document.getElementById("sample-image-1-error");
    const errorTipe = document.getElementById("tipe-sample-image-1");
    const errorSize = document.getElementById("size-sample-image-1");
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    const Width = 1920;
    const Height = 1080;
    var input = event.target;

    if (!allowedTypes.includes(file.type)) {
        errorTipe.textContent = "Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png";
        event.target.value = null;
        document.getElementById("sample1-preview-container").style.display = "none";
        errorTipe.style.display = "block";
    }
    else if (file.size > 5000000) {
        errorElement.textContent = "File size is too large. Maximum file size is 5 MB.";
        event.target.value = null; // Reset the file input
        var reader = new FileReader();
        document.getElementById("sample1-preview-container").style.display = "none";
        errorElement.style.display = "block";
    } else if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.onload = function () {
                if (img.width > Width || img.height > Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 1920 x 1080.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("sample1-preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else if (img.width < Width || img.height < Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 1920 x 1080.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("sample1_preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else { 
                    var preview = document.getElementById("sample1_preview");
                    preview.src = e.target.result;
                    document.getElementById("sample1-preview-container").style.display = "block";
                    errorElement.style.display = "none";
                    errorTipe.style.display = "none";
                    errorSize.style.display = "none";
                }
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewSample2(event) {
    const file = event.target.files[0];
    const errorElement = document.getElementById("sample-image-2-error");
    const errorTipe = document.getElementById("tipe-sample-image-2");
    const errorSize = document.getElementById("size-sample-image-2");
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    const Width = 360;
    const Height = 640;
    var input = event.target;

    if (!allowedTypes.includes(file.type)) {
        errorTipe.textContent = "Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png";
        event.target.value = null;
        document.getElementById("sample2-preview-container").style.display = "none";
        errorTipe.style.display = "block";
    }
    else if (file.size > 5000000) {
        errorElement.textContent = "File size is too large. Maximum file size is 5 MB.";
        event.target.value = null; // Reset the file input
        var reader = new FileReader();
        document.getElementById("sample2-preview-container").style.display = "none";
        errorElement.style.display = "block";
    } else if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.onload = function () {
                if (img.width > Width || img.height > Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 360 x 640.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("sample2-preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else if (img.width < Width || img.height < Height) {
                    errorSize.textContent = "Silahkan upload file dengan resolusi 360 x 640.";
                    event.target.value = null; // Reset the file input
                    document.getElementById("sample2_preview-container").style.display = "none";
                    errorSize.style.display = "block";
                }
                else { 
                    var preview = document.getElementById("sample2_preview");
                    preview.src = e.target.result;
                    document.getElementById("sample2-preview-container").style.display = "block";
                    errorElement.style.display = "none";
                    errorTipe.style.display = "none";
                    errorSize.style.display = "none";
                }
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}