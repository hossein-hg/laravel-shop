<script src={{asset("admin-assets/js/jquery-3.5.1.min.js")}}></script>
<script src={{asset("admin-assets/js/popper.js")}}></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src={{asset("admin-assets/js/bootstrap/bootstrap.min.js")}}></script>
<script src={{asset("admin-assets/js/grid.js")}}></script>
<script src={{asset("admin-assets/select2/js/select2.min.js")}}></script>
<script src={{asset("admin-assets/sweetalert/sweetalert2.js")}}></script>
<script>
    let notiDrop = document.getElementById('header-notification-toggle')
    let url = notiDrop.getAttribute('data-url')
    console.log(url)
    notiDrop.addEventListener('click',function (){
        $.ajax({
            method : "POST",
            url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:(res)=>{
                console.log(res)
            }

        })
    })
</script>
