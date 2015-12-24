/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this*/
$(document).ready(function(){
    var admin_profile_clear, db_test_clear;
    admin_profile_clear = false;
    db_test_clear = false;
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 100
    });
    $("input").bind('change paste keyup', function() {
        if ($.trim($("input#first_name").val()) === "" || $.trim($("input#last_name").val()) === "" || $.trim($("input#username").val()) === "" || $("input#password").val() === "" || $.trim($("input#birthdate").val()) === "") {
            admin_profile_clear = false;
            $("div#form_install_admin_profile").html('<i class="large material-icons">face</i>Admin Profile <span class="not_complete">Not complete</span>');
        } else {
            admin_profile_clear = true;
            $("div#form_install_admin_profile").html('<i class="large material-icons">face</i>Admin Profile <span class="fully_complete">Fully complete</span>');
        }
        if (admin_profile_clear === true && db_test_clear === true) {
            $("div#finish_install").fadeIn("slow");
        } else {
            $("div#finish_install").fadeOut('fast');
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
                    db_test_clear = false;
                } else{
                    Materialize.toast('<p class="alert-success">' + data + '<p>', 4000, 'rounded alert-success');
                    db_test_clear = true;
                }
            } else {
                Materialize.toast('<p class="alert-failed">A problem occurred when the demand for database connection<p>', 4000, 'rounded alert-failed');
                db_test_clear = false;
            }
            if (admin_profile_clear === true && db_test_clear === true) {
                $("div#finish_install").fadeIn("slow");
            } else {
                $("div#finish_install").fadeOut('fast');
            }
        });
    });
    $("button#button_finish_install").click(function() {
        $.post('create_config.php', {host: $("input#host").val(), db_username: $("input#db_username").val(), db_password: $("input#db_password").val(), db_name: $("input#db_name").val()}, function (data, textStatus) {
            $(".big_form_install").fadeOut('slow');
            if (textStatus === "success") {
                if (data !== 0) {
                    Materialize.toast('<p class="alert-success">Config file created<p>', 4000, 'rounded alert-success');
                } else {
                    Materialize.toast('<p class="alert-failed">Error when creating the config file<p>', 4000, 'rounded alert-failed');
                }
            } else {
                Materialize.toast('<p class="alert-failed">A problem occurred when the demand for ceating config file<p>', 4000, 'rounded alert-failed');
            }
        });
        $.post('insert_db.php', {host: $("input#host").val(), db_username: $("input#db_username").val(), db_password: $("input#db_password").val(), db_name: $("input#db_name").val(), first_name: $.trim($("input#first_name").val()), last_name: $.trim($("input#last_name").val()), username: $.trim($("input#username").val()), password: $("input#password").val(), birthdate: $.trim($("input#birthdate").val())}, function (data, textStatus) {
            if (textStatus === "success") {
                if (data === "true") {
                    Materialize.toast('<p class="alert-success">Table and user created<p>', 4000, 'rounded alert-success');
                    Materialize.toast('<p class="alert-success">Installation finished successfully<p>', 4000, 'rounded alert-success');
                    document.location.href = './../';
                } else {
                    Materialize.toast('<p class="alert-failed">Error when creating the table and user<p>', 4000, 'rounded alert-failed');
                }
            } else {
                Materialize.toast('<p class="alert-failed">A problem occurred when the demand for ceating table and user<p>', 4000, 'rounded alert-failed');
            }
        });
    });
});