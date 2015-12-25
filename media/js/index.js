/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this, Materialize*/
$(document).ready(function () {
    $("button#connection").click(function () {
        $.post('api/?connection', {username: $("input#username").val(), password: $("input#password").val()}, function (data, textStatus) {
            console.log(data);
            if (textStatus === "success") {
                if (data === 'true') {
                    $.post('index.php', {page: 'home'}, function (data, textStatus) {
                        if (textStatus !== "success") {
                            Materialize.toast('<p class="alert-failed">A problem occurred when the demand for redirecting to the home page<p>', 4000, 'rounded alert-failed');
                        }
                    });
                } else {
                    Materialize.toast('<p class="alert-failed">Bad Username or Password<p>', 4000, 'rounded alert-failed');
                }
            } else {
                Materialize.toast('<p class="alert-failed">A problem occurred when the demand for connecting<p>', 4000, 'rounded alert-failed');
            }
        });
    });
});