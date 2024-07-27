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

    p2e = (s) => s.replace(/[۰-۹]/g, (d) => String("۰۱۲۳۴۵۶۷۸۹".indexOf(d)));

    a2e = (s) => s.replace(/[٠-٩]/g, (d) => String("٠١٢٣٤٥٦٧٨٩".indexOf(d)));
  }

  const home = new Home();

  $.pixxelSelectHandler = function (modifySelect = null) {
    const getSelector = () =>
      modifySelect == null ? $(".pixxel-select") : modifySelect;

    const processField = ($self) => {
      const field = $self.find("select");
      const fieldOptions = field.find("option");
      const fieldClass = field.attr("class") || "";
      const listClass = field.attr("list-class") || "";
      const searchClass = field.attr("search-class") || "";
      const fieldId = field.attr("id");
      const arrowIcon = getArrowIcon($self);
      const fieldHeight = getFieldHeight($self, field);
      const searchPlaceholder = getSearchPlaceholder(field);
      const multipleClass = getMultipleClass(field);

      field.addClass("hidden");
      $self.addClass("rendered").removeClass("not-rendered");

      insertElements(
        field,
        $self,
        arrowIcon,
        fieldHeight,
        searchPlaceholder,
        multipleClass,
        listClass,
        searchClass,
        fieldClass,
        fieldId
      );

      const list = $self.find(".pixxel-select-list");
      fieldOptions.each(function () {
        const optionContent = $(this).attr("html") || $(this).text();
        const isDisabled = $(this).attr("disabled");
        const optionValue = $(this).val();
        const optionClass = $(this).attr("class");
        createListItem(
          field,
          list,
          optionContent,
          optionValue,
          isDisabled,
          optionClass
        );
      });

      const dropdown = $self.find(".pixxel-select-dropdown");
      const search = $self.find(".pixxel-select-search");
      const searchContainer = $self.find(".pixxel-select-search-container");
      const option = $self.find(".pixxel-select-option");
      const optionText = $self.find(".pixxel-select-text");

      // add position top to list
      calculateListTop(list, field, dropdown, searchContainer);

      // filter based on search for not ajax list
      if (field.is("[search]") && !field.is("[ajax-request]")) {
        search
          .on("change keyup paste", function (e) {
            handleSearch($(this), list);
          })
          .change();
        calculateListTop(list, field, dropdown, searchContainer);
      }

      // action for default selected option
      if (field.find("option:selected").length) {
        const optionContent =
          field.find("option:selected").attr("html") ||
          field.find("option:selected").text();
        dropdown.find("span").html(optionContent).addClass("");
        list
          .find(
            `.pixxel-select-option[pixxel-value="${field
              .find("option:selected")
              .val()}"]`
          )
          .addClass("bg-light-blue selected");
      }

      // action for simple select option
      simpleSelectHandler(
        $self,
        option,
        fieldOptions,
        field,
        dropdown,
        list,
        searchContainer
      );

      // simple selection dropdown Click handler
      if (!field.is("[ajax-request]")) {
        dropdownClickHandler(
          $self,
          field,
          dropdown,
          list,
          searchContainer,
          fieldId
        );
      }
    };

    const getArrowIcon = ($self) => {
      console.log($self.hasClass("no-arrow"));
      if ($self.hasClass("no-arrow")) {
        return $self.attr("icon")
          ? `<i class="${$self.attr("icon")} transition-all"></i>`
          : ``;
      }
      return `<i class="pixxelicon-arrow-bottom absolute left-3 ${$self.attr(
        "icon"
      )} transition-all"></i>`;
    };

    const getFieldHeight = ($self) => {
      return $self.attr("height") ? parseInt($self.attr("height")) : 0;
    };

    const getSearchPlaceholder = (field) => {
      return field.is("[search]") ? field.attr("search-placeholder") || "" : "";
    };

    const getMultipleClass = (field) => {
      if (field.is("[multiple]")) {
        return field.is("[search]")
          ? "flex-wrap h-full justify-start"
          : "flex-wrap justify-start ";
      }
      return "";
    };

    const insertElements = (
      field,
      $self,
      arrowIcon,
      fieldHeight,
      searchPlaceholder,
      multipleClass,
      listClass,
      searchClass,
      fieldClass,
      fieldId
    ) => {
      if (field.is("[search]")) {
        field.is("[ajax-request]")
          ? field.after(`
        <div class="pixxel-select-dropdown flex  items-center relative ${multipleClass} ${fieldClass} ">
          <input type="text" placeholder="${searchPlaceholder}" class="pixxel-select-search w-full pl-10 h-full outline-none">
        </div>
        <ul class="pixxel-select-list ${fieldId} ${listClass} bg-white w-full rounded-xl absolute right-0 opacity-0 invisible overflow-y-auto h-fit max-h-72  transition-all z-10  "></ul>
        `)
          : field.after(`
        <div class="pixxel-select-dropdown flex  items-center relative  ${multipleClass} ${fieldClass} "><span></span>${arrowIcon}
        </div>
        <div class="pixxel-select-search-container ${fieldClass} -mt-1 flex justify-center items-center  border-t-0 opacity-0 invisible rounded-t-none overflow-hidden">
          <input type="text" placeholder="${searchPlaceholder}" class="pixxel-select-search !border-none w-full pl-10 h-full outline-none ${searchClass}">
          <svg class="hidden shrink-0 absolute left-2 w-4 h-4">
            <use href="#loading-spinner"></use>
          </svg>
        </div>
        <ul class="pixxel-select-list  ${fieldId} ${listClass} bg-white w-full rounded-md absolute right-0 opacity-0 invisible overflow-y-auto max-h-72 transition-all z-10"></ul>
        `);
      } else {
        field.after(`
        <div class="pixxel-select-dropdown flex items-center ${multipleClass} ${fieldClass}"><span></span>${arrowIcon}
        </div>
        <ul class="pixxel-select-list ${fieldId} ${listClass} bg-white w-full absolute right-0 opacity-0 invisible overflow-y-auto max-h-72 transition-all z-10 "></ul>
        `);
      }
    };

    const createListItem = (
      field,
      list,
      content,
      value,
      isDisabled,
      optionClass
    ) => {
      const listItem = $("<li>", {
        class: `pixxel-select-option pixxel-select-li ${optionClass || ""}`,
        "pixxel-value": value,
        html: content,
      });

      if (isDisabled) {
        listItem.addClass("disabled p-6 hover:bg-midnight-50 hover:text-blue-main");
      } else {
        listItem.click(function (e) {
          field.find(`option[value="${value}"]`).prop("selected", true);
          field.trigger("change");
        });
      }
      list.append(listItem);
    };

    const calculateListTop = (list, field, dropdown, searchContainer) => {
      let position;
      list.css("top", "calc(100% + 5px)");
    };

    const dropdownClickHandler = (
      $self,
      field,
      dropdown,
      list,
      searchContainer,
      fieldId
    ) => {
      $self.on("click", ".pixxel-select-dropdown", function (e) {
        if ($(this).parents(".select-container") != undefined) {
          $(this)
            .parents(".select-container")
            .find(".pixxel-select-search-container")
            .toggleClass("opacity-100 visible opacity-0 invisible open");
          $(this)
            .parents(".select-container")
            .find(".pixxel-select-list")
            .each(function (e) {
              if ($(this).hasClass("open") && !$(this).hasClass(fieldId)) {
                $(this)
                  .toggleClass("opacity-100 visible opacity-0 invisible open")
                  .scrollTop(0);
                if (!$(this).parents(".pixxel-select").hasClass("no-arrow")) {
                  $(this)
                    .parents(".pixxel-select")
                    .find("i")
                    .removeClass("rotate-180");
                }
              }
            });
        }

        if (!field.attr("disabled")) {
          searchContainer.toggleClass(
            "opacity-100 visible opacity-0 invisible open"
          );
          list
            .toggleClass("opacity-100 visible opacity-0 invisible open")
            .scrollTop(0);
          if (!$self.hasClass("no-arrow")) {
            $(this).find("i").toggleClass("rotate-180");
          }
        }

        calculateListTop(list, field, dropdown, searchContainer);
      });
    };

    const simpleSelectHandler = (
      $self,
      option,
      fieldOptions,
      field,
      dropdown,
      list,
      searchContainer
    ) => {
      $self.on("click", ".pixxel-select-option", function (e) {
        if (!$(this).hasClass("disabled")) {
          const optionContent = $(this).html();
          option.removeClass("bg-light-blue");
          $(this).addClass("bg-light-blue selected");
          fieldOptions.prop("selected", false);
          field.find("option").removeAttr("selected");
          field
            .find(`option[value="${$(this).attr("pixxel-value")}"]`)
            .prop("selected", true);

          dropdown.find("span").html(optionContent).addClass("has-value");
        }

        if (field.is("[search]")) {
          dropdown.toggleClass("open rounded-b-none border-b-0");
        }

        if ($(this).attr("icon") == undefined) {
          dropdown.find("i").toggleClass("rotate-180");
        }
        list
          .scrollTop(0)
          .toggleClass("opacity-100 visible opacity-0 invisible open");
        searchContainer.toggleClass(
          "opacity-100 visible opacity-0 invisible open"
        );

        calculateListTop(list, field, dropdown, searchContainer);
      });
    };

    // Call the processField function for each selector
    getSelector().each(function () {
      processField($(this));
    });
  };

  $.pixxelSelectHandler();

})(jQuery);
