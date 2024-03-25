function editRecord(prefecture) {
    //編集が押されたら都道府県をhidden項目[prefecture]に記録番号をセットしてsubmit
    document.edit_form.prefecture.value = prefecture; 
    document.edit_form.submit();
}

    //javascriptでform内のhidden項目[prefecture]に都道府県をセットしてsubmitする
    function deleteRecord(prefecture) {
        //削除確認ダイアログ表示
        if (!window.confirm('[' + prefecture + ']の記録を削除してよろしいですか?')) {
            //キャンセルが押されたら処理終了
            return false;
        }
    //OKが押されたら記録番号をhidden項目[prefecture]にセットしてsubmit
        document.delete_form.prefecture.value = prefecture; 
        document.delete_form.submit();
    }