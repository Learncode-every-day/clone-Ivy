const itemSliderBar = document.querySelectorAll(".category-left__item");
itemSliderBar.forEach(function (menu, index) {
    menu.addEventListener("click", function () {
        menu.classList.toggle("block");
    });
});
