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
        focus:'center',
        perPage: "auto",
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: "auto",
          },
          340: {
            perPage: "auto",
          },
        },
      });
      relatedPost.mount();

      // view counter
      $(document).ready(function () {
        _this.viewCount();
      });
    }

    viewCount() {
      const arg = {
        id: $(".blog-container").data("blog-id"),
      };
      console.log(arg);
      const formData = new FormData();
      formData.append("data", JSON.stringify(arg));
      $.ajax({
        url: pixxelArr.homeUrl + "/wp-ajax/blog/view-post",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        mode: "no-cors",
        type: "POST",
        success: function (response) {
          if (response.success) {
          } else {
          }
        },
      });
    }
  }

  const blog = new Blog();
})(jQuery);
