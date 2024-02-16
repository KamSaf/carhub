$(function() {
    $(".show-car-details").on("click", function() {
      var modal = new bootstrap.Modal(document.getElementById("car_details_modal"));
      modal.show();
    });

    // $(".confirm-delete-profile-button").on("click", function() {
    //   var userId = $(this).data("userId");
    // });
});

$(function() {
    $(".show-all-workshops").on("click", function() {
      var modal = new bootstrap.Modal(document.getElementById("workshops_list_modal"));
      modal.show();
    });

    // $(".save-edit-profile-button").on("click", function() {
    //   var userId = $(this).data("userId");
    // });
});

$(function() {
    $(".show-all-cars").on("click", function() {
      var modal = new bootstrap.Modal(document.getElementById("cars_list_modal"));
      modal.show();
    });

    // $(".save-edit-profile-button").on("click", function() {
    //   var userId = $(this).data("userId");
    // });
});