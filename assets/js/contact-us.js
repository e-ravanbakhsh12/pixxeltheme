(function ($) {
  "use strict";

  class ContactUs {
    constructor() {
      const _this = this;
      // google.maps.event.addDomListener(window, "load", _this.initMap());

      $(".contact-form").submit(function (e) {
        e.preventDefault(); // Prevent form submission
        const formData = new FormData(this);
        _this.submitContact(formData, $(this));
      });

      $(document).on(
        "click",
        ".success-modal-overlay , .success-modal .pixxelicon-close ,.success-modal .close-success",
        function (e) {
          _this.successModal($(this));
        }
      );

    }

    submitContact(formData, form) {
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
      if (!form.find(".description").val().length) {
        form
          .find(".form-error")
          .removeClass("hidden")
          .find("p")
          .html("لطفاً متن پیام را وارد نمایید");
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

    initMap() {
      var location = { lat: 35.7642557, lng: 51.4169731 };
      var map = new google.maps.Map(document.getElementById("google-map"), {
        zoom: 15,
        center: location,
        // draggable: false,
        scrollwheel: true,
        streetViewControl: false,
        mapTypeControl: false,
      });
      var marker = new google.maps.Marker({
        position: location,
        map: map,
      });
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
  }

  const contactUs = new ContactUs();
})(jQuery);