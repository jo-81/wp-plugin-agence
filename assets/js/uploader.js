(function($) {

    // Ouvre uploader de WP pour sélection images
    $("[data-add-picture]").on("click", function (e) {
      // var $el = $(this).parent();
      e.preventDefault();
      var uploader = wp
        .media({
          title: "Envoyer une image",
          button: {
            text: "Choisir un fichier",
          },
          multiple: true,
        })
        .on("select", function () {
          var selection = uploader.state().get("selection");
          var attachments = [];
          selection.map(function (attachment) {
            attachment = attachment.toJSON();
            attachments.push(attachment);
          });

          if ("content" in document.createElement("template")) {
            attachments.forEach(function (attachement) {
              includePicture(attachement);
            });
          }
        })
        .open();
    });

    // Ajoute les images dans balise template
    let includePicture = function(attachement) {
        const template = document.querySelector("#gallery");
        const gallery = document.querySelector("[data-gallery]");

        const clone = template.content.cloneNode(true);
        let img = clone.querySelector("img");
        img.setAttribute("src", attachement.url);

        let input = clone.querySelector('input');
        input.setAttribute('name', 'ag_property_gallery['+ attachement.id +']')

        gallery.appendChild(clone);
    }

    $(document).on("click", "[data-remove-picture]", function () {
      $(this).parent().remove();
    });

})(jQuery)