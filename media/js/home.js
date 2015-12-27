/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this, Materialize*/
$(document).ready(function () {
    $.post('api/?checkRight', function (data, textStatus, xhr) {
        if (textStatus === "success") {
            data = JSON.parse(data);
            console.log(data);
            $("#info").html("Host = '" + data.Host + "' User = '" + data.User + "'");
        }
    });
});