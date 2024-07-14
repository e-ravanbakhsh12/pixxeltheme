(function ($) {
  "use strict";

  class Faq {
    constructor() {
      const _this = this;

      // faq tab
      $(document).on("click", ".tab-item", function (e) {
          $(".tab-content").addClass('hidden');
          $(".tab-item").removeClass("border-magenta font-bold text-magenta").addClass('border-transparent');
          $(this).addClass("border-magenta font-bold text-magenta").removeClass('border-transparent');
          const tab = $(this).attr('tab');
          $(`.tab-content[tab="${tab}"]`).removeClass('hidden');
      });
      // faq toggle
      $(document).on("click", ".toggle-item", function (e) {
        if ($(this).find("i").hasClass("rotate-180")) {
          $(this).parent().find(".toggle-content").slideUp();
          $(this).find("i").removeClass("rotate-180");
        } else {
          $(".toggle-content").slideUp();
          $(".toggle-item i").removeClass("rotate-180");
          const tab = $(this).parent();
          tab.find(".toggle-item i").addClass("rotate-180");
          tab.find(".toggle-content").slideDown();
        }
      });
      
    }

  }

  const faq = new Faq();
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