//<!--===============================================================================================-->
const menuButton = document.getElementById('menuButton');
const sidebar = document.getElementById('sidebar');
const main = document.querySelector('.main');

menuButton.addEventListener('click', () => {
    if(screen.width < 768){
        sidebar.classList.toggle('d-none');
        sidebar.classList.toggle('d-flex');
    }
    else{
        sidebar.classList.toggle('d-md-flex');
        if(sidebar.classList.contains('d-md-flex')){
            main.style.marginLeft = '300px';
        }
        else{
            main.style.marginLeft = '0px';
        }
    }
});

function resize(){
    if(screen.width < 768 & sidebar.classList.contains('d-none')){
        main.style.marginLeft = '0px';
    }
    else if(screen.width > 768 & sidebar.classList.contains('d-flex')){
        main.style.marginLeft = '300px';
        sidebar.classList.remove('d-flex');
        sidebar.classList.add('d-none');
    }

    else if(screen.width > 758 & sidebar.classList.contains('d-none') & sidebar.classList.contains('d-md-flex')){
        main.style.marginLeft = '300px';
    }
}

window.addEventListener('resize', resize);
//<!--===============================================================================================-->
const closeButton = document.getElementById('closeButton');

closeButton.addEventListener('click', () => {
    sidebar.classList.remove('d-flex');
    sidebar.classList.add('d-none');
})
