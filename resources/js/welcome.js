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

    function getProducts(paginate,sort) {
        const form = $('#filter-form').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form + "&" + $.param({paginate: paginate})+ "&" + $.param({sort: sort}),
        })
            .done(function( response ) {
                $('#products_wrapper').empty();
                $('#products-count').text(response.data.length);
                $.each(response.data,function (index,product){
                    const  html = ' <div class="col-6 col-md-6 col-lg-4 mb-3">\n' +
                        '                                <div class="card h-100 border-0">\n' +
                        '                                    <div class="card-img-top">\n' +
                        '                                            <img src="'+ getImage(product) +'" class="img-fluid mx-auto d-block" alt="Zdjęcie Produktu">\n' +
                        '                                    </div>\n' +
                        '                                    <div class="card-body text-center">\n' +
                        '                                        <h4 class="card-title">\n' +
                                                                    product.name +
                        '                                        </h4>\n' +
                        '                                        <h5 class="card-price small">\n' +
                        '                                            <i>\n' +
                        '                                               PLN '+product.price +'</i>\n' +
                        '                                        </h5>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>'
                    $('#products_wrapper').append(html);
                })

            })
    }

    function getImage(product){
        if(product.image_path){
            return storagePath + product.image_path;
        }
        return defaultImage;
    }
});
