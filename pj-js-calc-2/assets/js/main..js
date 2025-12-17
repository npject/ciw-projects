function calc(numb){
    document.querySelector('#display').value += numb;
}
function oprate(){
    document.querySelector('#display').value = eval(document.querySelector('#display').value);
}
function clean(){
    document.querySelector('#display').value = '';
}