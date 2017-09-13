$(document).ready(function () {
    listAllCagory(host + "/api/category/list/");
});

function listAllCagory(url) {
    var tmp = $('#jstree_demo_div').jstree(true);
    if (tmp) {
        tmp.destroy();
    }
    $.get(url, function (data) {
        datas = data.concat([{id: "0", parent: "#", text: "Root", description: "lkjklj"}]);
        $('#jstree_demo_div').jstree({'core': {
                'data': datas
            }});
    });
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

    listAllFiche(host + "/api/fiche/list/");
    menuContextuele();

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
            showMsg(response);
            viewTbodyFiche(response);
            manageFiche();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            showMsg(xhr);
            $("div#error").children("strong").html(ajaxOptions + xhr + thrownError);
        }
    });
}

function viewTbodyFiche(data) {
    var view = "";
    if (data["info"] !== undefined || data["error"] !== undefined) {
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
                            showMsg(response);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            showMsg(xhr);
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
                            showMsg(response);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            showMsg(xhr);
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

function showMsg(response) {
    console.log(response);
    console.log(response["info"]);
    $("div#error").hide("slow");
    $("div#succes").hide("slow");
    if (response["info"] !== undefined) {
        $("div#succes").show("slow");
        $("div#succes").children("strong").html(response["info"]);
    }
    if (response["error"] !== undefined) {
        $("div#error").show("slow");
        $("div#error").children("strong").html(response["error"]);
    }
}

function deleteCategory(url) {

    $.ajax({
        url: url,
        method: "GET",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(response);
            showMsg(response);
            listAllCagory(host + "/api/category/list/");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            showMsg(xhr);
            $("div#error").children("strong").html(ajaxOptions + xhr + thrownError);
        }
    });
}
function menuContextuele() {
    //Menu contextule
    $(function () {
        $.contextMenu({
            selector: '.jstree-node',
            callback: function (key, options) {
                var urlDelete = host + "/api/category/delete/" + options.$trigger.attr('id');
                if (key == "delete") {
                    deleteCategory(urlDelete)
                }
                console.log(options.$trigger.attr('id'));
            },
            items: {
                "edit": {name: "Modifier", icon: "edit"},
                "delete": {name: "Supprimer", icon: "delete"},
            }
        });


    });
}