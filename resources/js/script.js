let cropper = null;
let currentInput = null;
let currentOptions = null;

function initImageCropper(options) {

    const input = document.querySelector(options.input);
    if (!input) return;

    input.addEventListener("change", function (e) {

        const file = e.target.files[0];

        if (!file) return;

        currentInput = input;
        currentOptions = options;

        const reader = new FileReader();

        reader.onload = function (event) {

            const modal = document.getElementById("cropModal");
            const image = document.getElementById("cropImage");

            image.src = event.target.result;

            modal.classList.remove("hidden");

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(image, {
                aspectRatio: options.aspectRatio,
                viewMode: 1,
                autoCropArea: 1,
                responsive: true,
            });

        };

        reader.readAsDataURL(file);

    });

}

const cropSaveBtn = document.getElementById("cropSave");
if (cropSaveBtn) {
    cropSaveBtn.addEventListener("click", function () {

        if (!cropper) return;

        cropper.getCroppedCanvas({
            width: currentOptions.width,
            height: currentOptions.height,
        }).toBlob(function (blob) {

            const file = new File(
                [blob],
                "cropped.png",
                { type: "image/png" }
            );

            const dt = new DataTransfer();
            dt.items.add(file);

            currentInput.files = dt.files;

            cropper.destroy();
            cropper = null;

            document.getElementById("cropModal").classList.add("hidden");

        });

    });
}

const cancelCropBtn = document.getElementById("cancelCrop");
if (cancelCropBtn) {
    cancelCropBtn.addEventListener("click", function () {

        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        currentInput.value = "";

        document.getElementById("cropModal").classList.add("hidden");

    });
}

// Initialize image croppers
initImageCropper({
    input: "#site_logo",
    aspectRatio: 3,
    width: 900,
    height: 300,
});

initImageCropper({
    input: "#site_favicon",
    aspectRatio: 1,
    width: 64,
    height: 64,
});