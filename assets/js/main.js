var base = '/breastadvocateapp/'; // localhost
//var base = '/breast-advocate/'; // My server
//var base = '/'; // BA's server

var siteDomain = base + 'ajax';
var popState = false;

const animationEnd = 'animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd';
const transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd';

var mobile = false;

if ($(window).width() < 800) mobile = true;
console.log(mobile);

var modal = {

	open: false,

	type: 'page',

	create: function(post_id, pageurl) {
		modal.open = true;

		var structure = '<div class="modal-overlay fade-in ' + this.type + '"><div class="load-icon"><i class="fas fa-circle-notch fa-spin"></i></div>';
			structure += '<div class="modal-box"><div id="exit"><i class="fas fa-times"></i></div><div class="modal-content">';
			structure += '</div></div>';
			structure += '</div>';


		$('#overlay').prepend(structure).addClass('active');
		console.log('Modal type: ' + modal.type);


///------------------------------

		switch(modal.type) {
			case 'video':
				var video = '<iframe width="560" height="315" src="'
					video += pageurl;
					video += '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				$('.modal-box').addClass('fade-in video');
				$('.load-icon').addClass('animated fadeOut');
				$('.load-icon').bind(animationEnd, function() {
					$('.load-icon').remove();
				});
				$('html').css({'overflow-y': 'hidden'});
				$('.modal-content').html(video).addClass('fade-in-slow');
			break;

			case 'testimonial':
				$('.load-icon').remove();
				var testImg = $('#img-' + post_id).val();
				var title = $('#title-' + post_id).val();
				var	testimonial = '<img src="' + testImg + '" style="width:100%">';
					testimonial += '<div class="testimonial-text"><h3 class="center-text" style="margin-top: 0">' + title + '</h3>';
					testimonial += $('#content-' + post_id).val();
					testimonial += '</div>';
				$('.modal-box').addClass('zoom-in popup');
				$('html').css({'overflow-y': 'hidden'});
				$('.modal-content').html(testimonial);
				setTimeout(function() {
					$('.modal-content').addClass('fade-in-slow');
				}, 400)
			break;

			case 'signup':
				var signUp = $('.contact-content');
				$('.modal-box').addClass('fade-in');
				$('html').css({'overflow-y': 'hidden'});
				$('#overlay').css('overflow-y', 'scroll');
				$('.modal-content').prepend(signUp);
				signUp.css({'display': 'block'})
				setTimeout(function() {
					$('.load-icon').addClass('animated fadeOut');
					$('.load-icon').bind(animationEnd, function() {
						$('.load-icon').remove();
					});
					$('#overlay').scrollTop(1);
					$('.modal-content').addClass('fade-in-slow');
				}, 600)
			break;

			case 'popup':

			break;

			case 'about-page':
				modal.load(post_id, pageurl);
				$('.modal-box').addClass('animated slideInUp');
				$('html').css({'overflow-y': 'hidden'});
				$('#overlay').css('overflow-y', 'scroll');
			break;

			case 'page':
			default:
				modal.load(post_id, pageurl);
				$('html').css({'overflow-y': 'hidden'});
				$('#overlay').css('overflow-y', 'scroll');
			break;
		}

		setTimeout(function() {
			$('.modal-overlay').removeClass('fade-in');
		}, 250);
	},

	changePage: function(post_id, pageurl) {
		$('.load-icon').removeClass('fadeOut');
		$('.load-icon').bind(animationEnd, function() {
			$('.load-icon').remove();
		});
		$('.modal-content').addClass('fade-out-slow');
		setTimeout(function() {
			//$('.modal-content').removeClass('fade-out-slow fade-in-slow');
			modal.load(post_id, pageurl);
		}, 500);
	},

	load: function(post_id, pageurl) {

		if (pageurl != window.location && pageurl != undefined && !popState) {
			history.pushState({path: pageurl}, '', pageurl);
		}

		if (pageurl != undefined) {
			siteDomain = pageurl;
		} else {
			siteDomain = base + 'ajax';
		}


		$.ajaxSetup({cache:false});
		$('.modal-box').addClass('fade-in');
		$('.modal-content').load(siteDomain, {id: post_id}, function(responseText, textStatus, req) {
			$('.load-icon').addClass('animated fadeOut');
			$('.load-icon').bind(animationEnd, function() {
				$('.load-icon').remove();
			});
			$('#overlay').scrollTop(1);

			setTimeout(function() {
				$('.modal-content').addClass('fade-in-slow').removeClass('fade-out-slow');
				$('body').addClass('noscroll');
				var title = $('.page h1').first().text();
				if (modal.type == 'page') document.title = title + ' | Breast Advocate® App';

				// Refresh Popup
				if (!mobile) bioEp.shown = false;
				//$('meta[property="og:title"]').attr('content', title);
			}, 250);

			if (req.statusText == 'Not Found') {
				$('.modal-content').html('<h1>Page Not Found</h1><p>Sorry!</p>');
			}
		});

		return false;

	},

	destroy: function() {
		var signUp = $('.contact-content');
		if (modal.open) {
			if (!popState) history.pushState({path: base}, '', base);
			$('.modal-overlay').addClass('fade-out');
			modal.open = false;

			$('html').css({'overflow-y': 'auto'});
			 $('#overlay').css('overflow-y', 'hidden');
			 $('body').removeClass('noscroll');

			setTimeout(function() {
				if (signUp.length != 0) $('.contact-form-container').prepend(signUp);
				$('.modal-overlay').remove();
				$('#overlay').removeClass('active');
				document.title = 'Breast Advocate® App';

				// Refresh Popup
				bioEp.shown = false;
			}, 250)
		};
	}

};


