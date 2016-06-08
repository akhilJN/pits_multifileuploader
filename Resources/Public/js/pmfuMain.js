        var formId;
        var classId = "input-id";
	var baseurl = document.getElementById("baseurl").value;

        //document.getElementById('formId').onsubmit = function(e) {
            //submitUpload(e);
        //};

        //basic settings *all inputs sean *specific id sean.
        //none of the below condition option to be done
        var actionAllInputflag = false; //flag to set all input[file] section to be changed oe any particular id
        if (actionAllInputflag === false) {
            var mentFor = "all";
            var inputs = document.querySelectorAll("input[type=file]");
            for (i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                if (inputs[i].getAttribute('required') === 'required') { //condition for single atribute as just "required to be writen" //
                    var required = true;
                } else {
                    var required = false;
                    var div = document.createElement('div');
                    div.setAttribute("id", "fine-uploader-manual-trigger-" + i);
                    div.innerHTML = ' ';
                    input.parentNode.replaceChild(div, input);
                    fineUploadBasicInitialize(i, mentFor, required);
                }
                // var div = document.createElement('div');
                // div.setAttribute("id", "fine-uploader-manual-trigger-" + i);
                // div.innerHTML = ' ';
                // input.parentNode.replaceChild(div, input);
                // fineUploadBasicInitialize(i, mentFor, required);
            }
        } else {
            var mentFor = "specific";
            // var selector = "id"; // selector can be either id or class... id implemented... class to be implemented
            var inputs = document.getElementById(classId);
            var input = inputs;
            if (input.getAttribute('required') === 'required') { //condition for single atribute as just "required" to be writen //
                var required = true;
            } else {
                var required = false;
            }
            var div = document.createElement('div');
            div.setAttribute("id", "fine-uploader-manual-trigger-" + classId);
            div.innerHTML = ' ';
            input.parentNode.replaceChild(div, input);
            fineUploadBasicInitialize(classId, mentFor, required);
        }


        function submitUpload(e) {
            e.preventDefault();
            var reqUpInp = document.getElementsByClassName("required-upload-input");
            for (i = 0; i < reqUpInp.length; i++) {
                if (reqUpInp[i].value === "") {
                    var validFlag = true;
                }
            }
            if (validFlag === true) {
                alert("Uploading not done. Please check the upload box.");
            } else {
                document.getElementById('formId').submit();
            }
        }


        function fineUploadBasicInitialize(i, mentFor, required) {
	    var baseurl = document.getElementById("baseurl").value;
            if (required === true) {
                var htmlInput = document.createElement("input");
                htmlInput.setAttribute("type", "text");
                htmlInput.setAttribute("id", "required-input-" + i);
                htmlInput.setAttribute("name", i);
                htmlInput.setAttribute("class", "required-upload-input");
                //document.getElementById('formId').appendChild(htmlInput);
            }

            var galleryUploader = new qq.FineUploader({
                element: document.getElementById('fine-uploader-manual-trigger-' + i),
                template: 'qq-template-gallery',
                request: {
                    endpoint: '/typo3v7/typo3conf/ext/pits_multifileuploader/Classes/UploadingClass/Endpoint.php'
                },
                thumbnails: {
                    placeholders: {
                        waitingPath: baseurl+'/typo3v7/typo3conf/ext/pits_multifileuploader/Resources/Public/placeholders/waiting-generic.png',
                        notAvailablePath: baseurl+'/typo3v7/typo3conf/ext/pits_multifileuploader/Resources/Public/placeholders/not_available-generic.png'
                    }
                },
                validation: {
                    allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
                    itemLimit: 5,
                    sizeLimit: 15000000
                },
                callbacks: {
                    onComplete: function(id, fileName, responseJSON) {
                        var hidenInput = document.getElementById("required-input-" + i);
                        if(hidenInput){
                          document.getElementById("required-input-" + i).value = i;
                        }
                        var statusMsg = document.getElementsByClassName("qq-upload-status-text");
                        for (i = 0; i < statusMsg.length; i++) {
                          statusMsg[i].innerHTML = "Uploaded";
                          statusMsg[i].style.display= "list-item";
                        }
                    }
                },
                cors: {
                    expected: true
                },
                resume: {
                    enabled: true
                },
                deleteFile: {
                    enabled: true,
                    method: "POST",
                    endpoint: "/pwc/test/php-traditional-server/endpoint.php"
                }
            });
        }

        //=========================ADVANCED SECTION NEXT VERSION====================================//

        //-------If basic settings falg is set goes to this section ------//

        // var ids = ["id1", "id2", "id3"];
        // ids.forEach(function(inputId) {
        //     var inputs = document.getElementById(inputId);
        //     var div = document.createElement('div');
        //     div.setAttribute("id", inputId)
        //     div.innerHTML = ' ';
        //     input.parentNode.replaceChild(div, inputs);
        //     fineUploadAdvancedInitialize(inputId);
        // });

        // ---------------------------------------------------------------------


        // function fineUploadAdvancedInitialize(inputId) {
        //     var manualUploader = new qq.FineUploader({
        //         element: document.getElementById(inputId),
        //         template: 'qq-template-manual-trigger',
        //         request: {
        //             endpoint: '/pwc/test/php-traditional-server/endpoint.php'
        //         },
        //         thumbnails: {
        //             placeholders: {
        //                 waitingPath: '/source/placeholders/waiting-generic.png',
        //                 notAvailablePath: '/source/placeholders/not_available-generic.png'
        //             }
        //         },
        //         autoUpload: false,
        //         debug: true
        //     });
        //
        //     qq(document.getElementById("trigger-upload")).attach("click", function() {
        //         manualUploader.uploadStoredFiles();
        //     });
        // }
        // ============================================================================================= //
