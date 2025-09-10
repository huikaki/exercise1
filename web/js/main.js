// //SKip to content
// $(".skipToContent").click(function () {
//   if ($(window).width() > 1279.98) {
//     $("html, body").animate(
//       {
//         scrollTop: $("#content").offset().top - $("header").outerHeight(),
//       },
//       500
//     );
//   }
//   $("#content").focus();

//   return false;
// });

// // meunBar Hover

// const trapFocus = (element, prevFocusableElement = document.activeElement) => {
//   const focusableEls = Array.from(
//     element.querySelectorAll(
//       'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])'
//     )
//   );
//   const firstFocusableEl = focusableEls[0];
//   const lastFocusableEl = focusableEls[focusableEls.length - 1];
//   let currentFocus = null;

//   // if it is mobile menu, focus on the menu toggle first
//   if (element == document.getElementById("mobile-menu")) {
//     $(".custom-toggle ").focus();
//   } //if it is siteSearch wrap, focus on the input field first
//   else if (element == document.getElementById("searchWrap")) {
//     $(".site-search input").focus();
//   }
//   {
//     firstFocusableEl.focus();
//   }
//   currentFocus = firstFocusableEl;
//   const handleFocus = (e) => {
//     e.preventDefault();
//     // if the focused element "lives" in your modal container then just focus it
//     if (focusableEls.includes(e.target)) {
//       currentFocus = e.target;
//     } else {
//       // you're out of the container
//       // if previously the focused element was the first element then focus the last
//       // element - means you were using the shift key
//       if (currentFocus === firstFocusableEl) {
//         lastFocusableEl.focus();
//       } else {
//         // you previously were focused on the last element so just focus the first one
//         firstFocusableEl.focus();
//       }
//       // update the current focus var
//       currentFocus = document.activeElement;
//     }
//   };
//   document.addEventListener("focus", handleFocus, true);
//   return {
//     onClose: () => {
//       document.removeEventListener("focus", handleFocus, true);
//       prevFocusableElement.focus();
//     },
//   };
// };
// var trapped;
// const headerTrap = document.getElementById("mainNavbar");
// $(".custom-toggle ").click(function () {
//   if (!$(".custom-toggle ").hasClass("collapsed")) {
//     $(this).addClass("active");
//     $("header").addClass("opened");
//     trapped = trapFocus(headerTrap);
//   } else {
//     $(this).removeClass("active");
//     $("header").removeClass("opened");
//     trapped.onClose();
//     // 重新启用 header 的焦点陷阱
//     trapped = trapFocus(headerTrap);
//   }
// });

// $("#mainNavbar .nav-item").mouseout(function () {
//   if ($(window).width() > 1200) {
//     document.activeElement.blur();
//     $(this).removeClass("hover");
//     $(this).removeClass("active");
//     $(this).find(".dropdown-menu").removeClass("show");
//   }
// });
// $("#mainNavbar .nav-item").mouseover(function () {
//   if ($(window).width() > 1200) {
//     $(this).addClass("hover");
//     $(this).addClass("active");
//     $(this).find(".dropdown-menu").addClass("show");
//   }
// });

// $("button.custom-toggle ").on("click", function () {
//   $(this)
//     .find(".fa-bars,.fa-xmark")
//     .toggleClass("fa-bars")
//     .toggleClass("fa-xmark");
// });

// $(document).ready(function () {
//   addtouch();
//   if ($(window).width() < 992) {
//     $(".cd-nav-trigger").on("click", function () {
//       $("#cd-vertical-nav").toggleClass("open");
//       console.log("hi");
//     });
//     //close navigation on touch devices when selectin an elemnt from the list
//     $("#cd-vertical-nav a").on("click", function () {
//       $("#cd-vertical-nav").removeClass("open");
//     });
//   }

//   var contentSections = $(".cd-section");
//   var navigationItems = $("#cd-vertical-nav a");

//   updateNavigation();

//   $(window).on("scroll", function () {
//     requestAnimationFrame(updateNavigation);
//     updateSearchWrapperTop();
//   });

//   //smooth scroll to the section
//   navigationItems.on("click", function (event) {
//     event.preventDefault();
//     smoothScroll($(this.hash));
//   });
//   //smooth scroll to second section
//   $(".cd-scroll-down").on("click", function (event) {
//     event.preventDefault();
//     smoothScroll($(this.hash));
//   });

//   function updateNavigation() {
//     const windowHeight = $(window).height();
//     const scrollTop = $(window).scrollTop();

//     contentSections.each(function () {
//       const $this = $(this);

//       const sectionTop = $this.offset().top;
//       const sectionHeight = $this.height();
//       const activeSection =
//         $('#cd-vertical-nav a[href="#' + $this.attr("id") + '"]').data(
//           "number"
//         ) - 1;

