;
(function (w) {

    var d = w.document;

    function AjaxContactForm(formEl) {
        this.formEl = formEl;
        this.errorBox = null;
    }

    AjaxContactForm.prototype = {

        init: function () {
            var reset = d.getElementById('cf-reset');
            reset.addEventListener('click', this.formReset.bind(this), false);
            this.formEl.onsubmit = this.handleSubmit.bind(this);
            this.setupErrorBox();

        },

        sendForm: function () {
            var fd = new w.FormData(this.formEl);
            var req = new w.XMLHttpRequest();
            var self = this;
            self.clearErrors();
            req.open('POST', this.formEl.getAttribute('action'), true);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.onreadystatechange = function (ev) {
                if (req.readyState == 4) {
                    if (req.status == 200) {
                        self.showSuccess();
                    } else {
                        self.failResponse(req.status);
                    }
                }
            }
            req.send(fd);
            return false;
        },

        handleSubmit: function (ev) {
            if (!w.FormData) return true;
            ev.preventDefault();
            this.sendForm();
            return false;
        },

        showSuccess: function() {
            this.formEl.className += ' closed';
        },

        failResponse: function(status) {
            if(status >= 500) {
                this.showErrorMessage('Sorry! There was a problem on our side. Please try again later');
                return;
            }

            if(status === 422) {
                this.showErrorMessage('There was a problem with your input. Please check and try again. All fields are required');
                return;
            }

            this.showErrorMessage('Oops! Something went wrong. Sorry. Please try again.');

        },

        formReset: function() {
            this.formEl.reset();
            this.formEl.className = 'contact-omashu-form';
        },

        setupErrorBox: function() {
            var box = d.createElement('div');
            box.setAttribute('class', 'cf-error-box');
            this.errorBox = this.formEl.insertBefore(box, this.formEl.firstChild);
        },

        showErrorMessage: function(message) {
            this.errorBox.innerHTML += "<p>"+message+"</p>";
        },

        clearErrors: function() {
            this.errorBox.innerHTML = '';
        }
    }

    w.AjaxContactForm = AjaxContactForm;
}(window))