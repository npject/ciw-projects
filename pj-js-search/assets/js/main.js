let arr =['Cat','dog','butterFly','lion','Tiger','spider','Bat','horse'];
for(let i = 0; i< arr.length; i++){
    document.querySelector('#main #box-search').innerHTML += '<li class="list-group-item">' + arr[i] + '</li>';
}
function search(tag){
    let val = tag.value.toLowerCase();
    let items = document.querySelectorAll('.list-group-item');
    items.forEach(item =>{
        if (item.innerText.toLowerCase().indexOf(val) > -1){
            item.style.display = 'block';
        }else{
            item.style.display = 'none';
        }
    })    
}