/* ===========================
   Fetch Products (Home Page)
=========================== */
async function getData() {
    var loading = true;
    for (let index = 0; index < 8; index++) {
        document.querySelector('.res').innerHTML += `
        <div class="col-lg-3 my-2 skeleton-loading">
            <div class="card">
                <div class="placeholder-glow">
                    <div class="col-12 placeholder card-img-top"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="col-5 placeholder"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="col-3 placeholder"></span>    
                    </p>        
                    <p class="card-text placeholder-glow">
                        <span class="col-2 placeholder"></span>
                    </p>        
                </div>
            </div> 
        </div>
        `
    }
    try {
        let fetchData = await fetch('https://fakestoreapi.com/products', {
            method: "GET"
        });
        let data = await fetchData.json();
                loading = false;
                document.querySelectorAll('.skeleton-loading').forEach(items => {
                    items.remove();
                })
                data.forEach(item => {
                    document.querySelector('.res').innerHTML += `
                    <div class="col-lg-3 my-2">
                        <div class="card">
                            <a href="single.html?id=${item.id}" target="_blank">
                                <img src="${item.image}" class="card-img-top object-fit-contain"></img>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">${item.title}</h5>
                                <p class="card-text">${item.category}</p>        
                                <p class="card-text">${item.price}</p>        
                            </div>
                        </div> 
                    </div>
                    `
                })
    } catch (error) {
        console.log('error:::::', error);
        loading = false;
        if (!loading) {
            document.querySelectorAll('.skeleton-loading').forEach(items => {
                items.remove();
            })
        }
    }
}
/* ===========================
   Single Product Logic
=========================== */
var dataSingle;
async function getDataSingle() {
    let params = new URLSearchParams(document.location.search);
    let idProduct = params.get('id');
    var loading = true;
    document.querySelector('.res-single').innerHTML += `
        <div class="col-lg-12 my-2 skeleton-loading">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 text-center placeholder-glow">
                        <img src="" class="img-fluid object-fit-contain rounded-start img-single placeholder w-100"></img>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body text-body-secondary h-100 d-flex flex-column justify-content-center placeholder-wave">
                            <h5 class="card-title text-truncate text-black placeholder col-2"></h5>
                            <p class="card-text"><span class="text-body-tertiary">category: </span><span class="placeholder col-1"></span></p>        
                            <p class="card-text"><span class="text-body-tertiary">description: </span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-5"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-5"></span>
                            </p>        
                            <p class="card-text"><span class="text-body-tertiary">price: </span><span class="placeholder col-1"></span></p>        
                            <p class="card-text"><span class="text-body-tertiary">rate: </span><span class="placeholder col-1"></span></p>        
                            <p class="card-text"><span class="text-body-tertiary">count: </span><span class="placeholder col-1"></span></p>
                            <div class="btn-toolbar">
                                <div class="btn-group me-2">
                                    <button class="btn btn-secondary disabled">-</button>
                                    <button class="btn btn-secondary disabled">1</button>
                                    <button class="btn btn-secondary disabled">+</button>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-success disabled">add to cart</button>
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>  
            </div> 
        </div>
        `
    try {
        let fetchData = await fetch(`https://fakestoreapi.com/products/${idProduct}`, {
            method: "GET"
        });
        let data = await fetchData.json();
                dataSingle = data;
                loading = false;
                document.querySelector('.skeleton-loading').remove();
                document.querySelector('title').innerText = `${data.title}`
                document.querySelector('.res-single').innerHTML += `
                    <div class="col-lg-12 my-2">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="${data.image}" class="img-fluid object-fit-contain rounded-start img-single"></img>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-body-secondary h-100 d-flex flex-column justify-content-center">
                                        <h5 class="card-title text-black">${data.title}</h5>
                                        <p class="card-text"><span class="text-body-tertiary">category: </span>${data.category}</p>        
                                        <p class="card-text"><span class="text-body-tertiary">description: </span>${data.description}</p>        
                                        <p class="card-text"><span class="text-body-tertiary">price: </span>${data.price}</p>        
                                        <p class="card-text"><span class="text-body-tertiary">rate: </span>${data.rating.rate}</p>        
                                        <p class="card-text"><span class="text-body-tertiary">count: </span>${data.rating.count}</p>
                                        <div class="btn-toolbar">
                                            <div class="btn-group me-2">
                                                <button class="btn btn-secondary" disabled id="btn-dec" onclick="countAdd('dec')">-</button>
                                                <button class="btn btn-secondary" id="countAddTo">1</button>
                                                <button class="btn btn-secondary" onclick="countAdd('inc')">+</button>
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn btn-success" onclick="addToCart()">add to cart</button>
                                            </div>
                                        </div>        
                                    </div>
                                </div>
                            </div>  
                        </div> 
                    </div>
                    `
    } catch (error) {
        console.log('error:::::', error);
        loading = false;
        if (!loading) {
            document.querySelector('.skeleton-loading').remove();
        }
    }

}
/* ===========================
   Cart Items Management
=========================== */
function getDataCart(){
    let dataCart = JSON.parse(localStorage.getItem('cartItems'));
    if(dataCart.length == 0){
        document.querySelector('.res-cart').innerHTML = `
        <div class="alert alert-danger">Cart is empty !</div>
        `
    }else{
        dataCart.forEach(item => {
            document.querySelector('.res-cart').innerHTML += `
            <div class="col-lg-3 my-2">
                <div class="card">
                    <a href="single.html?id=${item.id}" target="_blank">
                        <img src="${item.image}" class="card-img-top object-fit-contain"></img>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-truncate">${item.title}</h5>
                        <p class="card-text">${item.category}</p>        
                        <p class="card-text">${item.price}</p>
                        <i class="fa-solid fa-trash fs-4 text-danger" onclick="removeItemCart(event,${item.id})"></i>        
                    </div>
                </div> 
            </div>
            `
        })
    
    }
}
function removeItemCart(ev,idCartItem){
    ev.currentTarget.parentElement.parentElement.parentElement.remove();
    let dataCart = JSON.parse(localStorage.getItem('cartItems'));
    let newDataCart = dataCart.filter(item => item.id != idCartItem);
    localStorage.setItem('cartItems',JSON.stringify(newDataCart));
    getCountCart();
    if(newDataCart.length == 0){
        document.querySelector('.res-cart').innerHTML = `
        <div class="alert alert-danger">Cart is empty !</div>
        `
    }
}
/* ===========================
   Add To Cart & Counter
=========================== */
function addToCart(){
    debugger
    const toast = document.querySelector('#toastAdd');
    const toastContent = document.querySelector('#toastAdd .toast-body');
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
    let dataCart = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')) : [];
    let findData = dataCart.find(item => item.id == dataSingle.id);
    if(findData){
        toastContent.innerText = `item is exist...`
        toast.classList.remove('text-bg-success');
        toast.classList.add('text-bg-warning');
        toastBootstrap.show();    
        return;
    }
    dataCart.push(dataSingle);
    localStorage.setItem('cartItems',JSON.stringify(dataCart));
    getCountCart();
    toastContent.innerText = `item is added to cart.`
    toastBootstrap.show();
}
function getCountCart(){
    let count = localStorage.getItem('cartItems') ? JSON.parse(localStorage.getItem('cartItems')).length : 0;
    document.querySelector('#count-cart').innerText = count;
}
getCountCart();
/* ===========================
   Product Quantity Control
=========================== */
function countAdd(key){
    let countAddTo = document.querySelector('#countAddTo').innerText;
    switch (key) {
        case 'inc':
            document.querySelector('#countAddTo').innerText = +countAddTo + 1;
            //document.querySelector('#btn-dec').classList.remove('disabled');
            document.querySelector('#btn-dec').removeAttribute('disabled');
            break;
        case 'dec':
            document.querySelector('#countAddTo').innerText = +countAddTo - 1;
            if(countAddTo == 2){
                //document.querySelector('#btn-dec').classList.add('disabled');
                document.querySelector('#btn-dec').setAttribute('disabled','');
            }
            break;
    }
}
/* ===========================
   Live Clock
=========================== */
setInterval(()=>{
    let time = new Date().toLocaleTimeString('fa');
    document.querySelector('.timer').innerText = time;
},1000)