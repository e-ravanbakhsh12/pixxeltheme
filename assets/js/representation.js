(function ($) {
  "use strict";

  class Representation {
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

      $(".representation-form").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        const formData = new FormData(this);
        _this.submitRepresentation(formData, $(this));
      });

      $(document).on(
        "click",
        ".success-modal-overlay , .success-modal .pixxelicon-close ,.success-modal .close-success",
        function (e) {
          _this.successModal();
        }
      );

      $(document).on("change", ".state", function (e) {
        const stateId = $(this).val();
        $(`.representation-form .city option`).each(function (e) {
          const cityStateId = $(this).attr("stateId");
          $(this).addClass("hidden");
          if (cityStateId == stateId) {
            $(this).removeClass("hidden");
          }
        });
        $(`.representation-form .city option`).first().removeClass("hidden");
        $(`.representation-form .city`).val("0");
      });

      // Representation list pagination
      $(document).on("click", ".page-item", function (e) {
        $(".page-item").removeClass("selected");
        $(this).addClass("selected");
        if ($(".loading-overlay").hasClass("hidden")) {
          _this.consultantListAjaxRequest();
        }
      });
      $(document).on("change", ".state", function (e) {
        if ($(".loading-overlay").hasClass("hidden")) {
          _this.consultantListAjaxRequest(true);
        }
      });
    }

    submitRepresentation(formData, form) {
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
        $(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً شهر و استان خود را انتخاب نمایید");
        return;
      }

      if (!form.find(".description").val().length) {
        form
          .find(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً توضیحات را وارد نمایید");
        return;
      }

      btn.find("svg").removeClass("hidden");
      btn.prop("disabled", true);
      formData = _this.getUtmParams(formData);
      // Send form data to the specified URL
      $.ajax({
        url: labellArr.homeUrl+"/wp-ajax/form/formData",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          btn.find("svg").addClass("hidden");
          btn.prop("disabled", false);
          if (response.success) {
            form.get(0).reset();
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

    successModal() {
      $(".success-modal-overlay").toggleClass("hidden");
      $(".success-modal").toggleClass("-bottom-[130%] bottom-0 md:bottom-1/2 active");
    }

    getUtmParams(form){
      const url = new URL(window.location.href);
      const searchParams = url.searchParams;
      const source = searchParams.get("utm_source");
      const campaign = searchParams.get("utm_campaign");
      const medium = searchParams.get("utm_medium");
      if (source !== null) {
        form.append('utmsource_code',source);
      }
      if (campaign !== null) {
        form.append('camp_code',campaign);
      }
      if (medium !== null) {
        form.append('utmmedium_code',medium);
      }
      return form;
    }

    consultantListAjaxRequest(changeState = false) {
      const _this = this;

      const state = $(".state").val();
      const page = changeState
        ? 1
        : $(".page-item.selected").length
        ? $(".page-item.selected").attr("page")
        : 1;

      // $(document).scrollTop(0);
      $(".loading-overlay").removeClass("hidden");
      const args = {
        page,
        state,
        url: window.location.href,
      };

      const formData = new FormData();
      formData.append("data", JSON.stringify(args));
      $.ajax({
        url: labellArr.homeUrl + "/wp-ajax/representation/list",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        mode: "no-cors",
        type: "POST",
        success: function (response) {
          $(".loading-overlay").addClass("hidden");
          if (response.success) {
            console.log(response);
            $(".representation-list-container").html(response.content.list);
            $(".representation-pagination-container").html(
              response.content.pagination
            );

            let newUrl = response.content.url;
            if (history.pushState) {
              history.pushState(null, null, newUrl);
            } else {
              window.location.href = newUrl;
            }
          }
        },
        error: function (response) {
          $(".loading-overlay").addClass("hidden");
        },
      });
    }
  }

  const representation = new Representation();
})(jQuery);
