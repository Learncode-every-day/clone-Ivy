// Lấy ảnh to nhất
const bigImg = document.querySelector(".product-content-left__big-img img");
// Lấy tất cả các ảnh bé
const smallImg = document.querySelectorAll(
    ".product-content-left__small-img img"
);

// Duyệt qua mảng ảnh nhỏ
smallImg.forEach(function (imgItem, X) {
    imgItem.addEventListener("click", function () {
        bigImg.src = imgItem.src;
    });
});

const baoquan = document.querySelector(".baoquan");
const chitiet = document.querySelector(".chitiet");

if (baoquan) {
    baoquan.addEventListener("click", function (e) {
        document.querySelector(
            ".product-content-right-bottom-content-info"
        ).style.display = "none";

        document.querySelector(
            ".product-content-right-bottom-content-sub"
        ).style.display = "block";
    });
}

if (chitiet) {
    chitiet.addEventListener("click", function () {
        document.querySelector(
            ".product-content-right-bottom-content-info"
        ).style.display = "block";

        document.querySelector(
            ".product-content-right-bottom-content-sub"
        ).style.display = "none";
    });
}

const button = document.querySelector(".chevron-down-icon");
if (button) {
    button.addEventListener("click", function () {
        document
            .querySelector(".product-content-bottom-content-big")
            .classList.toggle("activeB");
    });
}