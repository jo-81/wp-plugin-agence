(function($) {

    $(document).ready(function () {

        let current_indice = 0;
        let images = $(".slide");

        $('#prev').click(function() {
            displayImage(-1);
        })

        $("#next").click(function () {
            displayImage(1);
        });

        let displayImage = function(indice) {
            let number_image = images.length;
            current_indice += indice;

            if (current_indice < 0) {
                current_indice = number_image - 1;
            }

            if (current_indice > number_image - 1) {
                current_indice = 0;
            }

            images.each(function(index, value) {
                if (index == current_indice) {
                    value.classList.add('show')
                } else {
                    value.classList.remove("show");
                }
            })
        }

        $('#close-alert').click(function() {
            $(this).parent().remove();
        })

    })

})(jQuery)