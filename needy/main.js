var logo = document.getElementsByClassName('app-name');
logo.array.forEach(e => {
    e.addEventListener('click',function () {
        alert('hello');
    })
});