const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");

const imgContainer = document.querySelector(".aspect-ratio-169");

const dotItems = document.querySelectorAll(".dot");

let imgNumber = imgPosition.length;
let index = 0;
// Dùng for each để chỉnh ảnh căn trái để ẩn ảnh
imgPosition.forEach(function (image, index) {
    // Lấy được từng phần tử bằng cách duyệt
    // console.log(image, index);
    // Xog đẩy mỗi ảnh qua cách nhâu đúng 100vw
    image.style.left = index * 100 + "%";
    dotItems[index].addEventListener("click", function (e) {
        slider(index);
    });
});

// Hàm tự động cho nó di chuyển
function imgSlide() {
    index++;

    if (index >= imgNumber) {
        index = 0;
    }

    slider(index);
}
function slider(index) {
    imgContainer.style.left = "-" + index * 100 + "%";
    // Chọn hết các class active
    const dotActive = document.querySelector(".active");
    dotActive.classList.remove("active");
    // Thêm class active khi mà nó chuyển qua
    dotItems[index].classList.add("active");
}

// Hàm làm sau bao nhiêu ms thực hiện cái gì tiếp theo
setInterval(imgSlide, 5000);
