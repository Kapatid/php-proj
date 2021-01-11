document.addEventListener("DOMContentLoaded", theDomHasLoaded, false);
window.addEventListener("load", pageFullyLoaded, false);

// var location = window.location;
// var pathname = location.pathname;

function theDomHasLoaded(e) {
  //#region Nav effects
  let previousScroll = 0;

  $(window).scroll(function () {
    let currentScroll = $(this).scrollTop();

    if (
      currentScroll > 0 &&
      currentScroll < $(document).height() - $(window).height()
    ) {
      if (currentScroll > previousScroll) {
        $(".main-navigation-scroll").slideUp(200);

        $("#nav-toggle").prop("checked", false);
      } else {
        $(".main-navigation-scroll").slideDown(200);
      }
      previousScroll = currentScroll;
    }
  });
  //#endregion Nav effects
}

function pageFullyLoaded(e) {
  modals();
}

function modals() {
  $(".open-modal").on("click", function () {
    const height = $(window).height();
    let id = $(this).data("id"); // Get id from button
    currentId = id;
    let request = $.get("/store/" + id); // Get place object

    // SHOW MODAL
    if (height > 768) {
      // Desktop view
      $(".container-bg").fadeIn(100, function () {
        $(".container-modal")
          .css({ top: 0, opacity: 0, display: "grid" })
          .animate({ top: 200, opacity: 1 }, 300);
      });
    } else {
      // Mobile view
      $(".container-bg").fadeIn(100, function () {
        $(".container-modal").fadeIn(220).css({ display: "grid" });
      });
    }

    $(".container-modal").css({ top: 0 });

    // $.ajax({
    //     type: "GET",
    //     url: url,
    //     success: function(place) {
    //         console.log(place);
    //     }
    // });

    request.done(function (response) {
      // Change html elements of book modal
      $(".show-origin").html(response.origin);
      $(".show-destination").html(response.destination);
      $(".show-price").html("₱ " + thousandsSeparators(response.price));
    });
  });
}
