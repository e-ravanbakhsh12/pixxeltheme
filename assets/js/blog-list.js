(function ($) {
  "use strict";

  class BlogList {
    constructor() {
      const _this = this;
      this.searchTimeout;
      this.isSearching=false;

      const relatedPost = new Splide(".splide-popular-blog", {
        type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: false,
        arrows: false,
        gap: 16,
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

      $(document).on("click", ".page-item", function (e) {
        _this.updateList($(this).attr("page"));
      });
      $(document).on("change", "#display-order", function (e) {
        _this.updateList();
      });
      $(document).on("change keyup pest", "#search-blog", function (e) {
        e.preventDefault();
        clearTimeout(_this.searchTimeout);
        _this.searchTimeout = setTimeout(() => {
          _this.updateList();
        }, 800);
        
      });
    }

    updateList(page = 1) {
      const _this = this;
      if(_this.isSearching) return;
      _this.isSearching=true;
      const order = $("#display-order").val();
      const search = $("#search-blog").val();
      const arg = {
        order,
        search,
        page,
        url: location.href,
      };
      _this.generateLoading('.products-list');
      $('.pixxel-pagination >div').addClass('skeleton');
      $('.pixxel-pagination .page-item').addClass('invisible');
      const formData = new FormData();
      formData.append("data", JSON.stringify(arg));
      $.ajax({
        url: pixxelArr.homeUrl + "/wp-ajax/blog-list/filter",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        mode: "no-cors",
        type: "POST",
        success: function (response) {
          _this.isSearching=false;
          if (response.success) {
            if(response.content.list.length){
              $('.products-list').html(response.content.list);
              $('.pagination').html(response.content.pagination);
              const newUrl = response.content.url;
              if (history.pushState) {
                history.pushState(null, null, newUrl);
              } else {
                window.location.href = newUrl;
              }
            }
          } else {
          }
        },
        error:function(response){
          $('.pixxel-pagination >div').removeClass('skeleton');
          $('.pixxel-pagination .page-item').removeClass('invisible');
          _this.isSearching=false;
        }
      });
    }

    generateLoading(selector,number=8){
      let skeleton= '';
      for (let i = 0; i < number; i++) {
        skeleton+=`
        <div class="w-full flex flex-col items-center rounded-2xl ">
          <div class="w-full h-[12.5rem] md:h-[12.rem] rounded-2xl skeleton"></div>
          <div class="min-h-9 md:max-h-12 mt-2 md:mt-6 w-full rounded-lg skeleton"></div>
          <div class="mt-auto w-full">
              <div class="mt-2 h-4 md:h-6 rounded-md skeleton w-full"></div>
              <div class="mt-2 h-4 md:h-6 rounded-md skeleton w-4/5"></div>
          </div>
        </div>
        `
        
      }
      $(selector).html(skeleton);
    }
  }

  const blogList = new BlogList();
})(jQuery);