//
//
//
$.fn.isInViewport = function(diff) {
	if (diff == null) {
		diff = 0;
	}

	var elementTop = $(this).offset().top + diff;
	var elementBottom = elementTop + $(this).outerHeight();
	var viewportTop = $(window).scrollTop();
	var viewportBottom = viewportTop + $(window).height();
	return elementBottom > viewportTop && elementTop < viewportBottom;
};

jQuery(document).ready(function($) {

	overlay = $('#overlay');
	$('#overlay').scroll(function() {
		// console.log(overlay[0].scrollHeight - $('#overlay').scrollTop() - $('#overlay').outerHeight());
		if ($('#overlay').scrollTop() < 1) {
			$('#overlay').scrollTop(1);
			// console.log('yo');
		} else if (overlay[0].scrollHeight - $('#overlay').scrollTop() - $('#overlay').outerHeight() <= 1) {
			$('#overlay').scrollTop($('#overlay').scrollTop() - 1);
			// console.log('what?');
		}
	});


	//
	//
	// iPhone slider
	var slides = $('.slide');
	var sliderEnd = 100 * (slides.length - 1);

	var i = 0;
	slides.each(function() {
		$(this).css('transform', 'translate3d(' + i + '%, 0, 0)');
		i += 100;
	})

	setTimeout(function() {
		slides.addClass('transition');
	}, 400)

	setInterval(function() {
		if (!modal.open) {
			var i = 100;
			slides.each(function() {
				$(this).css('transform', 'translate3d(' + (-i) + '%, 0, 0)').addClass('transition');
				i -= 100;
			})
			setTimeout(function() {
				$(slides[0]).appendTo('.slide-container').removeClass('transition').css('transform', 'translate3d(' + sliderEnd + '%, 0, 0)').addClass('transition');
				slides = $('.slide');
			}, 400)
		}
	}, 5000);


	//
	//
	// Ad rotation
	setTimeout(function() {
		$('.banner-overlay').fadeOut(500);
	}, 500);

	$('ul.ads-list').each(function() {
		var list = $(this);
		console.log(list);
		var ads = $(this).children('li');
		shuffleAds(ads, list);

		var i = 0;
		ads.each(function() {
			$(this).css('transform', 'translate3d(' + i + '%, 0, 0)');
			i += 100;
		});

		setTimeout(function() {
			ads.addClass('transition');
		}, 400)


		var adInterval = 10000;
		var activeAd = 0;
		setTimeout(function() {
			changeAd(list, ads, activeAd);
		}, adInterval);
	})

function shuffleAds(ads, list) {
	ads.sort(() => Math.random() - 0.5);

	for (var i = 0; i < ads.length; i++) {
		list.append(ads[i]);
	}
}

function changeAd(list, ads, activeAd) {
	var adsEnd = 100 * (ads.length - 1);
	if (!modal.open) {
		activeAd++;
		if (activeAd == ads.length) activeAd = 0;
		switch(activeAd) {
			default:  adInterval = 10000; break;
		}

		var i = 100;
		ads.each(function() {
			$(this).css('transform', 'translate3d(' + (-i) + '%, 0, 0)').addClass('transition');
			i -= 100;
		})
		setTimeout(function() {
			$(ads[0]).appendTo(list).removeClass('transition').css('transform', 'translate3d(' + adsEnd + '%, 0, 0)').addClass('transition');
			ads =  list.children('li');
		}, 400)

		setTimeout(function() {
			changeAd(list, ads, activeAd);
		}, adInterval);

		console.log(adInterval);
	}
}



// -------------------------------------------------------------- //
// -------------------------------------------------------------- //
// -------------------------------------------------------------- //




// -------------------------------------------------------------- //
// -------------------------------------------------------------- //
// -------------------------------------------------------------- //

// Scroll events, including:
//
	// Parallax for background images
	//
	// Animations for elements in viewport
var inView = false;
var reminderInView = false;
var titles = $('h2.about-title');
var phones = $('.phone');
$(window).scroll(function() {
    var scrollTop = $(window).scrollTop();
    var imgPos = -(scrollTop / 5) + 'px';
    $('.circles').find('.bg-circle').css('transform', 'translateY(' + imgPos + ')');

    if ($('.about-header').isInViewport(250) && !inView) {
    	inView = true;

    	var delay = 0;
    	titles.each(function() {
    		var title = $(this);
    		setTimeout(function() {
    			if (title.parent('#community').length) {
    				title.addClass('fadeInRight');
    			} else {
					title.addClass('fadeInLeft');
    			}
    		}, delay);
    		delay += 250;
    	});

    	delay = 0;
    	phones.each(function() {
    		var phone = $(this);
    		setTimeout(function() {
    			phone.addClass('animated fadeInUp');
    		}, delay);
    		delay += 250;
    	})
    }

    if ($('.reminder').length && $('.reminder').isInViewport(250) && !reminderInView) {
    	$('.reminder').addClass('animated fadeInRight');
    	reminderInView = true;
    	setTimeout(function() { $('.reminder').removeClass('offscreen fadeInRight')}, 1000)
    }
});


$(document).on('click', '.reminder__dismiss', function() {
	$('.reminder').addClass('fadeOutRight');
	setTimeout(function() {
		$('.reminder').remove();
	}, 1000);
})



// -------------------------------------------------------------- //
// -------------------------------------------------------------- //
// -------------------------------------------------------------- //

// Modal control
$(document).on('click', 'a.modal, .modal', function(e) {
	e.preventDefault();
	var pageurl;
	var canChange = true;
	if ($(this).attr('data-slug') != undefined) {
		pageurl = base + $(this).attr('data-slug') + '/';
	} else if ($(this).attr('href') != undefined) {
		pageurl = $(this).attr('href');
		if (pageurl.includes('#')) {
			canChange = false;
		}
	}

	var post_id = $(this).attr('data-id');
	var modalType = $(this).attr('data-modalType');
	if (modalType == undefined) {
		modalType = 'page';
	} else if (modalType == 'video') {
		pageurl = $(this).attr('data-url');
	}

	if (canChange) {
		if (!modal.open) {
	     	setTimeout(function() {
	     		modal.type = modalType;
		    	modal.create(post_id, pageurl);
		    	console.log('Post ID: ' + post_id);
	    	}, 1)
	     } else {
	     	modal.changePage(post_id, pageurl);
	     	console.log('Post ID: ' + post_id);
	     }


	} else { // Scroll page
		var section = pageurl.split('#');
			section = '#' + section[1];
		$('html, body').animate({
	        scrollTop: $(section).offset().top - 100
	    },750);
	}

	$('.mobile-nav').addClass('inactive');

});

$(document).on('click', '.sign-up-button', function() {
	$('html, body').animate({
        scrollTop: $('#who-are-we').offset().top - 100
    },750);
})


//-------------Mobile Nav
var mobileNavOpen = false;
$(document).on('click', '.mobile-nav-button', function() {
	$('.mobile-nav').removeClass('inactive');
})

$(document).on('click', '.close-button', function() {
	$('.mobile-nav').addClass('inactive');
})


//
window.onpopstate = function(e) {
	popState    = true;
	popStateurl = window.location.pathname;

	if (modal.open && popStateurl != base) {
		modal.load('', popStateurl);
	} else if (popStateurl == base) {
		modal.destroy();
	} else {
		modal.create('', popStateurl);
	}

	popState = false;
}


// Close modal window by clicking outside of element
$(document).click(function(event) {
    if(!$(event.target).closest('.modal-box, .load-icon, #bio_ep_close, #bio_ep_bg, #bio_ep').length && modal.open) {
        if($('.modal-box').is(":visible")) {
        	modal.destroy();
        }
    }
});

$(document).on('click', '#exit, .exit-modal', function(e) {
	e.preventDefault();
	modal.destroy();
})





// Exit intent Popup

// bioEp.init({
//     html: '<div id="content">A simple popup</div>',
//     css: '#content {font-size: 20px;}',
//     delay: 10,
//     showOnDelay: true
// });




// ------------------------------------------------------------------------------------------------------------------------------------------------------------- //
// Hide Player and Nav while scrolling on mobile ------------------------------------------------------------------------------------------------------------------------------------------------------------ //
// ------------------------------------------------------------------------------------------------------------------------------------------------------------- //

var didScroll, scrollBody;
var lastScrollTop = 0;
var delta = 200;

// Hide/show header depending on scroll direction
function hasScrolled(scrollBody) {
    var st = $(scrollBody).scrollTop();

    if (Math.abs(lastScrollTop - st) <= delta)
        return;

	if (st < lastScrollTop  && mobile && st < 300) {
        if (!bioEp.shown) bioEp.showPopup();
    }
    lastScrollTop = st;
    console.log('Scroll Top: ' + st);
}

// Turn didScroll on
$(window).scroll(function() {
    didScroll = true;
    scrollBody = window;
});

$('#overlay').scroll(function() {
	didScroll = true;
	scrollBody = '#overlay';
});

//run scroll check and reset didScroll status
setInterval(function() {
    if (didScroll) {
        hasScrolled(scrollBody);
        didScroll = false;
    };
}, 10);


}); // end