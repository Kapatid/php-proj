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
        $(".main-navigation-scroll").slideUp(100);
        $("#nav-toggle").prop("checked", false);
      } else {
        $(".main-navigation-scroll").slideDown(100);
      }
      previousScroll = currentScroll;
    }
  });
  //#endregion Nav effects
}

function pageFullyLoaded(e) {
  storeFunctions();
  carousel();
}

/**
 * Search bar,
 * Add to cart button,
 * Buy button,
 * Store modal
 */
function storeFunctions() {
  var itemsInCart = [];
  var itemString = "";
  var items = [];

  $(".icon-search").on("click", function () {
    storeSearch();
  });

  $("#store-search").keypress(function (e) {
    if (e.which == 13) {
      storeSearch();
    }
  });

  $(".btn-store-buy").on("click", function () {
    let tempData = JSON.stringify(itemsInCart);
    $.ajax({
      url: "purchase",
      type: "post",
      data: { purchases: tempData },
      success: function (d) {},
    });

    alert("Thank you for buying from our store! \u{1F604}");
    location.reload();
  });

  // When people click add to cart button
  $(".btn-store-add").on("click", function () {
    let id = $(this).data("id"); // Get id from button

    // populate itemsInCart
    if (!itemsInCart.includes(id)) {
      itemsInCart.push(id);
      console.log("Item added in cart");
    } else {
      console.log("Item is already in cart");
    }

    // Put all cart items into a $_SESSION
    $.get("item?item_id=" + JSON.stringify(itemsInCart)).done(function (
      response
    ) {
      items = JSON.parse(response);

      for (i = 0; i < items.length; i++) {
        let itemPrice = thousandsSeparators(items[i]["item_price"]);
        let newSetOfITems = `<tr>
                            <td class="cart-item-name">${items[i]["item_name"]}</td>
                            <td class="cart-item-price">₱ ${itemPrice}</td>
                        </tr>`;

        // Prevent product duplicates in receipt
        if (!itemString.includes(newSetOfITems)) {
          itemString += `<tr>
                            <td class="cart-item-name">${items[i]["item_name"]}</td>
                            <td class="cart-item-price">₱ ${itemPrice}</td>
                        </tr>`;
        }
      }
    });

    $("#store-item-count").css({ display: "grid" }).html(itemsInCart.length);
  });

  $(".open-modal").on("click", function () {
    // Udpate receipt
    if (itemsInCart.length >= 1) {
      $("#modal-content-checkout").html(`<table>
                                            <tr>
                                                <th>ITEM NAME</th>
                                                <th>PRICE</th>
                                            </tr>
                                            ${itemString}
                                            <tr style="border-top: 2px solid black;">
                                                <td style="text-align: end; font-size:0.8rem; font-weight:bold;">
                                                  TOTAL:
                                                </td>
                                                <td id="cart-total">₱ 0</td>
                                            </tr>
                                        </table>`);
    }

    updateCartTotal();
    const height = $(window).height();

    // SHOW MODAL
    if (height > 768) {
      // Desktop view
      $(".container-bg").fadeIn(100, function () {
        $(".container-modal")
          .css({ top: 0, opacity: 0, display: "grid" })
          .animate({ top: 100, opacity: 1 }, 300);
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

/**
 * Update cart total text
 */
function updateCartTotal() {
  let allCartItemPrices = $(".cart-item-price")
    .map(function () {
      return parseFloat(this.innerHTML.replace("₱ ", "").replace(",", ""));
    })
    .get();

  // Increment total variable for each item's price in our cart
  let total = 0;
  for (let i in allCartItemPrices) {
    total += allCartItemPrices[i];
  }

  let stringTotal = thousandsSeparators(total);

  // Update total text by using class
  $("#cart-total").html(`₱ ${stringTotal}`);
  console.log(stringTotal);
}

// Source: https://www.w3resource.com/javascript-exercises/javascript-math-exercise-39.php
function thousandsSeparators(num) {
  var num_parts = num.toString().split(".");
  num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num_parts.join(".");
}

/**
 * Can be used for multiple carousels just follow
 * HTML structure
 *
 * Author: Nadji Tan
 */
function carousel() {
  // const MINLEFT = parseInt(
  //     $(".container-container")
  //         .css("left")
  //         .replace("%", "")
  // ); // Minimum left percentage

  let allCarousel = $(".carousel")
    .map(function () {
      return this;
    })
    .get();

  // This is used because left percentage keeps getting out of bounds
  const MINLEFT = 100;

  for (let i in allCarousel) {
    const maxSteps = $("#steps-counter").attr("max");
    let currentLeft = MINLEFT; // Left percentage that changes based on what is pressed
    let currentStep = 1; // Current step the user is in

    checkStep(currentStep, maxSteps, allCarousel[i]);

    $(allCarousel[i]).find(`.rect-${currentStep}`).css({
      "background-color": "rgba(0, 0, 0, 0.568)",
    });

    // STEP NEXT BUTTON
    $(allCarousel[i])
      .find(".btn-next")
      .on("click", function () {
        if (currentLeft !== -MINLEFT) {
          $(allCarousel[i]).find(`.rect-${currentStep}`).css({
            "background-color": "rgba(128, 128, 128, 0.459)",
          }); // Previous step

          currentStep++;

          $(allCarousel[i]).find(`.rect-${currentStep}`).css({
            "background-color": "rgba(0, 0, 0, 0.568)",
          }); // Current step

          currentLeft -= MINLEFT;

          $(allCarousel[i])
            .find(".container-container")
            .animate({ left: `${currentLeft}%` }, 500); // Step container animation
        }

        checkStep(currentStep, maxSteps, allCarousel[i]);
      });

    // STEP BACK BUTTON
    $(allCarousel[i])
      .find(".btn-back")
      .on("click", function () {
        if (currentLeft !== MINLEFT) {
          $(allCarousel[i]).find(`.rect-${currentStep}`).css({
            "background-color": "rgba(128, 128, 128, 0.459)",
          });

          currentStep--;

          $(allCarousel[i]).find(`.rect-${currentStep}`).css({
            "background-color": "rgba(0, 0, 0, 0.568)",
          });

          currentLeft += MINLEFT;

          $(allCarousel[i])
            .find(".container-container")
            .animate({ left: `${currentLeft}%` }, 500);
        }

        checkStep(currentStep, maxSteps, allCarousel[i]);
      });
  }

  // CAN ONLY BE USED FOR ONE CAROUSEL
  // const maxSteps = $("#steps-counter").attr("max");
  // let currentLeft = MINLEFT; // Left percentage that changes based on what is pressed
  // let currentStep = 1; // Current step the user is in

  // checkStep(currentStep, maxSteps);

  // $(`.rect-${currentStep}`).css({
  //   "background-color": "rgba(0, 0, 0, 0.568)",
  // });

  // $(".btn-next").on("click", function () {
  //   if (currentLeft !== -MINLEFT) {
  //     $(`.rect-${currentStep}`).css({
  //       "background-color": "rgba(128, 128, 128, 0.459)",
  //     }); // Previous step

  //     currentStep++;

  //     $(`.rect-${currentStep}`).css({
  //       "background-color": "rgba(0, 0, 0, 0.568)",
  //     }); // Current step

  //     currentLeft -= MINLEFT;

  //     $(".container-container").animate({ left: `${currentLeft}%` }, 500); // Step container animation
  //   }

  //   checkStep(currentStep, maxSteps);
  // });

  // $(".btn-back").on("click", function () {
  //   if (currentLeft !== MINLEFT) {
  //     $(`.rect-${currentStep}`).css({
  //       "background-color": "rgba(128, 128, 128, 0.459)",
  //     });

  //     currentStep--;

  //     $(`.rect-${currentStep}`).css({
  //       "background-color": "rgba(0, 0, 0, 0.568)",
  //     });

  //     currentLeft += MINLEFT;

  //     $(".container-container").animate({ left: `${currentLeft}%` }, 500);
  //   }

  //   checkStep(currentStep, maxSteps);
  // });
}

// $(parentElement).find    Makes it usable for multiple carousels
function checkStep(currentStep, maxSteps, parentElement) {
  if (currentStep != 1) {
    $(parentElement).find(".btn-back").css("visibility", "visible");
  } else {
    $(parentElement).find(".btn-back").css("visibility", "hidden");
  }

  if (currentStep < maxSteps) {
    $(parentElement).find(".btn-next").css("visibility", "visible");
  } else {
    $(parentElement).find(".btn-next").css("visibility", "hidden");
  }
}
