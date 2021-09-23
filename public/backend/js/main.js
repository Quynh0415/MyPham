$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});
// hàm xóa một dòng dữ liệu trong bảng
// Xây dựng một hàm chung để xóa nhiều dữ liệu khác nhau
function deleteItem(model, id) {
    var result = confirm("Bạn có chắc chắn muốn xóa ?");
    if (result) { // neu nhấn == ok , sẽ send request ajax
        $.ajax({
            url: model+'/'+id, // ........../admin/banner/3
            type: 'DELETE',
            //data: {}, // dữ liệu truyền sang nếu có
            dataType: "json", // kiểu dữ liệu nhận về
            success: function (res) { // success : kết quả trả về sau khi gửi request ajax
                // isSuccess: true
                // console.log(typeof res);
                if (res.isSuccess != 'undefined' && res.isSuccess == true) {
                    // xóa dòng vừa được click delete
                    $('.item-'+id).remove(); // class .item- ở trong class của thẻ td đã khai báo trong file index
                }
            },
            error: function (e) { // lỗi nếu có

            }
        });
    }
}
