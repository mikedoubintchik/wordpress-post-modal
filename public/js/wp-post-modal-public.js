(function($) {
  "use strict";

  // added to support accessibility for screen reader users
  var clickedURL;

  /**
   * Check if URL is external function
   *
   * @returns {boolean}
   */
  $.fn.isExternal = function() {
    var host = window.location.hostname;
    var link = $("<a>", {
      href: this.attr("href")
    })[0].hostname;
    return link !== host;
  };

  /**
   * Trapping user in modal for web accessibility
   */
  function trapFocus() {
    $(".close-modal").focus();

    var focusableEls = document.querySelectorAll(
        '.modal a[href]:not([disabled]), .modal button:not([disabled]), .modal textarea:not([disabled]), .modal input[type="text"]:not([disabled]), .modal input[type="radio"]:not([disabled]), .modal input[type="checkbox"]:not([disabled]), .modal select:not([disabled])'
      ),
      firstFocusableEl = focusableEls[0],
      lastFocusableEl = focusableEls[focusableEls.length - 1];

    document.addEventListener("keydown", function(e) {
      var isTabPressed = e.key === "Tab" || e.keyCode === 9;

      if (!isTabPressed) return;

      if (e.shiftKey && isTabPressed) {
        /* shift + tab */ if (document.activeElement === firstFocusableEl) {
          lastFocusableEl.focus();
          e.preventDefault();
        }
      } else if (isTabPressed) {
        /* tab */ if (document.activeElement === lastFocusableEl) {
          firstFocusableEl.focus();
          e.preventDefault();
        }
      }
    });
  }

  /**
   * Check if modal is open
   */
  function popupOpen() {
    return $(".modal-wrapper").hasClass("show");
  }

  /**
   * Basename function for JS
   *
   * @param path
   * @param suffix
   * @returns {*}
   */
  function basename(path, suffix) {
    var b = path;
    var lastChar = b.charAt(b.length - 1);
    if (lastChar === "/" || lastChar === "\\") {
      b = b.slice(0, -1);
    }
    b = b.replace(/^.*[/\\]/g, "");
    if (
      typeof suffix === "string" &&
      b.substr(b.length - suffix.length) === suffix
    ) {
      b = b.substr(0, b.length - suffix.length);
    }
    return b;
  }

  /**
   * Get URL Paramenters
   *
   * @param sParam
   * @returns {*}
   */
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split("&"),
      sParameterName,
      i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split("=");

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
      }
    }
  };

  /**
   * Suppress modal link redirect in WP Customizer
   */
  function modalCustomizer() {
    if (typeof wp.customize !== "undefined") {
      var body = $("body");
      body.off("click.preview");

      body.on("click.preview", "a[href]:not(.modal-link)", function(e) {
        var link = $(this);
        e.preventDefault();
        wp.customize.preview.send("scroll", 0);
        wp.customize.preview.send("url", link.prop("href"));
      });
    }
  }

  // Document Ready
  $(function() {
    // Detect windows width function
    var $window = $(window),
      $document = $(document),
      scrollPos,
      currentURL = window.location.pathname,
      disablePopup = !!window.MSInputMethodContext && !!document.documentMode;

    /**
     * Show modal functionality
     */
    function showModal(postLink, external) {
      scrollPos = window.pageYOffset;
      if (fromPHP.disableScrolling) $("body, html").addClass("no-scroll");
      $(".modal-wrapper").addClass("show");
      $(".modal").addClass("show");

      // trap focus inside modal
      setTimeout(function() {
        trapFocus();
      }, 1000);

      // update address bar to show url of popup content page
      if (postLink) {
        if (postLink.length > 0 && !external) {
          history.replaceState("", "", postLink);
        }
      }
    }

    /**
     * Close modal functionality
     */
    function hideModal(currentURL) {
      var body = $("body");

      // handle scrolling
      if (body.hasClass("no-scroll")) {
        body.removeClass("no-scroll");
        $("html").removeClass("no-scroll");
        window.scroll(0, scrollPos);
      }

      // hide popup
      $(".modal-wrapper")
        .removeClass("show")
        .hide();
      $(".modal").removeClass("show");
      $("#modal-content").empty();

      // return to previous tab location for screen reader users
      if (clickedURL) clickedURL.focus();

      // return oiginal page url in address bar
      if (window.location.pathname !== currentURL) {
        history.replaceState("", "", currentURL);
      }
    }

    $document
      .keyup(function(e) {
        // close modal when pressing esc
        if (e.keyCode === 27 && $(".modal-wrapper").hasClass("show"))
          hideModal(currentURL);
      })
      // Close modal when clicking on close button
      .on("click", ".close-modal", function() {
        hideModal(currentURL);
      })
      // when clicking outside of modal
      .on("click", ".modal", function(e) {
        e.stopPropagation();
      });

    // when clicking outside of modal
    $(window).on("click", function(e) {
      var currentTargetIsLink = event.target instanceof HTMLAnchorElement;
      if (popupOpen() && !currentTargetIsLink) hideModal(currentURL);
    });

    /**
     * Check width
     */
    function initModal() {
      // if the window is greater than breakpoint then show modal, otherwise go to linked page as normal
      if ($window.width() >= fromPHP.breakpoint) {
        var modalUrl = getUrlParameter("modal-link");

        // if using URL parameter to open modal
        if (modalUrl) {
          // show loading animation if styling is turned on
          if (fromPHP.loader) {
            $("#modal-content").html(
              '<img class="loading" src="' +
                fromPHP.pluginUrl +
                '/images/loading.gif" />'
            );
          }

          $.get(modalUrl, function(html) {
            var htmlContent =
              html.indexOf("<html") > -1
                ? $(html)
                    .find(fromPHP.containerID)
                    .html()
                : html;

            $("#modal-content").html(htmlContent);
          });

          // show modal
          $(".modal-wrapper").fadeIn("fast", showModal);
        }

        /**
         * When clicking a modal-link
         */
        $("body").on("click", ".modal-link", function(e) {
          // Define variables
          var modalContent = $("#modal-content");
          var $this =
            $(this).attr("href") != null ? $(this) : $("a", this).first();
          var postLink = $this.attr("href");
          var postSlug =
            postLink.lastIndexOf("/#") > -1
              ? basename(postLink.substring(0, postLink.lastIndexOf("/#"))) +
                basename(postLink)
              : basename(postLink);
          var postAnchor =
            postSlug.lastIndexOf("#") !== -1
              ? postSlug.substring(postSlug.lastIndexOf("#"))
              : false;
          var dataDivID = $this.attr("data-div")
            ? "#" + $this.attr("data-div")
            : fromPHP.containerID;
          var dataBuddypress = $this.attr("data-buddypress");
          var loader =
            '<img class="loading" src="' +
            fromPHP.pluginUrl +
            '/images/loading.gif" />';
          clickedURL = document.activeElement;

          // prevent link from being followed
          e.preventDefault();

          // display loading animation or in this case static content
          if (fromPHP.loader) {
            modalContent.html(loader);
          }

          // Load content from external
          if ($this.isExternal()) {
            // load external content using iframe method
            if ($(this).hasClass("iframe") || fromPHP.iframe) {
              var iframeCode =
                '<iframe src="' +
                $(this).attr("href") +
                '" width="100%"' +
                ' height="600px" frameborder="0"></iframe>';
              modalContent.html(iframeCode);
            }
            // load external content normally
            else {
              $.ajaxPrefilter(function(options) {
                if (options.crossDomain && jQuery.support.cors) {
                  var http =
                    window.location.protocol === "http:" ? "http:" : "https:";
                  options.url =
                    http + "//cors-anywhere.herokuapp.com/" + options.url;
                  //options.url = "http://cors.corsproxy.io/url=" + options.url;
                }
              });

              $.get(postLink, function(html) {
                modalContent.html(
                  $(html)
                    .find(dataDivID)
                    .html()
                );
              });
            }
          }
          // Load content from internal page
          else {
            // when loading buddy press profile
            if (dataBuddypress) {
              modalContent.load(postLink + " #buddypress");
            }
            // load internal content using iframe method
            else if ($(this).hasClass("iframe")) {
              var iframeCode =
                '<iframe src="' +
                $(this).attr("href") +
                '" width="100%"' +
                ' height="600px" frameborder="0"></iframe>';
              modalContent.html(iframeCode);
            }
            // when loading any other type of content
            else {
              // use the rest method
              if (fromPHP.restMethod || $(this).hasClass("rest")) {
                $.get(
                  fromPHP.siteUrl +
                    "/wp-json/wp-post-modal/v1/any-post-type?slug=" +
                    postSlug,
                  function(response) {
                    $.when(modalContent.html(response.post_content)).done(
                      function() {
                        // scroll to anchor
                        setTimeout(function() {
                          if (postAnchor) {
                            $(".modal-wrapper").animate(
                              {
                                scrollTop: $(
                                  "#modal-content " + postAnchor
                                ).offset().top
                              },
                              300
                            );
                          }
                        }, 200);
                      }
                    );
                  }
                );
              }
              // use the default method
              else {
                $.get(postLink, function(html) {
                  var content = $(html).find(dataDivID),
                    htmlContent =
                      html.indexOf("<html") > -1
                        ? $(html)
                            .find(dataDivID)
                            .html()
                        : html;

                  if (content[0]) {
                    $.when(modalContent.html(htmlContent)).done(function() {
                      // scroll to anchor
                      setTimeout(function() {
                        if (postAnchor) {
                          $(".modal-wrapper").animate(
                            {
                              scrollTop: $(
                                "#modal-content " + postAnchor
                              ).offset().top
                            },
                            300
                          );
                        }
                      }, 200);
                    });
                  }
                  // fallback to load method
                  else {
                    modalContent.load(postLink, function() {
                      modalContent.html(
                        $(modalContent.html())
                          .find(dataDivID)
                          .html()
                      );

                      setTimeout(function() {
                        if (postAnchor) {
                          $(".modal-wrapper").animate(
                            {
                              scrollTop: $(
                                "#modal-content " + postAnchor
                              ).offset().top
                            },
                            300
                          );
                        }
                      }, 200);
                    });
                  }
                });
              }
            }
          }

          // show modal
          $(".modal-wrapper").fadeIn("fast", function() {
            // if url state plugin setting is active
            showModal(fromPHP.urlState ? postLink : "", $this.isExternal());
          });
        });
      }
    }

    // Initiate modal if not IE11
    if (!disablePopup) initModal();
  });

  // Window load
  $(window).on("load", function() {
    modalCustomizer();
  });
})(jQuery);
