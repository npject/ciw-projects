var firstNumber;
var globalType;
var secondNumber;
var fsNumber;
var flag = false;
function calc(numb){
    if(firstNumber && !flag){
        document.querySelector('#display').value = '';
        flag = true    
    }
    document.querySelector('#display').value += numb;
    if(fsNumber && !flag){
        document.querySelector('#display').value = '';
        flag = true    
    }
}
function oprate(type){
    if(type != 'res'){
        if (flag !=true) {
            firstNumber = document.querySelector('#display').value;
            globalType = type;
        }else{
            fsNumber = document.querySelector('#display').value;
            switch (globalType) {
                case 'inc':
                        firstNumber = +firstNumber + +fsNumber;
                    break;
                case 'dec':
                    firstNumber = +firstNumber - +fsNumber;
                    break;
                case 'multi':
                    firstNumber = +firstNumber * +fsNumber;
                    break;
                case 'division':
                    firstNumber = +firstNumber / +fsNumber;
                    break;
                default:
                    break;
            }
            flag = false
        }
    }else{
        secondNumber = document.querySelector('#display').value;
        switch (globalType) {
            case 'inc':
                    document.querySelector('#display').value = +firstNumber + +secondNumber;
                break;
            case 'dec':
                    document.querySelector('#display').value = +firstNumber - +secondNumber;
                break;
            case 'multi':
                    document.querySelector('#display').value = +firstNumber * +secondNumber;
                break;
            case 'division':
                    document.querySelector('#display').value = +firstNumber / +secondNumber;
                break;
            default:
                break;
        }
    }
}
function clean(){
    document.querySelector('#display').value = '';
    firstNumber = 0;
    secondNumber = 0;
    fsNumber = 0;
    globalType = '';
    flag = false
}