document.addEventListener('DOMContentLoaded', function() {
    const choosePlaylistSelect = document.getElementById('choosePlaylistSelect');
    choosePlaylistSelect.addEventListener('change', function() {
        window.location.href = "/list?playlist=" + this.value;
    });
});