document.addEventListener("DOMContentLoaded",function (){
    let getProducts = async ()=>{
        try {
            const res = await fetch('http://127.0.0.1:8000/api/products',{
                method : "GET",
                headers : {
                    "Content-type" : "application/json"
                }
            })
            const result = await res.json()
            console.log(result.data)
            result.data.map(product=>{
                let col = `
                    <div class="col">
                <div class="card shadow-sm">
                    <img src="${product.image.indexArray.medium}" />

                    <div class="card-body">
                        <p class="card-text">${product.name}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>
                `
                let productsContainer = document.getElementById('products')
                productsContainer.innerHTML += col
            })
        }catch (error){
            console.log(error)
        }
    }
    getProducts()
})
