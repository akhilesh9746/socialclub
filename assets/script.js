function prevPage(obj) {
    obj.selectedIndex = obj.selectedIndex - 1;
    obj.form.submit();
}
function nextPage(obj) {
    obj.selectedIndex = obj.selectedIndex + 1;
    obj.form.submit();
}
