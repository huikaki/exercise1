$(document).ready(function() {
	/*const swiper = new Swiper('.swiper-5col1row', {
	  // Default parameters
		slidesPerView: 5,
	  	spaceBetween: 0,
		loop: false,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1.5,
		  spaceBetween: 20,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 2.2,
		  spaceBetween: 20,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2.5,
		  spaceBetween: 20,
		},
		// when window width is >= 991px
		991: {
		  slidesPerView: 3,
		  spaceBetween: 10,
		},
		// when window width is >= 1180px
		1180: {
		  slidesPerView: 5,
		  spaceBetween: 10,
		}
	  },
		 navigation: {
		nextEl: '.swiper-button-next.swiper-5col1row-arrow-right',
		prevEl: '.swiper-button-prev.swiper-5col1row-arrow-left',
	  },
	});*/
	
	const swiper1 = new Swiper('.swiper-carousel', {
	  // Default parameters
		slidesPerView: 1,
		spaceBetween: 0,
		autoplay: {
			delay: 2000,
			disableOnInteraction: false,
		  },
		loop: true,
		draggable: true,
	  // Responsive breakpoints
		 navigation: {
		nextEl: '.swiper-button-next.swiper-carousel-arrow-right',
		prevEl: '.swiper-button-prev.swiper-carousel-arrow-left',
	  },
	})
	
	const swiper2 = new Swiper('.swiper-mainthemes', {
	  // Default parameters
		slidesPerView: 1,
		spaceBetween: 0,
		loop: true,
		draggable: true,
		autoplay: true,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1,
		  spaceBetween: 30,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 1.5,
		  spaceBetween: 30,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2.5,
		  spaceBetween: 30,
		},
		// when window width is >= 991px
		991: {
		  slidesPerView: 3.1,
		  spaceBetween: 30,
		},
		// when window width is >= 1180px
		1200: {
		  slidesPerView: 4,
		  spaceBetween: 30,
		}
	  },
		 navigation: {
		nextEl: '.swiper-button-next.swiper-mainthemes-arrow-right',
		prevEl: '.swiper-button-prev.swiper-mainthemes-arrow-left',
	  },
	})
	
	const swiper3 = new Swiper('.swiper-keydates-local', {
	  // Default parameters
		slidesPerView: 1,
		spaceBetween: 20,
		loop: false,
		draggable: true,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
			slidesPerView: 1.5,
		  spaceBetween: 20,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 2,
		  spaceBetween: 20,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 3,
		  spaceBetween: 30,
		},
		// when window width is >= 991px
		991: {
		  slidesPerView: 3,
		  spaceBetween: 30,
		},
		// when window width is >= 1180px
		1180: {
		  slidesPerView: 5,
		  spaceBetween: 50,
		}
	  },
		 navigation: {
		nextEl: '.swiper-button-next.swiper-keydates-local-arrow-right',
		prevEl: '.swiper-button-prev.swiper-keydates-local-arrow-left',
	  },
	})
	
	const swiper4 = new Swiper('.swiper-keydates-nonlocal', {
	  // Default parameters
		slidesPerView: 6,
	  	spaceBetween: 0,
		loop: false,
		draggable: true,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1.5,
		  spaceBetween: 30,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 2.2,
		  spaceBetween: 30,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2.5,
		  spaceBetween: 30,
		},
		// when window width is >= 991px
		991: {
		  slidesPerView: 3,
		  spaceBetween: 30,
		},
		// when window width is >= 1180px
		1180: {
		  slidesPerView: 6,
		  spaceBetween: 50,
		}
	  },
		 navigation: {
		nextEl: '.swiper-button-next.swiper-keydates-nonlocal-arrow-right',
		prevEl: '.swiper-button-prev.swiper-keydates-nonlocal-arrow-left',
	  },
	})
	
	const swiper5 = new Swiper('.swiper-testimonials', {
	  // Default parameters
		slidesPerView: 6,
		spaceBetween: 0,
		//centeredSlides: true,
		centerInsufficientSlides: true,
		draggable: true,
		loop: true,
		autoplay: true,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1,
		  spaceBetween: 30,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 1.5,
		  spaceBetween: 30,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2,
		  spaceBetween: 30,
		},
		// when window width is >= 991px
		991: {
		  slidesPerView: 3.5,
		  spaceBetween: 30,
		},
		// when window width is >= 1180px
		1200: {
		  slidesPerView: 4,
		  spaceBetween: 30,
		},
		1500: {
		  slidesPerView: 5,
		  spaceBetween: 30,
		}
	  },
		 navigation: {
		nextEl: '.swiper-button-next.swiper-testimonials-arrow-right',
		prevEl: '.swiper-button-prev.swiper-testimonials-arrow-left',
	  },
	})
	
	const swiper6 = new Swiper('.swiper-updates1', {
	  // Default parameters
	  slidesPerView: 1,
	  spaceBetween: 20,
		draggable: true,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1.1,
		  spaceBetween: 20,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 1.5,
		  spaceBetween: 20,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2.1,
		  spaceBetween: 20,
		},
		// when window width is >= 768px
		768: {
		  slidesPerView: 2.5,
		  spaceBetween: 20,
		},
		 // when window width is >= 1180px
		1180: {
		  slidesPerView: 3,
		  spaceBetween: 30,
		}
	  },
		pagination: {
		el: '.swiper-pagination.swiper-updates1-pagination',
		clickable: true,
	  },
	})
	
	const swiper7 = new Swiper('.swiper-updates2', {
	  // Default parameters
	  slidesPerView: 1,
	  spaceBetween: 20,
		draggable: true,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1.1,
		  spaceBetween: 20,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 2.1,
		  spaceBetween: 20,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2.1,
		  spaceBetween: 20,
		},
		// when window width is >= 768px
		768: {
		  slidesPerView: 3,
		  spaceBetween: 20,
		}
	  },
		pagination: {
		el: '.swiper-pagination.swiper-updates2-pagination',
		clickable: true,
	  },
	})
	
	const swiper8 = new Swiper('.swiper-updates3', {
	  // Default parameters
	  slidesPerView: 1,
	  spaceBetween: 20,
		draggable: true,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1.1,
		  spaceBetween: 20,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 2.1,
		  spaceBetween: 20,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2.1,
		  spaceBetween: 20,
		},
		// when window width is >= 768px
		768: {
		  slidesPerView: 3,
		  spaceBetween: 20,
		}
	  },
		pagination: {
		el: '.swiper-pagination.swiper-updates3-pagination',
		clickable: true,
	  },
	})
