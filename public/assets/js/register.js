$(document).ready(function () {
    $(".radio-wrapper").click(function () {
        $(this).children(0).not(":checked").prop("checked", true);
    });
});
