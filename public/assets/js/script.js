const imageInput = $("#image");
Dropzone.autoDiscover = false;

const currencyInput = $("input.currency");
const currencyFormat = (amount) => {
    return new Intl.NumberFormat("en-US", {
        style: "decimal",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(amount);
};

currencyInput.map((key, input) => (input.value = input.value ? currencyFormat(input.value) : null));

$("#purchase-price").change(function () {
    const sellingPrice = parseInt($(this).val()) * 1.3;
    $("#selling-price").val(currencyFormat(sellingPrice));

    $(`input[name="selling_price"]`).val(sellingPrice);
});

currencyInput.on("change", function () {
    const value = parseFloat(this.value.replaceAll(",", ""));
    this.value = currencyFormat(value);

    $(`input[name="${this.dataset.input}"]`).val(value);
});

const addImageFile = (file) => {
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    imageInput.prop("files", dataTransfer.files);
};

const dropzone = new Dropzone("#imageDropzone", {
    url: "/",
    maxFiles: 1,
    autoProcessQueue: false,
    acceptedFiles: "image/*",
    paramName: "image",
    addRemoveLinks: true,
    init: function () {
        this.on("addedfile", function (file) {
            addImageFile(file);
            $(".dz-remove").text($(".dz-filename span").text());
        });

        this.on("maxfilesexceeded", function (file) {
            this.removeAllFiles();
            this.addFile(file);

            addImageFile(file);
        });

        this.on("removedfile", function (file) {
            imageInput.prop("files", null);
        });
    },
});

const resetForm = () => {
    $("#form").trigger("reset");
    imageInput.val("");
};
