(function ($) {
  "use strict";

  class Blog {
    constructor() {
      const _this = this;

        const relatedPost = new Splide(".splide-related-blog", {
          // type: "loop",
          direction: "rtl",
          // drag:'free',
          autoplay: false,
          arrows: false,
          gap: 16,
          perPage: 'auto',
          mediaQuery: "min",
          breakpoints: {
            768: {
              perPage: 'auto',
            },
            340: {
              perPage: 'auto',
            },
          },
        });
        relatedPost.mount();
    }
  }

  const blog = new Blog();
})(jQuery);
