(function ($) {
  "use strict";

  class Home {
    constructor() {
      const _this = this;
      this.searchTimeout;
      // mobile menu toggle
      $(document).on(
        "click",
        ".hamburger-menu, .menu-close , .mobile-menu-overlay",
        function (e) {
          $(".mobile-menu-overlay").toggleClass("hidden");
          $(".menu-container").toggleClass("-right-full right-0");
        }
      );
      // search bar toggle
      $(document).on(
        "click",
        ".search-icon-container , .search-overlay, .close-search",
        function (e) {
          $(".search-overlay").toggleClass("hidden");
          $(".search-container").toggleClass("translate-y-[-150%]");
        }
      );

      // search action
      $(document).on("change pest keyup", "#main-search", function (e) {
        e.preventDefault();
        clearTimeout(_this.searchTimeout);
        _this.searchTimeout = setTimeout(() => {
          _this.searchRequest($(this));
        }, 800);
      });
      $(document).on("click", ".pixxelicon-trash", function (e) {
        $("#main-search").val("");
        $(".main-search-result-content").html("");
        $(".empty-result-container").html("");
        $(this).remove();
      });

      // menu items toggle
      $(".mobile-menu-item").click(function (e) {
        if ($(window).width() < 768) {
          const self = $(this);
          $(this)
            .siblings(".pixxel-sub-menu")
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
      // this.stretchMegaMenu();

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

    searchRequest(input) {
      const _this = this;
      const search = input.val();
      const container = $(".main-search-result-content");
      const emptyResult = $(".empty-result-container");
      const loading = input.parent().find("svg");
      emptyResult.addClass("hidden");
      container.html("");
      if (search.length > 2) {
        input.parent().find("svg").removeClass("hidden");
        input.prop("disabled", true);
        input.addClass("opacity-60");
        $.ajax({
          url: pixxelArr.homeUrl + "/wp-ajax/search/" + search,
          type: "GET",
          contentType: "application/json",
          success: function (response) {
            loading.addClass("hidden");
            input.prop("disabled", false);
            input.removeClass("opacity-60");
            $(input).parent().find(".pixxelicon-trash").removeClass("hidden");
            if (response.success) {
              container.html(response.content.result);
            } else {
              emptyResult.removeClass("hidden");
            }
          },
          error: function (response) {
            loading.addClass("hidden");
            input.prop("disabled", false);
            input.removeClass("opacity-60");
          },
        });
      }
    }

    stretchMegaMenu() {
      let windowWidth = $(window).width();
      if (windowWidth > 768) {
        if (windowWidth > 1280) windowWidth = 1280;
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
