(function ($) {
  "use strict";
  class Comment {
    constructor() {
      let _this = this;
      $(document).on("submit", ".pixxel-comment-popup", function (e) {
        e.preventDefault();
        _this.submitComment($(this));
      });
      $(document).on("click", ".comment-show-more", function (e) {
        _this.showMoreComment($(this));
      });
      $(document).on(
        "click",
        ".pixxel-add-comment,.pixxel-comment-popup-overlay",
        function (e) {
          e.preventDefault();
          _this.commentModal($(this));
        }
      );

      $(document).on(
        "click",
        ".reply-comment-modal-overlay, .reply-comment-modal .pixxelicon-cross",
        function (e) {
          _this.toggleReplyComment();
        }
      );

      $(document).on("click", ".add-reply", function (e) {
        _this.replyField($(this));
      });

      $(document).on("click", ".submit-comment.active", function (e) {
        if ($(window).width() > 768) {
          _this.submitReply($(this));
        } else {
          _this.submitReply($(this), true);
        }
      });

      // placeholder of question handler
      $(
        ".textarea-container .comment-textarea ,.textarea-container .textarea-placeholder"
      ).on("click", function (e) {
        $(this)
          .parents(".textarea-container")
          .find(".textarea-placeholder")
          .addClass("hidden");
        $(this)
          .parents(".textarea-container")
          .find(".comment-textarea")
          .focus();
      });

      $(document).on("keyup keydown pest", ".comment-textarea", function (e) {
        const contentLength = 9999999;
        if ($(window).width() > 768) {
          if ($(this).text().length > contentLength && e.keyCode != 8) {
            e.preventDefault();
          }
          if ($(this).text().length == 0) {
            $(this)
              .parents(".comment-reply-field")
              .find(".textarea-placeholder")
              .removeClass("hidden");
          } else {
            $(this)
              .parents(".comment-reply-field")
              .find(".textarea-placeholder")
              .addClass("hidden");
          }
          if (
            $(this).text().length > 0 &&
            $(this).text().length < contentLength + 2
          ) {
            $(this)
              .parents(".comment-reply-field")
              .find(".submit-comment")
              .addClass("active cursor-pointer")
              .removeClass("opacity-50");
          } else {
            $(this)
              .parents(".comment-reply-field")
              .find(".submit-comment")
              .removeClass("active cursor-pointer")
              .addClass("opacity-50");
          }
        } else {
          if (
            $(this).val().length == 0 ||
            ($(this).val().length > contentLength && e.keyCode != 8)
          ) {
            $(this)
              .parent()
              .find(".submit-comment")
              .removeClass("active cursor-pointer")
              .addClass("opacity-50");
          } else {
            $(this)
              .parent()
              .find(".submit-comment")
              .addClass("active cursor-pointer")
              .removeClass("opacity-50");
          }
        }
      });

      // rate action
      $(document).on(
        "click",
        ".rate-container .pixxelicon-star-fill",
        function (e) {
          _this.commentRateSelection($(this));
        }
      );

      // upload image for comment
      $(document).on("change", "#pixxel-upload-img", function (e) {
        _this.uploadImage($(this));
      });

      // remove attached image
      $(document).on("click", ".remove-upload-image", function (e) {
        const id = $(this).data("attach-id");
        let idString = $(".forum-uploaded-image").val();
        idString = idString.split(",");
        idString = idString.length && idString.filter((d) => d != id);
        $(".forum-uploaded-image").val(idString.join(","));
        $(this).parent().remove();
      });

      // show more comment
      $(document).on("click", ".comment-show-more", function (e) {
        _this.showMoreComment($(this));
      });
    }

    submitComment(form) {
      let _this = this;
      let loading = form.find("button svg");
      let btn = form.find("button");
      $(
        ".comment-response-box .error-message,.comment-response-box .success-message"
      ).addClass("hidden");

      if (
        !parseInt(commentData.isLogin) &&
        $("#pixxel-comment-name").length &&
        !$("#pixxel-comment-name").val().length
      ) {
        $(".comment-response-box .error-message")
          .html("لطفاً نام خود را وارد نمایید")
          .removeClass("hidden");
        return;
      }
      if (!$("#pixxel-comment-content").val().length) {
        $(".comment-response-box .error-message")
          .html("لطفاً پیام خود را وارد نمایید")
          .removeClass("hidden");
        return;
      }
      if ($(".rate-container").length && !Number($(".rate-container").data('rate'))) {
        $(".comment-response-box .error-message")
          .html("لطفاً امتیاز خود را وارد کنید")
          .removeClass("hidden");
        return;
      }
      loading.removeClass("hidden");
      btn.prop("disabled", true);

      const arg = {
        parentId: 0,
        postId: commentData.postId,
        title:$("#pixxel-comment-title").val(),
        anonyms:$("#pixxel-anonyms").is(':checked')?1:0,
        rate:$(".rate-container").data('rate'),
        images:$('#pixxel-uploaded-image').val(),
        name: $("#pixxel-comment-name").length
          ? $("#pixxel-comment-name").val()
          : null,
        email: $("#pixxel-comment-email").length
          ? $("#pixxel-comment-email").val()
          : null,
        content: $("#pixxel-comment-content").val(),
      };

      const formData = new FormData();
      formData.append("data", JSON.stringify(arg));
      $.ajax({
        url: pixxelArr.homeUrl + "/wp-ajax/comment/add-comment",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        mode: "no-cors",
        type: "POST",
        success: function (response) {
          loading.addClass("hidden");
          btn.prop("disabled", false);
          if (response.success) {
            $(".comment-response-box .success-message")
              .html(response.message)
              .removeClass("hidden");
            $(".pixxel-comment-container").prepend(
              response.content.commentHtml
            );
          }
          $(".pixxel-comment-form input ,.pixxel-comment-form textarea").val(
            ""
          );
          addAppModeQueryString();
        },
        error: function (response) {},
      });
    }

    showMoreComment(btn) {
      console.log(btn);
      let page = parseInt(btn.data("page"));
      let allPage = parseInt(btn.data("all-page"));
      $(".comment-item.level-1").each(function (e, i) {
        console.log(e);
        if (e > (page - 1) * 3 && e <= page * 3) {
          $(this).removeClass("hidden");
        }
      });
      btn.attr("page", page + 1);
      if (page >= allPage) {
        btn.addClass("hidden");
      } else {
        btn.removeClass("hidden");
      }
    }

    commentModal(btn) {
      $(".pixxel-comment-popup-overlay").toggleClass("hidden");
      $(".pixxel-comment-popup").toggleClass("-bottom-[130%] bottom-0");
    }

    replyField(replyBtn) {
      const _this = this;
      const comment = replyBtn.parent().parent().parent();
      const firstLevelCommentId = replyBtn
        .parents(".level-1")
        .attr("commentid");
      comment.append($(".comment-reply-field"));
      const parentId = comment.attr("commentId");
      $(".comment-reply-field .comment-textarea").attr("parentId", parentId);
      $(".comment-reply-field .comment-textarea").html("");
      $(".reply-comment-modal .comment-textarea").attr("parentId", parentId);
      $(".reply-comment-modal .comment-textarea").attr(
        "firstLevel",
        firstLevelCommentId
      );
      if ($(window).width() < 768) {
        let authorName = replyBtn
          .parents(".comment-item")
          .first()
          .find(".comment-author>div")
          .html()
          .trim();
        $(".reply-comment-modal .comment-textarea").attr(
          "placeholder",
          `پاسخ شما به دیدگاه ${authorName} چیست؟`
        );
        _this.toggleReplyComment();
      }
    }

    toggleReplyComment() {
      $(".reply-comment-modal").toggleClass("-bottom-full bottom-0");
      $(".reply-comment-modal-overlay").toggleClass("hidden");
    }

    submitReply(submit, mobile = false) {
      const _this = this;
      if (mobile) {
        submit.find("svg").removeClass("hidden");
        submit.removeClass("active cursor-pointer").addClass("opacity-50");
      } else {
        submit.addClass("hidden");
        submit.parent().find(".animate-spin").removeClass("hidden");
      }
      const textarea = submit.parent().find(".comment-textarea");
      let textareaValue = "";
      const firstLevelComment = submit.parents(".level-1");
      const firstLevelId = mobile
        ? parseInt(textarea.attr("firstLevel"))
        : firstLevelComment.attr("commentid");
      if (mobile) {
        textareaValue = textarea.val();
      } else {
        textareaValue = textarea.text();
      }

      const name = $(`[name="pixxel-comment-name"]`).length
        ? mobile
          ? $(`#pixxel-reply-comment-name-mobile`).val()
          : $(`#pixxel-reply-comment-name`).val()
        : null;
      const email = $(`[name="pixxel-comment-email"]`).length
        ? mobile
          ? $(`#pixxel-reply-comment-email-mobile`).val()
          : $(`#pixxel-reply-comment-email`).val()
        : null;

      const arg = {
        parentId: parseInt(textarea.attr("parentId")),
        postId: commentData.postId,
        name,
        email,
        content: textareaValue,
        firstLevelId: firstLevelId,
      };
      let formData = new FormData();
      formData.append("data", JSON.stringify(arg));
      $.ajax({
        url: pixxelArr.homeUrl + "/wp-ajax/comment/add-comment",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        mode: "no-cors",
        type: "POST",
        success: function (response) {
          if (mobile) {
            submit.find("svg").addClass("hidden");
          } else {
            submit.parent().find(".animate-spin").addClass("hidden");
            submit.removeClass("hidden");
          }
          if (response.success) {
            $(".reply-container").append($(".comment-reply-field"));

            if (response.content.isFirstLevel) {
              $(".comment-response-box .success-message")
                .html(response.message)
                .removeClass("hidden");
              $(".pixxel-comment-container").prepend(
                response.content.commentHtml
              );
            } else {
              $(`.comment-item[commentid="${firstLevelId}"]`).replaceWith(
                response.content.commentHtml
              );
            }
            if (mobile) {
              _this.toggleReplyComment();
            }
          }
        },
        error: function (response) {},
      });
    }

    commentRateSelection(btn) {
      let rate = parseInt(btn.data("number"));
      $(".rate-container .pixxelicon-star-fill").each(function (e) {
        $(this).addClass("text-midnight-400").removeClass("text-yellow-main");

        if (parseInt($(this).data("number")) <= rate) {
          $(this).removeClass("text-midnight-400").addClass("text-yellow-main");
        }
      });
      $(".rate-container").attr("data-rate", rate);
    }

    uploadImage(file) {
      const _this = this;
      const loading = file.parent().find("svg");
      loading.removeClass("hidden");
      $(this).prop("disabled", true);
      const formData = new FormData();
      for (let i = 0; i < file[0].files.length; i++) {
        formData.append("image-" + i, file[0].files[i], file[0].files[i].name);
      }

      $.ajax({
        url: pixxelArr.homeUrl + "/wp-ajax/comment/upload-images",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        mode: "no-cors",
        type: "POST",
        success: function (response) {
          loading.addClass("hidden");
          $(this).prop("disabled", false);

          if (response.success) {
            $(".display-uploaded-img").append(response.content.image);
            const lastList = $(".pixxel-uploaded-image").val().length ?$(".pixxel-uploaded-image").val().split(','):[];
            $(".pixxel-uploaded-image").val([...lastList,response.content.id].join(','));
          } else {
          }
        },
        error: function (response) {
          loading.addClass("hidden");
          $(this).prop("disabled", false);
        },
      });
    }

    showMoreComment(btn) {
      let page = parseInt(btn.data("page"));
      let allPage = parseInt(btn.data("allPage"));
      $(".comment-item.level-1").each(function (e, i) {
        if (e+1 > (page - 1) * 3 && e+1 <= page * 3) {
          $(this).removeClass("hidden").addClass('flex');
        }
      });
      btn.attr("data-page", page + 1);
      if (page >= allPage) {
        btn.addClass("hidden");
      } else {
        btn.removeClass("hidden");
      }
    }
  }
  let newComment = new Comment();
})(jQuery);
