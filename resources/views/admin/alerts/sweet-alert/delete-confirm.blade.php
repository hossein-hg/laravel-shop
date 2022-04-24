<script>
    $(document).ready(function (){
        let className = '{{$className}}'
        let element = $('.'+className);
        element.on('click',function (e){
            e.preventDefault();
            const swalWithSweetalertButton = Swal.mixin({

                customClass:{
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling : false,

            });

            swalWithSweetalertButton.fire({
                title: 'ایا از حذف کردن مطمین هستید؟',
                text: "شما می توانید درخواست خود را لغو کنید",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'بله',
                cancelButtonText : 'خیر درخواست لغو شود'
            }).then((result) => {

                    if (result.value === true)
                    {

                        $(this).parent().submit();
                    }
                    else if (result.dismiss === 'cancel')
                    {

                        swalWithSweetalertButton.fire({
                            title: 'لغو درخواست',
                            text: "درخواست لغو شد",
                            icon: 'success',
                            confirmButtonText:'باشه'
                            }

                        )

                    }


            })


        })
    })
</script>
