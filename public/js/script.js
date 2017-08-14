$(function () {
    // 削除ボタンを押したら確認アラート表示
    $('.delete').on('click', function () {
        if(window.confirm("削除しますか?")) {
            location.href = $(this).attr('href');
        } else {
            return false;
        }
    });

    // 読み込んだレコードのisを順番通り配列に入れる処理    
    var str = $('#now_id').text();
    str = str.slice( 1, -1 );
    var now_id = str.split(',');
        // $('#now_num').text(now_id);
    var old_id = now_id.join();
    
    // 詳細の並び替えをできるようにする処理
    $('#sortable').sortable({
        update: function(event,ui){
            var new_id = [];
            $('.j_id').each(function(i){
                text = $(this).text();
                new_id.push(text);
            });
            var neo_id = new_id.join();
            $('#now_num').val(old_id);
            $('#new_num').val(neo_id);
            // $('#sort').submit();
            $('#test').text(neo_id);
        }
    });
    $('#sortable').disableSelection();



});