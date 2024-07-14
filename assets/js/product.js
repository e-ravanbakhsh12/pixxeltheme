(function ($) {
  "use strict";

  class Product {
    constructor() {
      const _this = this;
      this.stateId = 0;

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

      $(".calculate-form").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        const formData = new FormData(this);
        _this.submitCalculate(formData, $(this));
      });

      const sliderGallery = new Splide(".splide-slider", {
        type: "loop",
        direction: "rtl",
        // autoplay: true,
        arrows: true,
        gap: 16,
        perPage: 1,
      });
      sliderGallery.mount();

      const sampleGallery = new Splide(".splide-sample", {
        type: "loop",
        direction: "rtl",
        // autoplay: true,
        arrows: true,
        perMove: 8,
        grid: {
          rows: 2,
          cols: 4,
          gap: {
            row: "1rem",
            col: "1rem",
          },
        },
        breakpoints: {
          768: {
            grid: {
              rows: 2,
              cols: 2,
              gap: {
                row: "0.5rem",
                col: "0.5rem",
              },
            },
          },
        },
      });
      sampleGallery.mount(window.splide.Extensions);

      const testimonialGallery = new Splide(".splide-testimonial", {
        type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: true,
        arrows: true,
        gap: 16,
        perPage: 1,
      });
      testimonialGallery.mount();

      // $(window).on("scroll", function () {
      //   _this.stickyMenuAction($(this));
      // });

      const relatedPost = new Splide(".splide-related-product", {
        // type: "loop",
        direction: "rtl",
        // drag:'free',
        autoplay: true,
        arrows: true,
        gap: 16,
        perPage: 3,
        mediaQuery: "min",
        breakpoints: {
          768: {
            perPage: 6,
          },
          340: {
            perPage: 3,
          },
        },
      });
      relatedPost.mount();

      const lightbox = GLightbox({
        touchNavigation: true,
        closeOnOutsideClick: true,
      });

      $(document).on('click','.splide-sample .cover',function(e){
        console.log('test');
        $(this).parent().find('img').click();
      });
    }

    modal() {
      $(".modal-overlay").toggleClass("hidden");
      $(".modal").toggleClass("-bottom-[130%] bottom-0 md:bottom-1/2");
    }

    successModal(string = false) {
      $(".success-modal-overlay").toggleClass("hidden");
      $(".success-modal").toggleClass(
        "-bottom-[130%] bottom-0 md:bottom-1/2 active"
      );
      if (string) {
        $(".success-modal h3").html(string);
      }
    }

    submitModal(formData, form) {
      const _this = this;
      form
        .find(".form-error,.form-success")
        .addClass("hidden")
        .find("p")
        .html("");
      const btn = form.find("button");
      const mobile = form.find(".phone-number").val();
      const mobileRegex = /^(?:98|\+98|0098|0)?9[0-9]{9}$/;

      if (!mobileRegex.test(mobile)) {
        form
          .find(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً شماره خود را به صورت صحیح وارد نمایید");
        return;
      }
      if (form.find(".state").val() == "0" || form.find(".city").val() == "0") {
        form
          .find(".form-error")
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
            _this.successModal("درخواست مشاوره رایگان شما ثبت شد");
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

    submitCalculate(formData, form) {
      const _this = this;
      form
        .find(".form-error,.form-success")
        .addClass("hidden")
        .find("p")
        .html("");
      const btn = form.find("button");
      const mobile = form.find(".phone-number").val();
      const mobileRegex = /^(?:98|\+98|0098|0)?9[0-9]{9}$/;

      if (!mobileRegex.test(mobile)) {
        form
          .find(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً شماره خود را به صورت صحیح وارد نمایید");
        return;
      }
      if (!form.find("#meterage").val().length) {
        form
          .find(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً متراژ را وارد نمایید");
        return;
      }
      if (form.find("#roof-type").val() == "0") {
        form
          .find(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً نوع سقف را انتخاب نمایید");
        return;
      }
      if (form.find("#light").val() == "0") {
        form
          .find(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً نوع نورپردازی را انتخاب نمایید");
        return;
      }

      btn.find("svg").removeClass("hidden");
      btn.prop("disabled", true);
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
            _this.successModal("درخواست محاسبه قیمت شما ثبت شد");
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

  const product = new Product();
})(jQuery);
