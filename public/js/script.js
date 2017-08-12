$(function () {
    // 削除ボタンを押したら確認アラート表示
    $('.delete').on('click', function () {
        if(window.confirm("削除しますか?")) {
            location.href = $(this).attr('href');
        } else {
            return false;
        }
    });
    // 詳細の並び替えをできるようにする処理
    $('#sortable').sortable();
    $('#sortable').disableSelection();



});