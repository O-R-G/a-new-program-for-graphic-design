/* 
    100vh doesn't work properly on phone when the browser toolbar expands/folds. 
    using javacscript to force it.
*/
let full_vh = document.getElementsByClassName('full-vh');
if(full_vh.length) {
    function adjustFullVh(full_vh){
        for(let i = 0; i < full_vh.length; i++) {
            full_vh[i].style.height = window.innerHeight + 'px';
        }
    }
    adjustFullVh(full_vh);
    window.addEventListener('resize', function(){
        adjustFullVh(full_vh);
    });
}