var data = [];
for(i=0; i<6; i++){
    let objData = {id:i+1,title:'title-'.concat(i+1),content:'content-'.concat(i+1),image:'assets/img/Image-'.concat(i+1,'.jpg'),date:new Date().toLocaleString('fa')}
    data.push(objData) 
}
data.forEach(item=>{
    document.querySelector('.res').innerHTML += `
    <div class="col-lg-3 my-2">
        <div class="card">
            <img src="${item.image}" class="card-img-top"></img>
            <div class="card-body">
                <h5 class=card-title>${item.title}</h5>
                <p class="card-text">${item.content}</p>        
                <p class="card-text">${item.date}</p>
                <button class="btn btn-danger" onclick="removeItem(${item.id},event)">remove</button>        
            </div>
        </div> 
    </div>
    `     
})
var indexData = 6;
//document.querySelector('#add').addEventListener('click')  
function addToList(){
    let title = document.querySelector('#title-todo')
    let content = document.querySelector('#content-todo')
    let titleTodo = title.value.trim();
    let contentTodo = content.value.trim();
    let isValidate = true;
    [title,content].forEach(itemTodo=>{
        if(!itemTodo.value.trim()){
            itemTodo.classList.add('is-invalid')
            isValidate = false;
        }else{
            itemTodo.classList.remove('is-invalid');
        }
    })
    indexData = indexData +1;
    let newData ={
        id:indexData,
        title:titleTodo,
        content:contentTodo,
        image:'assets/img/Image-6.jpg',
        date:new Date().toLocaleString('fa')}
    if(isValidate){
        data.push(newData)
        document.querySelector('.res').innerHTML += `
        <div class="col-lg-3 my-2">
            <div class="card">
                <img src="${newData.image}" class="card-img-top"></img>
                <div class="card-body">
                    <h5 class=card-title>${titleTodo}</h5>
                    <p class="card-text">${contentTodo}</p>        
                    <p class="card-text">${newData.date}</p>
                    <button class="btn btn-danger" onclick="removeItem(${newData.id},event)">remove</button>        
                </div>
            </div> 
        </div>
        `
    } 
}
function removeItem(idItem,ev){
    data = data.filter(item=> item.id != idItem);
    ev.target.parentElement.parentElement.parentElement.remove();
}
console.log(data)
console.log(...data)