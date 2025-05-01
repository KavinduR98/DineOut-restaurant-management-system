console.log("concession_create.js");

Dropzone.autoDiscover = false;

const previewTemplate = `
<div class="dz-preview dz-file-preview custom-preview">
    <div class="dz-image-container">
        <div class="dz-image">
            <img data-dz-thumbnail />
        </div>
    </div>
</div>
`;


var dropzoneSingle = undefined;
$(document).ready(function () {
    // Single files
    dropzoneSingle = new Dropzone("#dropzone_single", {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png",
        dictDefaultMessage: 'Drop file to upload <span>or CLICK</span> (File formats: jpeg,jpg,png)',
        autoProcessQueue: false,
        addRemoveLinks: true,
        previewTemplate: previewTemplate, // Use custom layout
        selectedImage: undefined,
        imageIcon: undefined,
        status: "new",
        init: function () {
            this.on('addedfile', function (file) {
                console.log(file);
                this.selectedImage = file;

                const reader = new FileReader();
                reader.onload = () => {
                    const size = 40;
                    const base64 = reader.result; // This is the Data URL of the uploaded file
                    const image = new Image();
                    image.crossOrigin = 'anonymous';
                    image.src = base64;
                    image.onload = () => {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        canvas.height = size;
                        canvas.width = size;
                        ctx.drawImage(image, 0, 0, size, size);
                        const dataUrl = canvas.toDataURL();
                        this.imageIcon = dataUrl;

                    }
                };

                if (file.name != 'image') {
                    reader.readAsDataURL(file);
                }

                if (this.fileTracker) {
                    this.removeFile(this.fileTracker);
                }
                this.fileTracker = file;
            });
            this.on('removedfile', function (file) {
                this.status = "new";
                // this.selectedImage = undefined;
            });
            this.on("success", function (file, responseText) {
                console.log(responseText); // console should show the ID you pointed to
            });
            this.on("complete", function (file) {

                this.removeAllFiles(true);
                console.log(file);
            });
            this.on('getSelectedImage', function () {
                return "file"
            });
        }
    });


    $('#save_concession_form').submit(function (e) {
        e.preventDefault();

        if($('#btnsave').text().trim()=='Save'){
            saveConcession();
        }
        else{
            updateConcession();
        }
        
    });

});


function saveConcession(){
    alert("save");

    var formData = new FormData();

    formData.append('name', $('#txtName').val());
    formData.append('description', $('#txtDescription').val());
    formData.append('price', $('#txtPrice').val());

    formData.append('file', dropzoneSingle.selectedImage);
    formData.append('imageIcon', dropzoneSingle.imageIcon);
    formData.append("image_status", dropzoneSingle.status);

    $.ajax({
        type: "POST",
        url: '/save_concession',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);

            setTimeout(function () {
                location.href = '/get_all_concessions';
            }, 2000);

        },
        error: function (error) {
        },
        complete: function () {
        }

    });
}


function updateConcession(){
    alert("update");
}