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
  storeFunctions();
}

function storeFunctions() {
  let itemsInCart = [];
  let jsonString = JSON.stringify(itemsInCart);

  $(".icon-search").on("click", function () {
    storeSearch();
  });

  $("#store-search").keypress(function (e) {
    if (e.which == 13) {
      storeSearch();
    }
  });

  $(".btn-store-add").on("click", function () {
    let id = $(this).data("id"); // Get id from button

    // populate itemsInCart
    if (!itemsInCart.includes(id)) {
      itemsInCart.push(id);
      console.log("Item added in cart");
    } else {
      console.log("Item is already in cart");
    }

    $.ajaxSetup({ cache: false });

    // Put all cart items into a $_SESSION
    $.get("item?item_id=" + jsonString, function () {
      alert("Update");
    });

    $("#store-item-count").css({ display: "grid" }).html(itemsInCart.length);
  });

  $(".open-modal").on("click", function () {
    const height = $(window).height();

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
  });

  $(".exit-modal-book").on("click", function () {
    // Animation for exit
    $(".container-bg").fadeOut(220);
    $(".container-modal").fadeOut(220);
  });
}

/**
 * Search function for search bar
 *
 * @return void
 */
function storeSearch() {
  const allStoreItems = $(".container-store-item")
    .map(function () {
      return this;
    })
    .get();

  for (let i in allStoreItems) {
    let itemName = allStoreItems[
      i
    ].firstElementChild.nextElementSibling.innerHTML
      .toLowerCase()
      .includes($("#store-search").val().toLowerCase());

    if (itemName != false) {
      $(allStoreItems[i]).show();
    } else {
      $(allStoreItems[i]).hide();
    }
  }
}
