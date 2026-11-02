
$(document).ready(function () {

    $(document).on('submit', 'form[data-ajax="true"]', function (e) {
        e.preventDefault();

        const form = $(this);
        const formElement = this;
        const button = form.find('[type="submit"]');

        // Prevent duplicate submissions
        if (form.data('isSubmitting')) {
            return false;
        }

        // Validate form first
        if (!formElement.checkValidity()) {
            formElement.reportValidity();
            return false;
        }

        // Confirmation only when data-confirm is present
        const confirmMessage = button.first().data('confirm');

        if (confirmMessage) {
            Notify.warning(confirmMessage, {
                heading: 'Are you sure?',
                autoClose: 0,
                showCancel: true,
                confirmText: 'Yes',
                cancelText: 'No',

                onConfirm: function () {
                    submitAjaxForm(form, formElement, button);
                },

                onCancel: function () {
                    // Cancelled, do nothing
                }
            });

            return;
        }

        submitAjaxForm(form, formElement, button);
    });

    function submitAjaxForm(form, formElement, button) {

        if (form.data('isSubmitting')) {
            return;
        }

        const url = form.attr('action') || window.location.href;
        const method = (form.attr('method') || 'POST').toUpperCase();
        const originalHtml = button.html();

        form.data('isSubmitting', true);

        button.prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm me-2"></span>Please wait...'
        );

        function unlockForm() {
            form.data('isSubmitting', false);
            button.prop('disabled', false).html(originalHtml);
        }

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                response = response || {};

                updateCsrfToken(form, response);

                const success =
                    response.status === true ||
                    response.status === 'success';

                showNotify(
                    success ? 'success' : 'error',
                    response.message || (
                        success
                            ? 'Request completed successfully.'
                            : 'Something went wrong.'
                    ),
                    response.heading || (
                        success ? 'Success' : 'Error'
                    )
                );

                if (success) {

                    if (
                        response.reset === true ||
                        form.attr('data-reset') === 'true'
                    ) {
                        formElement.reset();
                    }

                    if (response.redirect) {
                        setTimeout(function () {

                            if (response.target === '_blank') {
                                unlockForm();

                                const newTab = window.open(
                                    response.redirect,
                                    '_blank'
                                );

                                if (newTab) {
                                    newTab.opener = null;
                                }
                            } else {
                                window.location.href = response.redirect;
                            }

                        }, Math.max(
                            0,
                            Number(response.redirect_time ?? 1000)
                        ));

                        return;
                    }
                }

                unlockForm();
            },

            error: function (xhr) {
                let response = xhr.responseJSON || {};

                if (!xhr.responseJSON && xhr.responseText) {
                    try {
                        response = JSON.parse(xhr.responseText);
                    } catch (e) {
                        response = {};
                    }
                }

                updateCsrfToken(form, response);

                console.error('AJAX Error:', xhr.status, xhr.responseText);

                showNotify(
                    'error',
                    response.message ||
                    'Server error (' + xhr.status + ').',
                    response.heading || 'Error'
                );

                unlockForm();
            }
        });
    }

    function updateCsrfToken(form, response) {
        if (
            response &&
            response.csrf &&
            response.csrf.name &&
            response.csrf.hash
        ) {
            let input = form.find(
                'input[name="' + response.csrf.name + '"]'
            );

            if (input.length) {
                input.val(response.csrf.hash);
            } else {
                $('<input>', {
                    type: 'hidden',
                    name: response.csrf.name,
                    value: response.csrf.hash
                }).appendTo(form);
            }
        }
    }

    function showNotify(type, message, heading) {
        if (
            typeof Notify !== 'undefined' &&
            typeof Notify[type] === 'function'
        ) {
            Notify[type](message, {
                heading: heading
            });
        } else {
            alert(heading + ': ' + message);
        }
    }

});


// User ID verification
$(window).on('load', function () {

    function loadUser() {
        const input = $('#user_id');

        if (!input.length) {
            return;
        }

        const user_id = (input.val() || '').trim();

        if (!user_id) {
            $('#user_message').empty();
            return;
        }

        $.ajax({
            url: 'get-user',
            type: 'POST',
            dataType: 'json',
            data: {
                user_id: user_id
            },

            success: function (res) {
                $('#user_message').empty().append(
                    $('<span>')
                        .addClass(
                            res.status ? 'text-success' : 'text-danger'
                        )
                        .text(res.message || '')
                );
            },

            error: function () {
                $('#user_message').text('Something went wrong!');
            }
        });
    }

    loadUser();

    $(document).on('input', '#user_id', loadUser);

});
