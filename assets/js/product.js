(function ($) {
  "use strict";

  class Product {
    constructor() {
      const _this = this;

      $(document).on("click", ".toggle-tab", function (e) {
        const name = $(this).data("tab");
        if ($(this).find("i").hasClass("rotate-180")) {
          $(this).parents(".toggle-row").find(".toggle-content").slideUp();
          $(this).find("h3").removeClass("text-blue-main");
          $(this).find("i").removeClass("rotate-180");
        } else {
          $(".toggle-content").slideUp();
          $(".toggle-tab i").removeClass("rotate-180");
          $(".toggle-tab h3").removeClass("text-blue-main");

          $(this).parents(".toggle-row").find(".toggle-content").slideDown();
          $(this).find("h3").addClass("text-blue-main");
          $(this).find("i").addClass("rotate-180");
        }
      });

      $(document).on('click','.color-item',function(e){
        $('.color-item').removeClass('ring-1').addClass('ring-0');
        $('.color-item i').removeClass('flex-center').addClass('hidden');
        $(this).addClass('ring-1').removeClass('ring-0');
        $(this).find('i').addClass('flex-center').removeClass('hidden');
        $(this).parent().attr('data-selected',$(this).data('value'))

      })

      const gallery = new Splide('.splide-product-img', {
        type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: false,
        arrows: false,
        perPage: 1,
        gap: 20,
        // pagination:false,
      });
      gallery.mount();
      gallery.on('moved', function(e) {  
        $('.thumbnails img').removeClass('border-blue-main').addClass('opacity-50 border-midnight-50');
        $(`.thumbnails img[data-item="${e}"]`).addClass('border-blue-main').removeClass('opacity-50 border-midnight-50');
    });  
      $(document).on("click",'.thumbnails img', function (e) {
          $('.thumbnails img').removeClass('border-blue-main').addClass('opacity-50 border-midnight-50');
          $(this).addClass('border-blue-main').removeClass('opacity-50 border-midnight-50');
          const number = Number($(this).data("item"));
          gallery.go(number);
        });

      const consultantList = new Splide(".consultant-slider", {
        // type: "loop",
        direction: "rtl",
        // drag:'free',
        // autoplay: true,
        arrows: true,
        gap: 16,
        focus: "center",
        start: 1,
        perPage: "auto",
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: 3,
          },
          340: {
            perPage: "auto",
          },
        },
      });
      consultantList.mount();
    }
  }

  let product = new Product();
})(jQuery);
