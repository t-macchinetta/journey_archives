// $(function () {
$(window).load(function () {
    // var h = $('.record').height();
    // $('.time').height(h);

    // 駅名の入力補助
    // var dateTimeApp;// 日付入力パーツ
    // var stationApp0;// 駅名入力パーツ#0
    // var stationApp1;// 駅名入力パーツ#1
    // 駅名入力パーツ#0初期化
    // stationApp0 = new expGuiStation(document.getElementById("station0"));
    // stationApp0.dispStation();
    // 駅名入力パーツ#1初期化
    // stationApp1 = new expGuiStation(document.getElementById("station1"));
    // stationApp1.dispStation();
    
    // 選択した場合の駅名をhiddenに入れる
    // $('#station0').on('click', '.exp_stationName', function(){
    //     var station0 = $('#station0\\:stationInput').val();
    //     $('#departure').val(station0);
    // });
    // $('#station1').on('click', '.exp_stationName', function(){
    //     var station1 = $('#station1\\:stationInput').val();
    //     $('#destination').val(station1);
    // });
    // 直接入力していた場合の値をhiddenに入れる．
    // $('#submit').on('click', function(){
    //     if($('#departure').val()==""){
    //         var station0 = $('#station0\\:stationInput').val();
    //         $('#departure').val(station0);
    //     }
    //     if($('#destination').val()==""){
    //         var station1 = $('#station1\\:stationInput').val();
    //         $('#destination').val(station1);
    //     }
    // });
    
    // 削除ボタンを押したら確認アラート表示
    $('.delete').on('click', function () {
        if(window.confirm("削除しますか?")) {
            location.href = $(this).attr('href');
        } else {
            return false;
        }
    });

    // 検索ボタンをクリック時にフォーム表示
    $('#search').on('click', function () {
        $('#modal_search').modal('show');
    });

    // 一覧ページで追加ボタンをクリック時にフォーム表示
    $('#add_article').on('click', function () {
        $('#modal_add_article').modal('show');
    });

    // 詳細ページで追加ボタンをクリック時にフォーム表示
    $('#add_record').on('click', function () {
        $('#modal_add_record').modal('show');
    });

    // 詳細の並び替えをできるようにする処理
    $('#sortable').sortable({
        // y軸のみ移動
        axis: 'y',
        handle: 'span',
        update: function(event,ui){
            // 読み込んだレコードのidを順番通り配列に入れる処理    
            var str = $('#std_id').text();
            str = str.slice( 1, -1 );
            var std_id = str.split(',');
            // 変更後の順番を入れる配列
            var new_id = [];
            $('.j_id').each(function(i){
                var text = $(this).text();
                new_id.push(text);
            });
            
            // 変化分のみSQLリクエスト
            // 並び替え前後の配列で変化したもののみ抽出した配列をつくる
            var diff_std = [];
            var diff_cgd = [];
            for(i = 0; i < std_id.length; i++){
                var diff = std_id[i] - new_id[i];
                if(diff !=0){
                    diff_std.push(std_id[i]);
                    diff_cgd.push(new_id[i]);
                }
            }
            // 変化分のみの処理ここまで

            // 新しく入れ替えた順番のみを配列にしたものを文字列に入れる
            // var dft_id = std_id.join();
            var dft_id = diff_std.join();
            // var cgd_id = new_id.join();
            var cgd_id = diff_cgd.join();
            // 各順番をhidden要素に入れる
            $('#now_num').val(dft_id);
            $('#new_num').val(cgd_id);
            $('#sort').submit();
            // テスト用
            // $('#test1').text(dft_id);
            // $('#test2').text(cgd_id);
        }
    });
    $('#sortable').disableSelection();
    // 並び替えここまで

    // コメントのアイコンをクリックするとコメント内容を表示
    $(document).on("click", ".show_comment", function(){
        // alert("test");
        $(this).parents('.record').find('.comment_pics').slideToggle();
    });

});