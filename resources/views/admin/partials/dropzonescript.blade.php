<script>

    Dropzone.options.brandPicDropzone = {

        init: function() {
            var self = this;
            this.on('sending', function(file, xhr, formData) {
                formData.append('_token', helper.getCSRFToken());
            });
            this.on('success', function(file, response) {
                helper.appendHiddenFieldToForm('brand-create', 'brand-image', 'image_path', response);
            });
            this.on('addedFile', function(file) {
                self.removeAllFiles();
            });
        },

        headers: {'X-Requested-With': 'XMLHttpRequest'},

        thumbnailWith: 200

    }

    var helper = {
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
</script>