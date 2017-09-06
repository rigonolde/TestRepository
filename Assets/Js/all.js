$(document).ready(function () {
    listAllCagory();
});
function listAllCagory() {
    $.ajax({
        url: "https://testprojet.loc/api/category/list/",
        method: "GET",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(viewTbodyCategory(response));
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(ajaxOptions + xhr + thrownError);
        }
    });
}

function viewTbodyCategory(data) {

    var view = "";
    for (var i = 0; i < data.length; i++) {
        console.log(data[i]);
        view += "<tr> <td>" + data[i]["id"] +
                "</td><td>" + data[i]["parentId"] +
                "</td><td>" + data[i]["libelle"] +
                "</td><td>" + data[i]["description"] +
                "</td></tr>";
    }
    return view;
}