//       if (
//         sectionTop - windowHeight / 2 < scrollTop &&
//         sectionTop + sectionHeight - windowHeight / 2 > scrollTop
//       ) {
//         navigationItems.eq(activeSection).addClass("is-selected");
//       } else {
//         navigationItems.eq(activeSection).removeClass("is-selected");
//       }
//     });
//   }
//   function smoothScroll(target) {
//     $("body,html").animate(
//       {
//         scrollTop: target.offset().top - 110,
//       },
//       300
//     );
//     console.log(target.offset().top);
//   }

//   // 初次加載時執行

//   // 滾動時執行

//   function updateSearchWrapperTop() {
//     let header1 = $(".main-header").height();
//     let header2 = $("header").height();
//     let windowWidth = $(window).width();
//     let header3 = header1 + header2;
//     // 根據窗口寬度設置 searchWrapper 的 top
//     if (windowWidth >= 1200) {
//       $(".searchWrapper").css("top", header3);
//     } else {
//       $(".searchWrapper").css("top", header2);
//     }
//   }

//   $(".toggleHide").on("click", function () {
//     $(".searchWrapper").toggleClass("active");
//     // $(".searchWrapper").hide();
//   });
//   // 為 searchBTN 綁定點擊事件（僅執行一次）
//   $("button.searchBTN").on("click", function () {
//     toTop();
//     updateSearchWrapperTop(); // 點擊時更新 top
//     $(".searchWrapper").toggleClass("active");
//   });
//   function toTop() {
//     var rootElement = document.documentElement;
//     rootElement.scrollTo({
//       top: 0,
//       behavior: "smooth",
//     });
//   }
//   updateSearchWrapperTop();
//   // 窗口大小改變時執行
//   function addtouch() {
//     $("html").addClass("no-touch");
//     if ($(window).width() < 992) {
//       $("html").addClass("touch").removeClass("no-touch");
//     } else {
//       $("html").addClass("no-touch").removeClass("touch");
//     }
//   }
//   function updateHeader() {
//     // 獲取當前滾動位置同窗口寬度
//     let scrollTop = $(window).scrollTop();
//     let windowWidth = $(window).outerWidth();

//     // 更新標誌寬度
//     if (windowWidth >= 1200) {
//       console.log(windowWidth);
//       // $(".main-header .navtop.no-mobile").show();
//       if (scrollTop > 52) {
//         $("header .navbar-brand").css("width", 100);
//       } else {
//         $("header .navbar-brand").css("width", 140);
//       }
//     } else {
//       // $(".main-header .navtop.no-mobile").hide();

//       if (scrollTop > 52) {
//         $("header .navbar-brand").css("width", 70);
//       } else {
//         $("header .navbar-brand").css("width", 100);
//       }
//     }

//     // 強制 DOM 重繪以確保標誌尺寸更新後再計算高度

//     // let headerHeight = document.querySelector(
//     //   ".main-header .mainnav"
//     // ).offsetHeight;
//     // console.log(headerHeight);

//     // 更新固定頁眉樣式
//     // if (windowWidth >= 1200) {
//     //   if (scrollTop > 52) {
//     //     $("header .fixed-header").addClass("position-fixed");
//     //     $(".banner-section").css("margin-top", 0);
//     //   } else {
//     //     $("header .fixed-header").removeClass("position-fixed");
//     //     $(".banner-section").css("margin-top", 0);
//     //   }
//     // }
//     // if (windowWidth <= 1199) {
//     //   // 小於1200px時，重置樣式
//     //   $("header .fixed-header").removeClass("position-fixed");
//     //   $(".banner-section").css("margin-top", headerHeight);
//     // }
//   }

//   $(window).scroll(function () {
//     updateHeader();
//   });
//   $(window).resize(function () {
//     updateHeader();
//     updateSearchWrapperTop();
//     addtouch();
//     // 行動裝置導航邏輯
//     if ($(window).width() < 992) {
//       $(".cd-nav-trigger").on("click", function () {
//         $("#cd-vertical-nav").toggleClass("open");
//         console.log("導航開關");
//       });
//       $("#cd-vertical-nav a").on("click", function () {
//         $("#cd-vertical-nav").removeClass("open");
//       });
//     }
//   }); // 等待 100ms 後執行

//   updateHeader();

//   var lightbox = GLightbox();
//   lightbox.on("open", (target) => {
//     console.log("lightbox opened");
//   });

//   var lightboxVideo = GLightbox({
//     selector: ".lightgallery-item",
//   });
//   lightboxVideo.on("slide_changed", ({ prev, current }) => {
//     console.log("Prev slide", prev);
//     console.log("Current slide", current);

//     const { slideIndex, slideNode, slideConfig, player } = current;

//     if (player) {
//       if (!player.ready) {
//         // If player is not ready
//         player.on("ready", (event) => {
//           // Do something when video is ready
//         });
//       }

//       player.on("play", (event) => {
//         console.log("Started play");
//       });

//       player.on("volumechange", (event) => {
//         console.log("Volume change");
//       });

//       player.on("ended", (event) => {
//         console.log("Video ended");
//       });
//     }
//   });

