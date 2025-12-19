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