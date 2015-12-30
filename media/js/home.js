/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, document, this, Materialize*/
$(document).ready(function () {
    var username, databases, databaseName, tableName, columns, dbName;
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
    function showColumns (dbName, tabName) {
        $.post('api/?showColumns', {databaseName: dbName, tableName: tabName}, function (tableColumns, textStatus) {
            if (textStatus === "success") {
                tableColumns = JSON.parse(tableColumns);
                columns = '';
                columns = columns + '<table class="mui-table"><thead><tr><th>#</th><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr></thead><tbody>';
                $.each(tableColumns, function (index, column) {
                    if (column.Default === null && column.Null === "NO") {
                        column.Default = "No default variable";
                    }
                    if (column.Extra === "") {
                        column.Extra = "No extra";
                    }
                    if (column.Key === "PRI") {
                        column.Key = "PRIMARY KEY";
                    } else if (column.Key === "UNI") {
                        column.Key = "UNIQUE";
                    } else if (column.Key === "MUL") {
                        column.Key = "MULTIPLE";
                    } else if (column.Key === "") {
                        column.Key = "Not indexed";
                    }
                    columns = columns + '<tr><td>'+ index + '</td><td>' + column.Field + '</td><td>' + column.Type + '</td><td>' + column.Null + '</td><td>' + column.Key  + '</td><td>' + column.Default + '</td><td>' + column.Extra + '</td></tr>';
                });
                columns = columns + '</tbody></table>';
                $('#theBody').html(columns);
            }
        });
    }
    $.post('api/?showDatabases', function (allDatabases, textStatus) {
        if (textStatus === "success") {
            allDatabases = JSON.parse(allDatabases);
            $.post('api/?showTables', {arrayDatabase: allDatabases}, function (allTables, textStatus) {
                if (textStatus === "success") {
                    allTables = JSON.parse(allTables);
                    databases = '';
                    $.each(allTables, function (database, tables) {
                        databases = databases + '<li><strong id="' + database + '">' + database + '<div class="mui-divider"></div><span class="databaseLength">' + tables.length + ' Table(s)</span></strong><ul class="tables">';
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
                    $('strong').click(function () {
                        dbName = $(this).attr('id');
                        $.post('api/?showTableStatus', {databaseName: dbName}, function (tablesStatus, textStatus) {
                            if (textStatus === "success") {
                                tablesStatus = JSON.parse(tablesStatus);
                                status = '';
                                if (tablesStatus === false) {
                                    status = '<h1 class="title">No Table</h1>';
                                    $("#theBody").html(status);
                                } else {
                                    status = status + '<div class="mui-panel"><table class="responsive-table centered highlight"><thead><tr><th class="tooltipped" data-position="top" data-tooltip="The name of the table">Name</th><th class="tooltipped" data-position="top" data-tooltip="The number of rows">Row(s)</th><th class="tooltipped" data-position="top" data-tooltip="The row-storage format (Fixed, Dynamic, Compressed, Redundant, Compact)">Row format</th><th class="tooltipped" data-position="top" data-tooltip="The table\'s character set and collation">Collation</th><th class="tooltipped" data-position="top" data-tooltip="When the table was created">Create date</th><th class="tooltipped" data-position="top" data-tooltip="The storage engine for the table">Engine</th><th class="tooltipped" data-position="top" data-tooltip="The version number of the table">Version</th><th class="tooltipped" data-position="top" data-tooltip="When the data file was last updated. For some storage engines, this value is NULL">Update date</th><th class="tooltipped" data-position="top" data-tooltip="When the table was last checked. Not all storage engines update this time, in which case the value is always NULL">Last check date</th><th class="tooltipped" data-position="top" data-tooltip="The comment used when creating the table (or information as to why MySQL could not access the table information)">Comment</th><th class="tooltipped" data-position="top" data-tooltip="Extra options used with \'CREATE TABLE\'. The original options supplied when \'CREATE TABLE\' is called are retained and the options reported here may differ from the active table settings and options">Create options</th></tr></thead><tbody>';
                                    $.each(tablesStatus, function (index, tableStatus) {
                                        status = status + '<tr><td><a href="#" class="mui-btn mui-btn--raised table_in_' + dbName + '">' + tableStatus.Name + '</a></td><td>' + tableStatus.Rows + '</td><td>' + tableStatus.Row_format + '</td><td>' + tableStatus.Collation + '</td><td>' + tableStatus.Create_time + '</td><td>' + tableStatus.Engine + '</td><td>' + tableStatus.Version + '</td><td>' + tableStatus.Update_time + '</td><td>' + tableStatus.Check_time + '</td><td>' + tableStatus.Comment + '</td><td>' + tableStatus.Create_options + '</td></tr>';
                                    });
                                }
                                status = status + '</tbody></table></div>';
                                $("#theBody").html(status);
                                $('.tooltipped').tooltip({delay: 50});
                            }
                            $('a', 'td', 'tr').click(function () {
                                showColumns($(this).attr('class').substr($(this).attr('class').search("table_in_") + 9), $(this).text());
                            });
                        });
                    });
                    $('a', 'li', 'ul.tables').click(function () {
                        showColumns($(this).attr('class').substr($(this).attr('class').search("table_in_") + 9), $(this).text());
                    });
                }
            });
        }
    });
});