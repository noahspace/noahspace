$("#dropDown").on("click", function (e) {
    $(this).toggleClass("active");
    $(".panel").toggle();
    return false;
});
$(window).on("click", function () {
    $("#dropDown").removeClass("active");
    $(".panel").hide();
})
