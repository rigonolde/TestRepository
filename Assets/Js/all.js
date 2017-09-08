$(document).ready(function () {
    listAllFiche(host + "/api/fiche/list/");
    $('#jstree_demo_div').on("changed.jstree", function (e, data) {
        var children = data.node.children_d;
        var ids = "";
        if (children.length > 0) {
            ids = '(' + children.join() + "," + data.selected + ')';
        } else {
            ids = '(' + data.selected + ')';
        }
        var url = host + "/api/fiche/list/?ids=" + ids;
        listAllFiche(url);
    });

    $.get(host + "/api/category/list/", function (data) {
        datas = data.concat([{id: "0", parent: "#", text: "Root", description: "lkjklj"}]);
        console.log(datas);
        $('#jstree_demo_div').jstree({'core': {
                'data': datas
            }});
    });

});

function listAllCagory(url) {
    $.get("../View/Category/list_category.php", function (data) {
        $("#tableContent").html(data);
    });
    $("#img-loading").show();
    $.ajax({
        url: url,
        method: "GET",
        cache: false,
        dataType: "json",
        success: function (response) {
            hideMsg();
            viewTbodyCategory(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(ajaxOptions + xhr + thrownError);
        }
    });
}

function viewTbodyCategory(data) {
    var view = "";
    if (data["info"] !== undefined || data["error"] !== undefined) {
        var msg = data["info"] !== undefined ? data["info"] : data["error"];
        view += "<h1 style='color : red;'>" + msg + "</h1>";
        $("#tableContent").html(view);
    } else {
        for (var i = 0; i < data.length; i++) {
            view += "<tr> <td>" + data[i]["id"] +
                    "</td><td>" + data[i]["parent"] +
                    "</td><td>" + data[i]["text"] +
                    "</td><td>" + data[i]["description"] +
                    "</td></tr>";
        }
        $("#tableBodyCategory").html(view);
    }
    $("#img-loading").hide();
    $("#tableContent").show("slow");
}

function listAllFiche(url) {
    $.get("../View/Fiche/list_fiche.php", function (data) {
        $("#tableContent").html(data);
    });
    $("#img-loading").show();
    $.ajax({
        url: url,
        method: "GET",
        cache: false,
        dataType: "json",
        success: function (response) {
            hideMsg();
            viewTbodyFiche(response);
            manageFiche();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            hideMsg();
            $("#img-loading").hide();
            $("div#error").show("slow");
            $("div#error").children("strong").html(ajaxOptions + xhr + thrownError);
        }
    });
}

function viewTbodyFiche(data) {
    var view = "";
    if (data["info"] !== undefined || data["error"] !== undefined) {
        var msg = data["info"] !== undefined ? data["info"] : data["error"];
        view += "<h1 style='color : red;'>" + msg + "</h1>";
        $("#tableContent").html(view);
    } else {
        for (var i = 0; i < data.length; i++) {

            view += "<tr> <td>" + data[i]["id"] +
                    "</td><td>" + data[i]["libelle"] +
                    "</td><td>" + data[i]["categoryId"] +
                    '</td><td> <button type="button" class="btn btn-primary editFiche">Modifier</button></td> \n\
                    <td><button type="button" class="btn btn-danger deleteFiche" id="' + data[i]["id"] +
                    '">Supprimer</button></td></tr>';
        }
        $("#tableBodyFiche").html(view);
    }

    $("#img-loading").hide();
    $("#tableContent").show("slow");
}

function manageFiche() {

    $(".deleteFiche").click(function () {
        var url = host + "/api/fiche/delete/" + $(this).attr('id');
        var tr = $(this).parents("tr");
        $("#dialog-confirm").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function () {
                    $.ajax({
                        url: url,
                        method: "GET",
                        cache: false,
                        dataType: "json",
                        success: function (response) {
                            tr.remove();
                            hideMsg();
                            $("div#succes").show("slow");
                            $("div#succes").children("strong").html("Operation avec succées !");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            hideMsg();
                            $("div#error").show("slow");
                            $("div#error").children("strong").html(ajaxOptions + xhr + thrownError);
                        }
                    });
                    $(this).dialog("close");
                },
                "Non": function () {
                    $(this).dialog("close");
                }
            }
        });
    });
    $(".editFiche").click(function () {
        var url = host + "/api/fiche/delete/" + $(this).attr('id');
        var tr = $(this).parents("tr");
        $("#dialog-edit-fiche").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function () {
                    $.ajax({
                        url: url,
                        method: "POST",
                        cache: false,
                        dataType: "json",
                        success: function (response) {
                            hideMsg();
                            $("div#succes").show("slow");
                            $("div#succes").children("strong").html("Operation avec succées !");
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            hideMsg();
                            $("div#error").show("slow");
                            $("div#error").children("strong").html(ajaxOptions + xhr + thrownError);
                        }
                    });
                    $(this).dialog("close");
                },
                "Non": function () {
                    $(this).dialog("close");
                }
            }
        });
    });
}
function hideMsg() {
    $("div#error").hide("slow");
    $("div#succes").hide("slow");
}