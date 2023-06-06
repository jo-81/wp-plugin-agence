(function($) {
    // TABS
    $("[data-tab-url]").click(function() {

        let tab = this.getAttribute("data-tab-url");

        $("[data-tab-url]").each(function(index, value) {
            if (value.getAttribute("data-tab-url") == tab) {
                value.classList.add('active-tab')
            } else {
                value.classList.remove("active-tab");
            }
        })

        $("[data-tab-section]").each(function(index, value) {
            if (value.getAttribute("data-tab-section") == tab) {
                value.classList.remove('hidden')
            } else {
                value.classList.add("hidden");
            }
        })
    })

})(jQuery)
