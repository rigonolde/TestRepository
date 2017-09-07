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
        $('#jstree_demo_div').jstree({'core': {
                'data': data
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
            viewTbodyFiche(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(ajaxOptions + xhr + thrownError);
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
                    "</td></tr>";
        }
        $("#tableBodyFiche").html(view);
    }

    $("#img-loading").hide();
    $("#tableContent").show("slow");
}