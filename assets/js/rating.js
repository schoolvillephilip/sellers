var slice = [].slice;
var _rating = $('.rating-text');
var pid = product_id;


(function ($, window) {
	var Starrr;
	window.Starrr = Starrr = (function () {
		Starrr.prototype.defaults = {
			rating: void 0,
			max: 5,
			readOnly: false,
			emptyClass: 'fa fa-star-o',
			fullClass: 'fa fa-star',
			change: function (e, value) {
			}
		};

		function Starrr($el, options) {
			this.options = $.extend({}, this.defaults, options);
			this.$el = $el;
			this.createStars();
			this.syncRating();
			if (this.options.readOnly) {
				return;
			}
			this.$el.on('mouseover.starrr', 'a', (function (_this) {
				return function (e) {
					_rating.show();
					switch (_this.getStars().index(e.currentTarget) + 1) {
						case 1:
							_rating.html("I hate it");
							break;
						case 2:
							_rating.html("I don't like it");
							break;
						case 3:
							_rating.html("I don't like or dislike it");
							break;
						case 4:
							_rating.html("I like it");
							break;
						case 5:
							_rating.html("I love it!");
							break;
						default:
							break;
					}
					return _this.syncRating(_this.getStars().index(e.currentTarget) + 1);
				};
			})(this));
			this.$el.on('mouseout.starrr', (function (_this) {
				return function () {
					_rating.hide();
					return _this.syncRating();
				};
			})(this));
			this.$el.on('click.starrr', 'a', (function (_this) {
				return function (e) {
					e.preventDefault();
					return _this.setRating(_this.getStars().index(e.currentTarget) + 1);
				};
			})(this));
			this.$el.on('starrr:change', this.options.change);
		}

		Starrr.prototype.getStars = function () {
			return this.$el.find('a');
		};

		Starrr.prototype.createStars = function () {
			var j, ref, results;
			results = [];
			for (j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; 1 <= ref ? j++ : j--) {
				results.push(this.$el.append("<a href='#' />"));
			}
			return results;
		};

		Starrr.prototype.setRating = function (rating) {
			if (this.options.rating === rating) {
				rating = void 0;
			}
			this.options.rating = rating;
			this.syncRating();
			return this.$el.trigger('starrr:change', rating);
		};

		Starrr.prototype.getRating = function () {
			return this.options.rating;
		};

		Starrr.prototype.syncRating = function (rating) {
			var $stars, i, j, ref, results;
			rating || (rating = this.options.rating);
			$stars = this.getStars();
			results = [];
			for (i = j = 1, ref = this.options.max; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
				results.push($stars.eq(i - 1).removeClass(rating >= i ? this.options.emptyClass : this.options.fullClass).addClass(rating >= i ? this.options.fullClass : this.options.emptyClass));
			}
			return results;
		};

		return Starrr;

	})();
	return $.fn.extend({
		starrr: function () {
			var args, option;
			option = arguments[0], args = 2 <= arguments.length ? slice.call(arguments, 1) : [];
			return this.each(function () {
				var data;
				data = $(this).data('starrr');
				if (!data) {
					$(this).data('starrr', (data = new Starrr($(this), option)));
				}
				if (typeof option === 'string') {
					return data[option].apply(data, args);
				}
			});
		}
	});
})(window.jQuery, window);
$('#star1').starrr({
	change: function (e, value) {
		if (value) {
			$.ajax({
				url: base_url + "product/add_rating",
				method: "POST",
				data: {product_id: product_id, user_id: user, count: value},
				success: function (response) {
				},
				error: function (response) {
					alert("Sorry an error occurred somewhere")
				}
			});
		} else {
			$('.your-choice-was').hide();
		}
	}
});
var $s2input = $('#star2_input');
$('#star2').starrr({
	max: 10,
	rating: $s2input.val(),
	change: function (e, value) {
		$s2input.val(value).trigger('input');
	}
});


$('#review_form').on('submit', function (e) {
	$('#review_submit_button').prop("disabled", true);
	e.preventDefault();
	let title = $('#review_title').val();
	let name = $('#review_name').val();
	let detail = $('#review_detail').val();

	$.ajax({
		url: base_url + "product/add_review",
		method: "POST",
		data: {title: title, name: name, detail: detail, 'product_id': pid, 'user_id': user},
		success: function (response) {
			$('#review_form').hide();
			let m_review = JSON.parse(response);


			$('#review_submit').append(`
				<h4>${m_review.title}</h4>
				<p>${m_review.detail}</p>
				<span>By - ${m_review.name}</span>
			`)
		},
		error: function (response) {
			alert("Sorry an error occurred somewhere")
		}
	});

});

$('.update_rating').on('click', function () {
	$('#starr-rating-active').show();
	$('#starr-rating').hide();
});
