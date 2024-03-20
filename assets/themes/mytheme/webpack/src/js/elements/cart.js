$(document).ready(function () {
  $(document).on("click", ".ajax_add_cart", function (e) {
    e.preventDefault();
    $(this).text("go to cart");
    $(this).removeClass("ajax_cart");
    $(this).attr("href", $(this).attr("data-url_cart"));
    let id = $(this).attr("data-product_id");
    let quantity = $(this).attr("data-quantity");
    addToCart(id, quantity);
  });

  $(document).on("click", ".ajax_remove_cart", function (e) {
    e.preventDefault();
    let id = $(this).attr("data-product_id");
    let quantity = $(this).attr("data-quantity");
    removeFromCart(id, quantity);
  });

  function addToCart(id, quantity) {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "addProductToCart",
        id: id,
        quantity: quantity,
      },
      beforeSend: function (xhr) {
        $("#content").css({
          "pointer-events": "none",
          opacity: ".7",
          cursor: "wait",
        });
      },
      success: function (data) {
        if ($(".cart-icon .count-products span").length) {
          $(".cart-icon .count-products span").text(data);
        } else {
          $(".cart-icon").html(
            $(".cart-icon").html() +
              '<div class="count-products"><span>' +
              data +
              "</span></div>"
          );
        }

        $("#content").css({
          "pointer-events": "all",
          opacity: "1",
          cursor: "default",
        });
      },
    });
  }

  function removeFromCart(id, quantity) {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "addProductToCart",
        id: id,
        quantity: quantity,
      },
    });
  }
});
