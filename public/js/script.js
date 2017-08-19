$(function () {
    // 駅名の入力補助
    // var dateTimeApp;// 日付入力パーツ
    var stationApp0;// 駅名入力パーツ#0
    var stationApp1;// 駅名入力パーツ#1
    // 駅名入力パーツ#0初期化
    stationApp0 = new expGuiStation(document.getElementById("station0"));
    stationApp0.dispStation();
    // 駅名入力パーツ#1初期化
    stationApp1 = new expGuiStation(document.getElementById("station1"));
    stationApp1.dispStation();
    
    // 選択した場合の駅名をhiddenに入れる
    $('#station0').on('click', '.exp_stationName', function(){
        var station0 = $('#station0\\:stationInput').val();
        $('#departure').val(station0);
    });
    $('#station1').on('click', '.exp_stationName', function(){
        var station1 = $('#station1\\:stationInput').val();
        $('#destination').val(station1);
    });
    // 直接入力していた場合の値をhiddenに入れる．
    $('#submit').on('click', function(){
        if($('#departure').val()==""){
            var station0 = $('#station0\\:stationInput').val();
            $('#departure').val(station0);
        }
        if($('#destination').val()==""){
            var station1 = $('#station1\\:stationInput').val();
            $('#destination').val(station1);
        }
    });
    
    // 削除ボタンを押したら確認アラート表示
    $('.delete').on('click', function () {
        if(window.confirm("削除しますか?")) {
            location.href = $(this).attr('href');
        } else {
            return false;
        }
    });

    // 読み込んだレコードのidを順番通り配列に入れる処理    
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
    // 並び替えここまで(工事中)


});