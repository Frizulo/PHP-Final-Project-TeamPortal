document.getElementById('login').addEventListener('click', function() {
    sessionStorage.setItem('start', 'folder1');
});

document.getElementById('apply').addEventListener('click', function() {
    sessionStorage.setItem('start', 'folder2');
});