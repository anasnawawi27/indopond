var swiper = new Swiper(".swiper-hero", {
  loop: true, // Loop mode
  navigation: {
    nextEl: "#hero-next",
    prevEl: "#hero-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 3000,
  },
});

function currencyFormatter(value) {
  var numberFormatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  });
  let currency = numberFormatter.format(value);
  return [currency].join("");
}
$(document).ready(function () {
  $(".btn-variant").on("click", function () {
    $(".btn-variant").removeClass("active-variant");
    const price = $(this).data("price");
    $(".price").text(currencyFormatter(price));
    $(this).addClass("active-variant");
  });

  $('input[type="checkbox"].filter-category').change(function () {
    var selectedCategories = [];
    $('input[type="checkbox"].filter-category:checked').each(function () {
      selectedCategories.push($(this).val());
    });

    // Create the URL with the 'categories' GET parameter
    var categoriesParam = selectedCategories.join(","); // Combine selected values with comma

    // Get the current URL and append the new 'categories' parameter
    var currentUrl = window.location.href.split("?")[0]; // Remove existing query string (if any)
    var params = new URLSearchParams(window.location.search); // Get current GET parameters

    // Set or update the categories parameter
    if (categoriesParam) {
      params.set("categories", categoriesParam); // Set 'categories' parameter with the selected values
    } else {
      params.delete("categories"); // Remove 'categories' parameter if no checkbox is selected
    }

    // Update the URL without reloading the page
    // Update the URL without reloading the page
    var newUrl = currentUrl + "?" + params.toString();
    window.location.href = newUrl;
  });
});

function handleSearch() {
  let searchQuery = $("#search-input").val();
  let currentUrl = window.location.href;
  let currentParams = new URLSearchParams(window.location.search);

  currentParams.set("name", searchQuery);

  let newUrl = "/search?" + currentParams.toString();
  window.location.href = newUrl;
}

$("#search-form").submit(function (event) {
  event.preventDefault();
  handleSearch();
});

$("#search-input").keypress(function (event) {
  if (event.which == 13) {
    handleSearch();
  }
});

$(".remove-filter").click(function () {
  var type = $(this).data("type");
  var value = $(this).data("value");

  // Ambil parameter GET yang ada di URL
  var currentParams = new URLSearchParams(window.location.search);

  // Hapus parameter berdasarkan type dan value
  if (type === "search") {
    currentParams.delete("name"); // Menghapus parameter pencarian
  } else if (type === "category") {
    var categories = currentParams.get("categories");
    if (categories) {
      var categoriesArray = categories.split(",");
      categoriesArray = categoriesArray.filter(function (item) {
        return item !== value.toString(); // Hapus kategori yang dipilih
      });
      if (categoriesArray.length) {
        currentParams.set("categories", categoriesArray.join(","));
      } else {
        currentParams.delete("categories");
      }
    }
  }

  // alert(JSON.stringify(currentParams));
  var newUrl = window.location.pathname + "?" + currentParams.toString();
  window.location.href = newUrl;
});
