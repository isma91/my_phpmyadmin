/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var admin_profile_clear;
    admin_profile_clear = false;
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 100
    });
    $("input").bind('change paste keyup', function() {
        if ($.trim($("input#first_name").val()) === "" || $.trim($("input#last_name").val()) === "" || $.trim($("input#username").val()) === "" || $.trim($("input#birthdate").val()) === "") {
            admin_profile_clear = true;
            $("div#form_install_admin_profile").html('<i class="large material-icons">face</i>Admin Profile <span class="not_complete">Not complete</span>');
        } else {
            admin_profile_clear = false;
            $("div#form_install_admin_profile").html('<i class="large material-icons">face</i>Admin Profile <span class="fully_complete">Fully complete</span>');
        }
    });
    $("button#db_create").click(function() {
        $.post('install_db.php', {host: $("input#host").val(), db_username: $("input#db_username").val(), db_password: $("input#db_password").val(), db_name: $("input#db_name").val()}, function (data, textStatus) {
            if (textStatus === "success") {
                if (data.substr(0, 5) === "Error") {
                    Materialize.toast('<p class="alert-failed">' + data + '<p>', 4000, 'rounded alert-failed');
                } else{
                    Materialize.toast('<p class="alert-success">' + data + '<p>', 4000, 'rounded alert-success');
                }
            } else {
                Materialize.toast('<p class="alert-failed">A problem occurred when the demand for database creation<p>', 4000, 'rounded alert-failed');
            }
        });
    });
    $("button#db_test").click(function() {
        $.post('test_db.php', {host: $("input#host").val(), db_username: $("input#db_username").val(), db_password: $("input#db_password").val(), db_name: $("input#db_name").val()}, function (data, textStatus) {
            if (textStatus === "success") {
                if (data.substr(0, 5) === "Error") {
                    Materialize.toast('<p class="alert-failed">' + data + '<p>', 4000, 'rounded alert-failed');
                } else{
                    Materialize.toast('<p class="alert-success">' + data + '<p>', 4000, 'rounded alert-success');
                }
            } else {
                Materialize.toast('<p class="alert-failed">A problem occurred when the demand for database connection<p>', 4000, 'rounded alert-failed');
            }
        });
    });
});