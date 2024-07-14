(function ($) {
  "use strict";

  class Home {
    constructor() {
      const _this = this;
      // mobile menu toggle
      $(document).on("click", ".hamburger-menu, .menu-close", function (e) {
        $(".menu-container").toggleClass("-right-full right-0");
      });

      // menu items toggle
      $(".mobile-menu-item").click(function (e) {
        if ($(window).width() < 768) {
          const self = $(this);
          $(this)
            .siblings(".labell-sub-menu")
            .slideToggle(function () {
              if ($(this).is(":visible")) {
                self
                  .find(".pixxelicon-chevron-down")
                  .addClass("rotate-180 duration-200");
                $(this).css("display", "flex");
              } else {
                self
                  .find(".pixxelicon-chevron-down")
                  .removeClass("rotate-180 duration-200");
              }
            });

          $(this)
            .siblings(".mega-submenu-container")
            .find(".haal-sub-menu")
            .slideToggle(function () {
              if ($(this).is(":visible")) {
                self
                  .find(".haalicon-arrow-bottom")
                  .addClass("rotate-180 duration-200");
                $(this).css("display", "flex");
              } else {
                self
                  .find(".haalicon-arrow-bottom")
                  .removeClass("rotate-180 duration-200");
              }
            });
        }
      });
      this.stretchMegaMenu();

      // faq toggle
      $(document).on("click", ".faq-tab-item", function (e) {
        if ($(this).find("i").hasClass("rotate-180")) {
          $(this).parent().find(".faq-tab-content").slideUp();
          $(this).find("i").removeClass("rotate-180");
        } else {
          $(".faq-tab-content").slideUp();
          $(".faq-tab-item i").removeClass("rotate-180");
          const tab = $(this).parent();
          tab.find(".faq-tab-item i").addClass("rotate-180");
          tab.find(".faq-tab-content").slideDown();
        }
      });

      // seo toggle
      $(document).on("click", ".seo-tab-item", function (e) {
        $(this).parent().find(".seo-tab-content").slideToggle();
        $(this).find("i").toggleClass("rotate-180");
      });

      // input number
      // max input typing
      $(document).on("input", ".input-number , .phone-number", function (e) {
        let value = $(this).val();
        // Remove any non-numeric characters
        value = _this.p2e(_this.a2e(value));
        value = value.replace(/\D/g, "");
        if ($(this).hasClass("phone-number")) {
          value = value.slice(0, 11);
        }
        $(this).val(value);
      });

      // select chevron rotate
      $("form select").on("focus", function (e) {
        $(this).parent().find("i").addClass("rotate-180");
      });

      $("form select").on("blur", function () {
        $(this).parent().find("i").removeClass("rotate-180");
      });
      $("form select").on("mousedown touchstart", function (e) {
        if ($(this).is(":focus")) {
          $(this).parent().find("i").toggleClass("rotate-180");
        }
      });
      $("form select").on("change", function () {
        $(this).parent().find("i").removeClass("rotate-180");
      });
    }

    stretchMegaMenu() {
      let windowWidth = $(window).width();
      if (windowWidth > 768) {
        if (windowWidth > 1280) windowWidth = 1280;
        console.log($(".stretch-megamenu").width());
        const extendOffset = (windowWidth - $(".stretch-megamenu").width()) / 2;
        $(".stretch-megamenu").css({
          width: windowWidth + "px",
          right: "-" + extendOffset + "px",
        });
      } else {
        // $(".stretch-megamenu").css({
        //   width: "auto",
        //   right: "auto",
        // });
      }
    }

    p2e = (s) => s.replace(/[۰-۹]/g, (d) => String("۰۱۲۳۴۵۶۷۸۹".indexOf(d)));

    a2e = (s) => s.replace(/[٠-٩]/g, (d) => String("٠١٢٣٤٥٦٧٨٩".indexOf(d)));
  }

  const home = new Home();
})(jQuery);