//   var Cookie = "defaultColor";
//   $(document).ready(function () {
//     const htmlElement = document.documentElement;

//     var theme = $.cookie(Cookie) || "default";
//     if (theme == "default") {
//       htmlElement.setAttribute("data-theme", "default");
//       $(".main-header .toggleTheme").removeClass("selected");
//     } else if (theme == "contrast") {
//       htmlElement.setAttribute("data-theme", "contrast");
//       $(".main-header .toggleTheme").addClass("selected");
//     }
//   });

//   $(".main-header .toggleTheme").on("click", function () {
//     $(".main-header .toggleTheme").toggleClass("selected");

//     const htmlElement = document.documentElement;
//     console.log("hi");
//     const currentTheme = htmlElement.getAttribute("data-theme");
//     const newTheme = currentTheme === "default" ? "contrast" : "default";
//     htmlElement.setAttribute("data-theme", newTheme);
//     theme = newTheme;
//     $.cookie(Cookie, theme, {
//       expires: 7,
//       path: "/",
//     });
//     // toggleButton.textContent = htmlElement.classList.contains("high-contrast")
//   });

//   const shareData = {
//     url: document.URL,
//     title: document.title,
//   };
//   const sharebtn = document.getElementById("sharebtn");

//   // Share must be triggered by "user activation"
//   if (sharebtn) {
//     sharebtn.addEventListener("click", async () => {
//       try {
//         await navigator.share(shareData);
//       } catch (err) {
//         console.log(err);
//       }
//     });
//   }
//   const photogalleries = document.querySelectorAll(".photogallery");
//   for (var i = 0; i < photogalleries.length; i++) {
//     photogalleries[i].classList.add("photogallery-" + i);
//     const swiperButtons = photogalleries[i].querySelectorAll(
//       ".swiper-button-next, .swiper-button-prev"
//     );
//     for (var j = 0; j < swiperButtons.length; j++) {
//       swiperButtons[j].classList.add("button-" + i);
//     }

//     var pg = document.querySelector(".photogallery-" + i);
//     var photogalleryThumb = new Swiper(
//       ".photogallery-" + i + " .photogallery-thumb",
//       {
//         spaceBetween: 5,
//         slidesPerView: 5,
//         freeMode: true,
//         watchSlidesProgress: true,
//         navigation: {
//           nextEl: ".swiper-button-next.button-" + i,
//           prevEl: ".swiper-button-prev.button-" + i,
//         },
//         breakpoints: {
//           640: {
//             spaceBetween: 4,
//             slidesPerView: 5,
//           },
//           768: {
//             spaceBetween: 5,
//             slidesPerView: 8,
//           },
//           1024: {
//             spaceBetween: 10,
//             slidesPerView: 10,
//           },
//         },
//       }
//     );

//     var photogallery = new Swiper(
//       ".photogallery-" + i + " .photogallery-main",
//       {
//         spaceBetween: 10,
//         slidesPerView: 1,
//         navigation: {
//           nextEl: ".swiper-button-next.button-" + i,
//           prevEl: ".swiper-button-prev.button-" + i,
//         },
//         thumbs: {
//           swiper: photogalleryThumb,
//         },
//       }
//     );
//   }
// });
// $(function () {
//   var dateFormat = "dd-mm-yy";

//   // 檢查 DOM 元素

//   var from = $("#from")
//     .datepicker({
//       defaultDate: "+1w",
//       changeMonth: true,
//       numberOfMonths: 1,
//       dateFormat: "dd-mm-yy",
//       dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"],
//       monthNamesShort: [
//         "一月",
//         "二月",
//         "三月",
//         "四月",
//         "五月",
//         "六月",
//         "七月",
//         "八月",
//         "九月",
//         "十月",
//         "十一月",
//         "十二月",
//       ],
//     })
//     .on("change", function () {
//       var selectedDate = getDate(this);
//       if (selectedDate) {
//         to.datepicker("option", "minDate", selectedDate);
//       }
//     });

//   var to = $("#to")
//     .datepicker({
//       defaultDate: "+1w",
//       changeMonth: true,
//       numberOfMonths: 1,
//       dateFormat: "dd-mm-yy",
//       dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"],
//       monthNamesShort: [
//         "一月",
//         "二月",
//         "三月",
//         "四月",
//         "五月",
//         "六月",
//         "七月",
//         "八月",
//         "九月",
//         "十月",
//         "十一月",
//         "十二月",
//       ],
//     })
//     .on("change", function () {
//       var selectedDate = getDate(this);
//       if (selectedDate) {
//         from.datepicker("option", "maxDate", selectedDate);
//       }
//     });

//   function getDate(element) {
//     var date;
//     console.log("Input value:", element.value); // 檢查輸入值

//     try {
//       date = $.datepicker.parseDate(dateFormat, element.value);
//     } catch (error) {
//       console.log("Parse error:", error);
//       date = null;
//     }
//     console.log("Parsed date:", date);
//     return date;
//   }
// });
