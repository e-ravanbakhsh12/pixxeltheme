(function ($) {
  "use strict";

  class ProductList {
    constructor() {
      const _this = this;
      this.searchTimeout;
      this.isSearching=false;

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
        url: pixxelArr.homeUrl + "/wp-ajax/product-list/filter",
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
          window.dispatchEvent(new CustomEvent('queryLoaded', { detail: { container: $(".products-list").get(0) } }))
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
        <div class="w-full flex flex-col p-3 md:pb-6 bg-white rounded-2xl group-1">
          <div class="w-full flex items-center justify-between">
              <div class="flex items-center gap-2">
                  <span class="size-5 rounded-full border-2 skeleton"></span>
                  <span class="size-5 rounded-full border-2 skeleton"></span>
              </div>
              <div class="rounded-full h-5 w-20 skeleton "></div>
          </div>
          <div class="w-full aspect-square rounded-xl skeleton mt-4"></div>
          <div class="w-2/3  h-8 rounded-lg skeleton mt-4"></div>
          <div class="mt-2 h-4 md:h-6 rounded-md skeleton w-full"></div>
          <div class="mt-2 h-4 md:h-6 rounded-md skeleton w-full"></div>
        </div>
        `
        
      }
      $(selector).html(skeleton);
    }
  }

  const productList = new ProductList();
})(jQuery);
