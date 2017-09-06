$(document).ready(function () {
    listAllCagory();
});
function listAllCagory() {
    $.ajax({
        url: "https://testprojet.loc/api/category/list/",
        method: "GET",
        cache: false,
        success: function (response) {
            console.log(JSON.parse(response));
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(ajaxOptions + xhr + thrownError);
        }
    });
}

function viewTbodyCategory(data) {
    console.log(data);
    var view = "";
    for (var item in object) {
        view += "<tr> <td>" + item.id +
                "</td><td>" + item.parentId +
                "</td><td>" + item.libelle +
                "</td><td>" + item.descritpion +
                "</td></tr>";
    }
    return view;
}