//	
//	const swiper9 = new Swiper('.swiper-logoloop', {
//	  // Default parameters
//		slidesPerView: 'auto',
//		spaceBetween: 80,
//		loop: true,
//		speed: 3000,
//		freeMode: true,
//	  grabCursor: true,
//		a11y: false,
//	  	autoplay: {
//			delay: 0,
//			disableOnInteraction: false,
//			pauseOnMouseEnter: true,
//		},
//	});
	let SwiperTop = new Swiper('.swiper-logoloop', {
		spaceBetween: 0,
		centeredSlides: true,
		speed: 3000,
		autoplay: {
			delay: 1,
		},
		loop: true,
		slidesPerView:'auto',
		allowTouchMove: true
//		disableOnInteraction: true
	});
	
	const swiper10 = new Swiper('.swiper-about-whkt', {
	  // Default parameters
		slidesPerView: 3,
	  	spaceBetween: 0,
		centerInsufficientSlides: true,
		loop: false,
	  // Responsive breakpoints
	  breakpoints: {
		// when window width is >= 320px
		320: {
		  slidesPerView: 1.5,
		  spaceBetween: 30,
		},
		// when window width is >= 480px
		480: {
		  slidesPerView: 1.5,
		  spaceBetween: 30,
		},
		// when window width is >= 640px
		640: {
		  slidesPerView: 2.2,
		  spaceBetween: 30,
		},
		// when window width is >= 991px
		991: {
		  slidesPerView: 3,
		  spaceBetween: 30,
		},
		// when window width is >= 1180px
		1180: {
		  slidesPerView: 3,
		  spaceBetween: 30,
		}
	  },
		 navigation: {
		nextEl: '.swiper-button-next.swiper-about-whkt-arrow-right',
		prevEl: '.swiper-button-prev.swiper-about-whkt-arrow-left',
	  },
	});
	
})