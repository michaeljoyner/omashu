;(function(window){

    function DropzoneManager(myDropzone, formId, inputId, inputName, previewId) {
        this.myDropzone = myDropzone;
        this.formId = formId;
        this.inputName = inputName;
        this.inputId = inputId;
        this.previewId = previewId;
    }

    DropzoneManager.prototype = {

        init: function() {
            selfish = this;
            window.Dropzone.options[this.myDropzone] = {
            init: function() {
                var self = this;
                    this.on('sending', function(file, xhr, formData) {
                        formData.append('_token', selfish.helper.getCSRFToken());
                    });
                    this.on('success', function(file, response) {
                        selfish.helper.appendHiddenFieldToForm(selfish.formId, selfish.inputId, selfish.inputName, response);
                    });
                    this.on('addedfile', function(file) {
                        var previews = window.document.querySelectorAll('.dz-preview');
                        for(var i = 0; i < previews.length - 1; i++) {
                            previews[i].parentNode.removeChild(previews[i]);
                        }
                    });
                },

                headers: {'X-Requested-With': 'XMLHttpRequest'},

                thumbnailWidth: 300,
                thumbnailHeight: null,
                dictDefaultMessage: 'Drag files or click here to upload',
                previewsContainer: '#'+selfish.previewId

            }
        },

        helper: {
            getCSRFToken: function() {
                var metas = document.getElementsByTagName('meta');
                var i = 0, l = metas.length;
                for(i;i<l;i++) {
                    if(metas[i].getAttribute("property") == 'CSRF-token') {
                        return metas[i].getAttribute("content");
                    }
                }
                return "";
            },

            appendHiddenFieldToForm: function(formID, inputId, inputName, inputValue) {
                var form = document.getElementById(formID);
                var hiddenInput;
                if(form.querySelector('#'+ inputId)) {
                    hiddenInput = form.querySelector('#'+ inputId);
                    hiddenInput.setAttribute('value', inputValue);
                    return;
                }
                hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');

                hiddenInput.setAttribute('id', inputId);
                hiddenInput.setAttribute('name', inputName);
                hiddenInput.setAttribute('value', inputValue);
                form.appendChild(hiddenInput);
                return;
            }
        }
    }

    window.DropzoneManager = DropzoneManager;

}(window));