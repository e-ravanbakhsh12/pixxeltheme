(function ($) {
  "use strict";

  class Home {
    constructor() {
      const _this = this;

      // modal functions
      $(document).on(
        "click",
        ".popup , .modal-overlay , .modal .pixxelicon-close",
        function (e) {
          _this.modal($(this));
        }
      );
      $(document).on(
        "click",
        ".success-modal-overlay , .success-modal .pixxelicon-close ,.success-modal .close-success",
        function (e) {
          _this.successModal();
        }
      );

      $(document).on("change", ".state", function (e) {
        const stateId = $(this).val();
        $(`.modal .city option`).each(function (e) {
          const cityStateId = $(this).attr("stateId");
          $(this).addClass("hidden");
          if (cityStateId == stateId) {
            $(this).removeClass("hidden");
          }
        });
        $(`.modal .city option`).first().removeClass("hidden");
        $(`.modal .city`).val("0");
      });
      $(".modal").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        const formData = new FormData(this);
        _this.submitModal(formData, $(this));
      });

      // $(document).on("submit", ".modal", function (e) {
      //   e.preventDefault();
      // });

      $(document).on("click", ".tab-item", function (e) {
        const name = $(this).attr("tab");
        $(".tab-item")
          .removeClass(
            "bg-white text-magenta underline underline-offset-4 border-magenta"
          )
          .addClass("border-transparent");
        $(this)
          .addClass(
            "bg-white text-magenta underline underline-offset-4 border-magenta"
          )
          .removeClass("border-transparent");
        $(".tab-content").addClass("hidden");
        $(`.tab-content-${name}`).removeClass("hidden");
      });

      const productList = new Splide(".product-slider", {
        type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: true,
        arrows: true,
        gap: 16,
        perPage: 'auto',
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: 4,
          },
          340: {
            perPage: 'auto',
          },
        },

      });
      productList.mount();

      const videoList = new Splide(".video-slider", {
        type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: true,
        arrows: true,
        gap: 16,
        focus:'center',
        perPage: 1.2,
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: 1.5,
          },
          340: {
            perPage: 1.2,
          },
        },

      });
      videoList.mount();

      const consultantList = new Splide(".consultant-slider", {
        // type: "loop",
        direction: "rtl",
        // drag:'free',
        // autoplay: true,
        arrows: true,
        gap: 16,
        focus:'center',
        start:1,
        perPage: 'auto',
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: 3,
          },
          340: {
            perPage: 'auto',
          },
        },

      });
      consultantList.mount();


      // show more
      $(document).on("click", ".show-more-features", function (e) {
        $(".features-list").toggleClass("max-h-[11.5rem] max-h-[32rem]");
        $(this).find("i").toggleClass("rotate-180");
        $(this).find(".more, .less").toggleClass("hidden");
      });


      $(window).on("scroll", function () {
        _this.stickyMenuAction($(this));
      });
    }

    modal() {
      $(".modal-overlay").toggleClass("hidden");
      $(".modal").toggleClass("-bottom-[130%] bottom-0 md:bottom-1/2");
    }

    successModal() {
      $(".success-modal-overlay").toggleClass("hidden");
      $(".success-modal").toggleClass(
        "-bottom-[130%] bottom-0 md:bottom-1/2 active"
      );
    }

    submitModal(formData, form) {
      const _this = this;
      $(".form-error,.form-success").addClass("hidden").find("p").html("");
      const btn = form.find("button");
      const mobile = $(".phone-number").val();
      const mobileRegex = /^(?:98|\+98|0098|0)?9[0-9]{9}$/;

      if (!mobileRegex.test(mobile)) {
        $(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً شماره خود را به صورت صحیح وارد نمایید");
        return;
      }
      if ($(".state").val() == "0" || $(".city").val() == "0") {
        $(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً شهر و استان خود را انتخاب نمایید");
        return;
      }
      btn.find("svg").removeClass("hidden");
      btn.prop("disabled", true);
      formData = _this.getUtmParams(formData);
      // Send form data to the specified URL
      $.ajax({
        url: labellArr.homeUrl + "/wp-ajax/form/formData",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          btn.find("svg").addClass("hidden");
          btn.prop("disabled", false);
          if (response.success) {
            form.get(0).reset();
            _this.modal();
            _this.successModal();
          } else {
            form
                .find(".form-error")
                .removeClass("hidden")
                .find("p")
                .html(response.message.error);
          }
        },
        error: function (response, status, error) {
          btn.find("svg").addClass("hidden");
          btn.prop("disabled", false);
          $(".form-error")
            .removeClass("hidden")
            .find("p")
            .html(
              "خطایی در برقراری ارتباط با سرور بوجود آمده است لطفاً مجدداً سعی نمایید"
            );
        },
      });
    }

    stickyMenuAction(scroll) {
      let _this = this;
      let cur_pos = scroll.scrollTop();

      if ($(window).width() < 768) {
        if (
          cur_pos > $("#hero-img").offset().top - 20 &&
          cur_pos < $("footer").offset().top - $(window).height()
        ) {
          $(".sticky-section").removeClass("-bottom-full").addClass("bottom-0");
        } else {
          $(".sticky-section").addClass("-bottom-full").removeClass("bottom-0");
        }
      }
    }

    getUtmParams(form) {
      const url = new URL(window.location.href);
      const searchParams = url.searchParams;
      const source = searchParams.get("utm_source");
      const campaign = searchParams.get("utm_campaign");
      const medium = searchParams.get("utm_medium");
      if (source !== null) {
        form.append("utmsource_code", source);
      }
      if (campaign !== null) {
        form.append("camp_code", campaign);
      }
      if (medium !== null) {
        form.append("utmmedium_code", medium);
      }
      return form;
    }
  }

  let home = new Home();
})(jQuery);
horizontallyScrolls(".horizontal-scroll");
function horizontallyScrolls(Class, dragSpeed = 1) {
  const slider = document.querySelectorAll(Class);
  slider?.forEach((slide) => {
    const carousel = slide;
    if (carousel != undefined) {
      let isDown = false;
      let moved = true;
      let startX;
      let scrollLeft;
      let startArr = ["mousedown", "touchstart"];
      let endArr = ["mouseup", "touchend"];
      let moveArr = ["mousemove", "touchmove"];
      startArr.forEach((evt) =>
        carousel.addEventListener(
          evt,
          (e) => {
            isDown = true;
            carousel.classList.add("active");
            if (evt == "touchstart") {
              if (e.changedTouches != undefined) {
                startX = e.changedTouches[0].pageX - carousel.offsetLeft;
              }
            } else {
              startX = e.pageX - carousel.offsetLeft;
            }
            scrollLeft = carousel.scrollLeft;
          },
          { passive: false }
        )
      );
      carousel.addEventListener("mouseleave", () => {
        isDown = false;
        carousel.classList.remove("active");
      });

      endArr.forEach((evt) =>
        carousel.addEventListener(evt, () => {
          isDown = false;
          carousel.classList.remove("active");
        })
      );

      moveArr.forEach((evt) =>
        carousel.addEventListener(
          evt,
          (e) => {
            if (!isDown) return;
            e.preventDefault();
            let x;
            if (evt == "touchmove") {
              if (e.changedTouches != undefined) {
                x = e.changedTouches[0].pageX - carousel.offsetLeft;
              }
            } else {
              x = e.pageX - carousel.offsetLeft;
            }
            const walk = (x - startX) * dragSpeed; //scroll-fast
            carousel.scrollLeft = scrollLeft - walk;
          },
          { passive: false }
        )
      );
    }
  });
}
