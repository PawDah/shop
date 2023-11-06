$(function (){
    $('div.products-count a').click(function () {
        $('a.products-actual-count').text($(this).text());
        getProducts($(this).text(), $('a.products-actual-sort').text());
    });

    $('div.products-sort a').click(function () {
        $('a.products-actual-sort').text($(this).text());
        getProducts($('a.products-actual-count').first().text(),$(this).text());
    });

    $('a#filter-button').click(function (){
        getProducts($('a.products-actual-count').first().text(),$('a.products-actual-sort').text());
    })
    $('button.add-cart-button').click(function (e){
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: WELCOME_DATA.addToCart + $(this).data('id')
        })
            .done(function (){
                Swal.fire({
                    title: 'Udało się!',
                    text: 'Produkt dodany do koszyka',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<i class="fas fa-cart-plus"></i> Przejdź do koszyka',
                    cancelButtonText: ' <i class="fas fa-shopping-bag"></i> Kontnuuj zakupy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location=WELCOME_DATA.listCart
                    }
                })
            })
            .fail(function (data){
                Swal.fire('Oops...','Wystątpił błąd','error');
            })
    })

    function getProducts(paginate,sort) {
        const form = $('#filter-form').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form + "&" + $.param({paginate: paginate})+ "&" + $.param({sort: sort}),
        })
            .done(function( response ) {
                console.log(WELCOME_DATA.defaultImage)
                $('#products_wrapper').empty();
                $('#products-count').text(response.data.length);
                $.each(response.data,function (index,product){
                    const html = ' <div class="col-6 col-md-6 col-lg-4 mb-3">\n' +
                        '                                <div class="card h-100 border-0">\n' +
                        '                                    <div class="card-img-top">\n' +
                        '                                            <img src="' + getImage(product) + '" class="img-fluid mx-auto d-block" alt="Zdjęcie Produktu">\n' +
                        '                                    </div>\n' +
                        '                                    <div class="card-body text-center">\n' +
                        '                                        <h4 class="card-title">\n' +
                        product.name +
                        '                                        </h4>\n' +
                        '                                        <h5 class="card-price small">\n' +
                        '                                            <i>\n' +
                        '                                               PLN ' + product.price + '</i>\n' +
                        '                                        </h5>\n' +
                        '<button style="cursor: pointer" type="button" class="btn btn-sm btn-primary add-cart-button"' + getDisabled() + ' data-id="'+product.id +'"> <i class="fas fa-cart-plus"></i> Dodaj do koszyka</button>' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>'
                    $('#products_wrapper').append(html);
                })

            })
    }

    function getImage(product){
        if(product.image_path){
            return WELCOME_DATA.storagePath + product.image_path;
        }
        return WELCOME_DATA.defaultImage;
    }
    function getDisabled(){
        if(WELCOME_DATA.isGuest){
            return 'disabled'
        }
        return '';
    }
});
