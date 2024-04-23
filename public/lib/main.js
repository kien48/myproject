// Xóa phần tử lớp mờ và hiệu ứng vòng tròn khi trang đã tải xong
window.addEventListener("load", function() {
    var loadingOverlay = document.querySelector('.loading-overlay');
    if (loadingOverlay) {
        loadingOverlay.parentNode.removeChild(loadingOverlay);
    }
});

function kiemtrasoluong(input) {
    var num = parseInt(input.value);
    if (num < 1 || isNaN(num)) {
        input.value = 1;
        alert("Số lượng nhập ít nhất là 1");
    } else if (num > 50) {
        input.value = 50;
        alert("Số lượng không thể lớn hơn 50");
    }
}

function plus(button) {
    var input = button.previousElementSibling;
    var num = parseInt(input.value) + 1;
    if (num <= 50) {
        input.value = num ;
    } else {
        alert("Số lượng không thể lớn hơn 50");
    }
}

function minus(button) {
    var input = button.nextElementSibling;
    var num = parseInt(input.value) - 1;
    if (num >= 1) {
        input.value = num;
    } else {
        alert("Số lượng không thể nhỏ hơn 1");
    }
}
