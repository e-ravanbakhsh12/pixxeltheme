(function ($) {
  "use strict";

  class Home {
    constructor() {
      const _this = this;
      this.audioList = [];

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

      const productList = new Splide(".product-slider", {
        type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: true,
        arrows: true,
        gap: 16,
        autoWidth :true,
        perPage: 4,
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: 4,
            autoWidth :false,
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
        focus: "center",
        autoWidth :true,
        mediaQuery: "min",
      });
      videoList.mount();

      if (typeof GLightbox !== "undefined") {
        const lightbox = GLightbox({
          loop: true,
          touchNavigation: true,
          closeOnOutsideClick: true,
        });
      }

      const consultantList = new Splide(".consultant-slider", {
        // type: "loop",
        direction: "rtl",
        // drag:'free',
        // autoplay: true,
        arrows: true,
        gap: 16,
        focus: "center",
        start: 1,
        perPage: 3,
        autoWidth :true,
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: 3,
            autoWidth :false,
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

      // play audio
      
      $(document).on("click", ".loadAudio.pixxelicon-pause", function (e) {
        const index = $(this).data('index');
        _this.audioList.forEach((audio,i) => {
          if(i !=index){
            audio.stopPlay();
          }
        });
      });
      $(".audio-player").each(function (e) {
        _this.audioList.push(new AudioPlayer($(this).get(0)));
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
        url: pixxelArr.homeUrl + "/wp-ajax/form/formData",
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
