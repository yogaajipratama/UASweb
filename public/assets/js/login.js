$(document).ready(function () {
    $(".eye-show").click(function () {
        event.stopPropagation();
        $(this).toggleClass("hide");
        $(this).toggleClass("show");
        $(".eye-hide").toggleClass("hide");
        $(".eye-hide").toggleClass("show");
        $("#password").attr("type", "text");
    });
    $(".eye-hide").click(function () {
        event.stopPropagation();
        $(this).toggleClass("hide");
        $(this).toggleClass("show");
        $(".eye-show").toggleClass("hide");
        $(".eye-show").toggleClass("show");
        $("#password").attr("type", "password");
    });
});
