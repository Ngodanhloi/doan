// Script để hiển thị popup khi click vào nút "Thêm sản phẩm"
document.getElementById('openPopupButton').addEventListener('click', function() {
    document.getElementById('popupForm').style.display = 'block';
});

// Script để đóng popup khi click vào nút "Đóng"
document.getElementById('closePopupButton').addEventListener('click', function() {
    document.getElementById('popupForm').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện click trên các nút "Edit"
    document.querySelectorAll('.edit-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');
            var editForm = document.getElementById('editFormContainer-' + productId);
            if (editForm) {
                editForm.style.display = 'block'; // Hiển thị form chỉnh sửa
            }
        });
    });

    // Thêm sự kiện để đóng form chỉnh sửa
    document.querySelectorAll('.btn-danger').forEach(function(button) {
        button.addEventListener('click', function() {
            var editForms = document.querySelectorAll('.edit-form-container');
            editForms.forEach(function(form) {
                form.style.display = 'none'; // Ẩn tất cả các form chỉnh sửa
            });
        });
    });
});