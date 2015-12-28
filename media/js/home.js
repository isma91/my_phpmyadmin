/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this, Materialize*/
$(document).ready(function () {
    var username, databases, databaseName, tableName, columns;
    $.post('api/?checkRight', function (data, textStatus) {
        if (textStatus === "success") {
            username = $("span#username").html();
            $('meta[name=description]').remove();
            $('head').append( '<meta name="description" content=My_PHPMy_Admin of "' + username + '">' );
            document.title = username + "'s My_PHPMy_Admin";
            /* get real user info in other page maybe ? */
            /*data = JSON.parse(data);
            console.log(data);
            $("#info").html("Host = '" + data.Host + "' User = '" + data.User + "'");*/
        }
    });
    $.post('api/?showDatabases', function (allDatabases, textStatus) {
        if (textStatus === "success") {
            allDatabases = JSON.parse(allDatabases);
            $.post('api/?showTables', {arrayDatabase: allDatabases}, function (allTables, textStatus) {
                if (textStatus === "success") {
                    allTables = JSON.parse(allTables);
                    databases = '';
                    $.each(allTables, function (database, tables) {
                        databases = databases + '<li><strong>' + database + '<div class="mui-divider"></div><span class="databaseLength">' + tables.length + ' Table(s)</span></strong><ul class="tables">';
                        if (tables.length === 0) {
                            databases = databases + '<li>Empty</li></ul></li>';
                        } else {
                            $.each(tables, function (number, table) {
                                databases = databases + '<li><a href="#" class="mui-btn mui-btn--flat table_in_' + database + '">' + table + '</a></li>';
                            });
                            databases = databases + '</ul></li>';
                        }
                    });
                    $("ul#databases").html(databases);
                    $('strong', '#sidedrawer').next().hide();
                    $('strong', '#sidedrawer').on('click', function() {
                        $(this).next().slideToggle(200);
                    });
                    $('a', 'li', 'ul.tables').click(function () {
                        databaseName = $(this).attr('class').substr($(this).attr('class').search("table_in_") + 9);
                        tableName = $(this).text();
                        $.post('api/?showColumns', {databaseName: databaseName, tableName: tableName}, function (tableColumns, textStatus) {
                            if (textStatus === "success") {
                                tableColumns = JSON.parse(tableColumns);
                                columns = '';
                                columns = columns + '<table class="mui-table"><thead><tr><th>#</th><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr></thead><tbody>';
                                $.each(tableColumns, function (index, column) {
                                    columns = columns + '<tr><td>'+ index + '</td><td>' + column.Field + '</td><td>' + column.Type + '</td><td>' + column.Null + '</td><td>' + column.Key  + '</td><td>' + column.Default + '</td><td>' + column.Extra + '</td></tr>';
                                });
                                columns = columns + '</tbody></table>';
                                $('#theBody').html(columns);
                            }
                        });
                    });
                }
            });
        }
    });
});