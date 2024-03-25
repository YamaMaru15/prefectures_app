function editRecord(prefecture) {
    document.edit_form.prefecture.value = prefecture; 
    document.edit_form.submit();
}

function deleteRecord(prefecture) {
    if (!window.confirm('[' + prefecture + ']の記録を削除してよろしいですか?')) {
        return false;
    }
    document.delete_form.prefecture.value = prefecture; 
    document.delete_form.submit();
}