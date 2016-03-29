Ladda.bind('input[type=submit]', {timeout: 10000});

// Bind normal buttons
Ladda.bind('.ladda-button', {timeout: 10000});

// Bind progress buttons and simulate loading progress
Ladda.bind('.ladda-button', {
    callback: function (instance) {
        var progress = 0;
        var interval = setInterval(function () {
            progress = Math.min(progress + Math.random() * 0.1, 1);
            instance.setProgress(progress);

            if (progress === 1) {
                instance.stop();
                clearInterval(interval);
            }
        }, 200);
    }
});

$(document).ready(function () {

    var form = $('#registration');

    form.submit(function (e) {
        e.preventDefault();

        $.ajax({
                url: form.attr('action'),
                type: "POST",
                data: form.serialize(),
                dataType: "json"
            })
            .done(function (response) {
                if (response.success) {
                    swal({
                        title: "Hi " + response.name,
                        text: response.success,
                        timer: 5000,
                        showConfirmButton: false,
                        type: "success"
                    });

                    window.location.replace(response.url);

                } else {
                    swal("Oops!", response.errors, 'error');
                }
            })
            .fail(function () {
                swal("Fail!", "Cannot register now!", 'error');
            });
    });

    var login_form = $('#login');

    login_form.submit(function (e) {
        e.preventDefault();

        $.ajax({
                url: login_form.attr('action'),
                type: "POST",
                data: login_form.serialize(),
                dataType: "json"
            })
            .done(function (response) {
                if (response.success) {
                    swal({
                        title: "Welcome back!",
                        text: response.success,
                        timer: 5000,
                        showConfirmButton: false,
                        type: "success"
                    });

                    window.location.replace(response.url);

                } else {
                    swal("Oops!", response.errors, 'error');
                }
            })
            .fail(function () {
                swal("Fail!", "Cannot login now!", 'error');
            });
    });

});