(function ($) {
  "use strict";

  class Project {
    constructor() {
      const _this = this;

      const gallery = new Splide('.splide-project', {
        type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: true,
        arrows: true,
        perPage: 1,
        gap: 20,

      });
      gallery.mount();
      
        $(".thumbnails img")
        .on("click", function (e) {
          $(this)
            .parent()
            .find("img")
            .removeClass("border-magenta")
            .addClass("border-transparent");
          $(this).addClass("border-magenta").removeClass("border-transparent");
          const number = Number($(this).attr("item"));
          gallery.go(number);
        });

        const testimonialGallery = new Splide(".splide-testimonial", {
          type: "loop",
          direction: "rtl",
          // drag:'free',
          autoplay: true,
          arrows: true,
          gap: 16,
          perPage: 1,
        });
        testimonialGallery.mount();

        const relatedPost = new Splide(".splide-related-project", {
          // type: "loop",
          direction: "rtl",
          // drag:'free',
          autoplay: true,
          arrows: true,
          gap: 16,
          perPage: 2,
        });
        relatedPost.mount();
    }
  }

  const project = new Project();
})(jQuery);
