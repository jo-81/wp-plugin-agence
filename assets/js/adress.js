(function($) {
    $(document).ready(function () {
        // Requete pour l'API adresse
        $("[data-adresse]").on("propertychange input", function (e) {
            let search = e.target.value.trim();

            if (search.length < 4 || !search) {
                $("#js-result-adress").html('');
                return;
            }

            $.ajax({
                url: admin_ajax_adress.ajax_url,
                method: "POST",
                data: {
                    action: "get_request_adress",
                    search: search,
                    nonce: admin_ajax_adress.nonce
                },
                success: function (data) {
                    if (data.success) {

                        let list = "";
                        data.data.forEach(function(elt) {
                            list += "<div class='card-adress'>"+ elt.label +"</div>";
                        })

                        $("#js-result-adress").html(list);

                        $(".card-adress").on("click", function () {
                            $("[data-adresse]").val($(this).text());
                            $("#js-result-adress").html("");
                        });
                    }
                },
                error: function (data) {
                    console.log(data);
                },
            });
        });
    });

})(jQuery)