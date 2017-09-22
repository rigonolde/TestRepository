$(document).ready(function () {
    listAllCagory(host + "/api/category/list/");
    $(".controlVide").keypress(function () {
        $(this).removeAttr("style");
        if ($(this).val() == "") {
            $(this).attr("style", "border-color:red;");
        }
    });

    $("#selectEditCategory").change(function () {
        $(this).children("option").removeAttr("selected");
        $(this).children("option[value='" + $(this).val() + "']").attr("selected", "selected");
    }).change();
    $("#selectEditCategoryC").change(function () {
        $(this).children("option").removeAttr("selected");
        $(this).children("option[value='" + $(this).val() + "']").attr("selected", "selected");
    }).change();
    $("#searchButton").click(function () {
        if ($(this).prev("input").val() != "") {
            serchFiche($(this).prev("input").val());
        }
    });
});

function listAllCagory(url) {
    var tmp = $('#jstree_demo_div').jstree(true);
    if (tmp) {
        tmp.destroy();
    }
    $.get(url, function (data) {
        $("#selectEditCategory").html(selectCategory(data));
        $("#selectEditCategory").children("option").eq(0).attr("selected", "selected");
        $("#selectEditCategoryC").html("<option value='0'>Pas de parent</option>" + selectCategory(data));
        $("#selectEditCategoryC").children("option").eq(0).attr("selected", "selected");
        datas = data.concat([{id: "0", parent: "#", text: "Root", description: "default"}]);

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

function listAllFiche(url, msg = null) {
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
            showMsg(response, msg);
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
                    "</td><td>" + data[i]["category"] +
                    "</td><td>" + data[i]["libelle"] +
                    '</td><td> <button type="button" class="btn btn-primary editFiche" data-value="' + data[i]["categoryId"] + '">Modifier</button></td> \n\
                    <td><button type="button" class="btn btn-danger deleteFiche" id="' + data[i]["id"] + '">Supprimer</button></td></tr>';
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
        var action = $(this).attr("data-value");
        var tr = null;
        if (action != 'new') {
            tr = $(this).parents("tr");
            $("#selectEditCategory").children("option").removeAttr("selected");
            $("#selectEditCategory").children("option[value='" + $(this).attr("data-value") + "']").attr("selected", "selected")
            $("#idEdit").val(tr.children("td").eq(0).html());
            $("#libelleEdit").val(tr.children("td").eq(2).html());
        }
        var urlPost = host + "/api/fiche/edit/" + $("#idEdit").val();
        if (action == "new") {
            urlPost = host + "/api/fiche/new";
            $("#libelleEdit").val("");
        }
        $("#libelleEdit").removeAttr("style");
        $("#dialog-edit-fiche").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function () {
                    if ($("#libelleEdit").val() != '') {
                        $("#img-loading-edit").show();
                        $.ajax({
                            url: urlPost,
                            method: "POST",
                            cache: false,
                            data: {
                                'libelle': $("#libelleEdit").val(),
                                'categoryId': $("#selectEditCategory").children("option[selected='selected']").val(),
                            },
                            dataType: "json",
                            success: function (response) {

                                $("#img-loading-edit").hide();
                                if (action == "new") {
                                    listAllFiche(host + "/api/fiche/list/", response["info"]);
                                } else {
                                    tr.children("td").eq(1).html($("#selectEditCategory").children("option[selected='selected']").html());
                                    tr.children("td").eq(2).html($("#libelleEdit").val());
                                    tr.children("td").eq(3).children('button').attr("data-value", $("#selectEditCategory").children("option[selected='selected']").val());
                                    showMsg(response);
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                $("#img-loading-edit").hide();
                                showMsg(xhr);
                                $("#img-loading-edit").hide();
                                $("div#error").children("strong").html(ajaxOptions + xhr + thrownError);
                            }
                        });
                        $(this).dialog("close");
                    } else {
                        $("#libelleEdit").attr("style", "border-color:red;");
                    }
                },
                "Non": function () {
                    $(this).dialog("close");
                }
            }
        });
    });
}

function showMsg(response, msg = null) {
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
    if (msg != null) {
        $("div#succes").show("slow");
        $("div#succes").children("strong").html(msg);
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
function editCategory(id, urlPost, action) {
    if (action == "new") {
        dialogNewAndEditCategory(urlPost);
    }
    if (action == "edit") {
        $.get(host + "/api/category/list/?id=" + id, function (data) {
            if (data["info"] !== undefined) {
                var response = {"error": "Categorie n'existe pas !"};
                showMsg(response);
            } else {

                $("#dEditCategory").val(id);
                $("#libelleEditCategory").val(data[0]["text"]);
                $("#selectEditCategoryC").children("option").removeAttr("selected");
                $("#selectEditCategoryC").children("option[value='" + data[0]["parent"] + "']").attr("selected", "selected");
                $("#descriptionCategory").val(data[0]["description"]);
                dialogNewAndEditCategory(urlPost);
            }
        });
    }


}
function dialogNewAndEditCategory(urlPost) {
    $("#dialog-edit-category").dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Oui": function () {
                if ($("#libelleEditCategory").val() != '' && $("#descriptionCategory").val() != "") {

                    $("#img-loading-edit-category").show();
                    $.ajax({
                        url: urlPost,
                        method: "POST",
                        cache: false,
                        data: {
                            'id': $("#dEditCategory").val(),
                            'libelle': $("#libelleEditCategory").val(),
                            'parentId': parseInt($("#selectEditCategoryC").children("option[selected='selected']").val()),
                            'description': $("#descriptionCategory").val(),
                        },

                        success: function (response) {
                            console.log(response);

                            $("#img-loading-edit-category").hide();
                            listAllCagory(host + "/api/category/list/");
                            showMsg(response);

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log(ajaxOptions + xhr + thrownError);
                            $("#img-loading-edit-category").hide();
                            showMsg(xhr);
                            $("div#error").children("strong").html(ajaxOptions + xhr + thrownError);
                        }
                    });
                    $(this).dialog("close");
                } else {
                    $("#libelleEditCategory").attr("style", "border-color:red;");
                    $("#libelleEditCategory").attr("style", "border-color:red;");
                }
            },
            "Non": function () {
                $(this).dialog("close");
            }
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
                if (key == "edit") {
                    var urlEdit = host + "/api/category/edit/" + options.$trigger.attr('id');
                    editCategory(options.$trigger.attr('id'), urlEdit, "edit");
                }
            },
            items: {
                "edit": {name: "Modifier", icon: "edit"},
                "delete": {name: "Supprimer", icon: "delete"},
            }
        });


    });
}
function selectCategory(data) {
    var view = "";
    for (var i = 0; i < data.length; i++) {
        view += "<option value='" + data[i]["id"] + "'>" + data[i]["text"] + "</option>";
    }
    return view;
}
function serchFiche(str) {
    listAllFiche(host + "/api/fiche/list/?searParams=" + str);
}