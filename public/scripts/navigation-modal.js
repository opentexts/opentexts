document.getElementById('navigation-toggle').onclick = function(){
    document.getElementById('navigation-modal-wrapper').classList.toggle('modal-closed');
};

document.getElementById('navigation-close').onclick = function(){
    document.getElementById('navigation-modal-wrapper').classList.add('modal-closed');
};
