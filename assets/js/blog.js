(function ($) {
  "use strict";

  class Blog {
    constructor() {
      const _this = this;

        const relatedPost = new Splide(".splide-related-blog", {
          // type: "loop",
          direction: "rtl",
          // drag:'free',
          autoplay: true,
          arrows: true,
          gap: 16,
          perPage: 2,
          mediaQuery: "min",
          breakpoints: {
            768: {
              perPage: 4,
            },
            340: {
              perPage: 2,
            },
          },
        });
        relatedPost.mount();
    }
  }

  const blog = new Blog();
})(jQuery);