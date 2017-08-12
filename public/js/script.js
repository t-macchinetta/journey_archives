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
    $('#sortable').sortable({
        update: function(event,ui){
            var array1 = [];
            $('.j_id').each(function(i){
                text = $(this).text();
                array1.push(text);
            });
            $('#r_length').text(array1);
        }
    });
    $('#sortable').disableSelection();

    // $('#sortable').on('change', function(){
    // $('#r_length').on('click', function(){
    //     var array1 = [];
    //     $('.j_id').each(function(i){
    //         text = $(this).text();
    //         array1.push(text);
    //     });
    //     $('#r_length').text(array1);
    // });

    $('.j_id').on('click', function() {
        var now_id = $(this).text();
        $('#now_num').text(now_id);
    });

});