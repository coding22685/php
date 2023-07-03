document.querySelector('.hamburger').addEventListener('click', (e) => {
    var header = document.getElementById("iframewrap");
    var main = document.getElementById("content-wrapper");
    if (main.style.visibility == 'visible') {
        $("#menubar").attr("src", "/img/menu_white.png");
        $("#youtube").attr("src", "/img/youtube_white.png");
        header.style.visibility = 'visible';
        main.style.visibility = 'hidden';
    } else {
        $("#menubar").attr("src", "/img/menu.png");
        $("#youtube").attr("src", "/img/youtube.png");
        header.style.visibility = 'hidden';
        main.style.visibility = 'visible';
    }
	    e.currentTarget.classList.toggle('is-active');
    })