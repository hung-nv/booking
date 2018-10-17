export {
    getBase64,
    initInputImage,
    initInputMultiImage,
    newInputImage,
    newInputMultiImage
};

declare let $;

/**
 *
 * @param file
 * @return {Promise<any>}
 */
function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

/**
 * New input image preview.
 * @param inputImage
 */
function newInputImage(inputImage) {
    $(inputImage).fileinput({
        allowedFileExtensions: ["jpg", "png"],
        browseLabel: "Select Image",
        showCaption: false,
        autoReplace: true,
        maxFileCount: 1,
        maxFileSize: 1024,
        showClose: false
    });
}

/**
 * New input multi image preview.
 * @param inputImage
 */
function newInputMultiImage(inputImage) {
    $(inputImage).fileinput({
        allowedFileExtensions: ["jpg", "png"],
        browseLabel: "Select Image",
        maxFileSize: 1048,
        maxFilePreviewSize: 10240,
        uploadUrl: '/file-upload',
        showCaption: false,
        showUpload: false,
        initialPreviewConfig: [],
        fileActionSettings: {
            "showUpload": false,
        }
    });
}

/**
 * Init input image preview.
 * @param oldImage: id of element old image.
 * @param newInputImage: id of element input to init image preview.
 * @param urlDelete: url submit delete file.
 * @param option: extractName and maxSize config.
 */
function initInputImage(oldImage, newInputImage, urlDelete, option: any = {}) {
    let url, pathname, imgUrl, oldImageValue, port;

    port = '';
    url = window.location;
    if (url.port) {
        port = ':' + url.port
    }

    // check input length.
    if (!$(oldImage).length || !$(newInputImage).length) {
        return;
    }

    oldImageValue = $(oldImage).val();

    // get image url.
    if (oldImageValue !== undefined && oldImageValue !== '') {
        imgUrl = url.protocol + '//' + url.hostname + port + oldImageValue;

        pathname = oldImageValue.replace(/^.*[\\\/]/, '');
    }

    if (typeof option.extractName === "undefined") {
        option.extractName = null;
    }

    if (typeof option.maxSize === "undefined") {
        option.maxSize = 1024;
    }

    $(newInputImage).fileinput({
        allowedFileExtensions: ["jpg", "png"],
        browseLabel: "Select Image",
        showCaption: false,
        autoReplace: true,
        maxFileCount: 1,
        maxFileSize: option.maxSize,
        uploadAsync: false,
        initialPreview: [
            imgUrl
        ],
        showClose: false,
        initialPreviewAsData: true,
        initialPreviewFileType: 'image',
        initialPreviewConfig: [
            {
                caption: pathname,
                width: "120px",
                downloadUrl: false,
                key: $(oldImage).data('id'),
                extra: {name: option.extractName}
            }
        ],
        deleteUrl: urlDelete,
        purifyHtml: true
    });
}

/**
 * Init input multi image preview.
 * @param oldImage
 * @param newInputImage
 * @param urlDelete
 * @param option
 */
function initInputMultiImage(oldImage, newInputImage, urlDelete, option: any = {}) {
    let imgName, imgObject, oldImageValue, imgPreview = [], imgPreviewConfig = [];

    // check input length.
    if (!$(oldImage).length || !$(newInputImage).length) {
        return;
    }

    oldImageValue = $(oldImage).val();

    if (oldImageValue !== undefined && oldImageValue !== '') {
        // set array imgPreview and array previewConfig
        $.each(oldImageValue.split('|'), function (index, img) {
            imgObject = img.split(':'); // filename.jpg|id

            if (imgObject.length) {
                // push imageUrl to array of image preview.
                imgPreview.push(imgObject[0]);
                // get image name.
                imgName = imgObject[0].replace(/^.*[\\\/]/, '');
                // set image config.
                imgPreviewConfig.push({caption: imgName, width: "120px", downloadUrl: false, key: imgObject[1]});
            }
        });
    }

    if (typeof option.maxSize === "undefined") {
        // set default maxSize.
        option.maxSize = 1024;
    }

    if (typeof option.maxFile === "undefined") {
        // set default maxSize.
        option.maxFile = 6;
    }

    $(newInputImage).fileinput({
        uploadUrl: '/file-upload',
        allowedFileExtensions: ["jpg", "png"],
        browseLabel: "Select Image",
        showCaption: false,
        overwriteInitial: false,
        maxFileCount: option.maxFile,
        maxFileSize: option.maxSize,
        initialPreview: imgPreview,
        showClose: false,
        initialPreviewAsData: true,
        showUpload: false,
        initialPreviewFileType: 'image',
        initialPreviewConfig: imgPreviewConfig,
        deleteUrl: urlDelete,
        fileActionSettings: {
            "showUpload": false,
        },
        purifyHtml: true
    });
}
