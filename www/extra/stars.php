<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		li {
			display: inline-block;
			color: #F0F0F0;
			text-shadow: 0 0 1px #666666;
			font-size: 30px;
		}

		.highlight,
		.selected {
			color: #F4B30A;
			text-shadow: 0 0 1px #F48F0A;
		}
	</style>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>

<body>

	<input type="text" name="rating" id="rating" />
	<ul class="newRating" onMouseOut="resetRating();">
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
		<li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
	</ul>

	<script>
		let stars = document.querySelectorAll(".star");
		let rating = document.getElementById("rating");

		function highlightStar(obj) {
			removeHighlight();
			for (let i = 0; i < stars.length; i++) {
				stars[i].classList.add("highlight");
				if (stars[i] == obj) {
					break;
				}
			}
		}

		function removeHighlight() {
			stars.forEach(star => {
				star.classList.remove("selected");
				star.classList.remove("highlight");
			});
		}

		function addRating(obj) {
			for (let i = 0; i < stars.length; i++) {
				stars[i].classList.add("selected");
				rating.value = i + 1;
				if (stars[i] == obj) {
					break;
				}
			}
			if (rating.value) {
				
			}
		}

		function resetRating() {
			if (rating.value != "") {
				for (let i = 0; i < stars.length; i++) {
					stars[i].classList.add("selected");
					if ((i + 1) == rating.value) {
						break;
					}
				}
			}
		}
	</script>

</body>

</html>