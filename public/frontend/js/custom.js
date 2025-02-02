// for slick slider

$(".my-slider").slick({
  dots: false,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 1500,
  infinite: true,
  speed: 1500,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});

// for review slider
$(".review-slider").slick({
  dots: false,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 1000,
  infinite: true,
  speed: 1500,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});


// for dyanamic pricing
$(document).ready(function () {
  // Define the prices for each plan and period
  const pricing = {
    monthly: {
      free: "$0",
      professional: "$50",
      enterprise: "$100",
    },
    halfYearly: {
      free: "$0",
      professional: "$270", // Example for 10% discount on 6 months
      enterprise: "$540", // Example for 10% discount on 6 months
    },
    yearly: {
      free: "$0",
      professional: "$500", // Example for 20% discount on 12 months
      enterprise: "$1000", // Example for 20% discount on 12 months
    },
  };

  // Function to update prices and period text based on selected option
  function updatePricing(period) {
    $("#free-price").text(pricing[period].free);
    $("#professional-price").text(pricing[period].professional);
    $("#enterprise-price").text(pricing[period].enterprise);

    // Update the period text on each card
    $(".pricing-period").text(
      period === "monthly"
        ? "/ Month"
        : period === "halfYearly"
        ? "/ 6 Months"
        : "/ Year"
    );
  }

  // Listen for changes on the radio buttons
  $("input[name='pricing-period']").change(function () {
    const selectedPeriod = $(this).val();
    updatePricing(selectedPeriod);
  });

  // Initialize with monthly pricing by default
  updatePricing("monthly");
});

// for venobox
new VenoBox({
  selector: ".my-video-links",
});


// for hiding extra cards

$(document).ready(function () {
  const cards = $('.mix');

  // Initially hide all cards after the first 3
  const showInitialCards = () => {
      cards.slice(3).hide();
  };

  // Toggle between showing and hiding extra cards
  $('#toggle-btn').click(function () {
      const isExpanded = $(this).text() === 'Hide';
      cards.slice(3).toggle(!isExpanded);
      $(this).text(isExpanded ? 'More' : 'Hide');
  });

  // Set up initial view
  showInitialCards();
});